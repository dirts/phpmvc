<?php
class MysqlClass{

	var $conn ;
	private $db;
	private $sql;

	function __construct(){
		//初始化建立链接
		$this->connect(config('mysql_server.default'));
	}

	#包裹转义字符，防止注入 \x00、 \n、 \r、 \、 '、 "、 \x1a、
	private function safe($item, $quote = '`'){
		return $quote . mysql_real_escape_string($item) . $quote;
	}

	#where 	
	public function where($condition){
		if(is_array($condition)){
			foreach($condition as $field => $item)
				$this->condition .= $field . ' = ' . $this->wrap($item, "'");	
		}else if(is_string($condition)){
			$this->condition = $condition;
		}
	}

	private function _qeury($sql){
		mysql_query($sql, $this->conn);	
	}

	#执行一段sql语句, 慎用!
	public function query($sql, $fetch = 'row'){
		if(!is_resource($this->conn)) return false;
		$results = array();

		$sql = mysql_real_escape_string($sql);
		$this->sql = $sql;
		
		$query_result = mysql_query($sql, $this->conn);
		if(is_bool($query_result)) return $query_result;

		/*mysql_fetch_row[offset], mysql_fetch_assoc[key value], mysql_fetch_array[both]*/
		while($res = mysql_fetch_assoc($query_result))
			$results[] = $res;
		$count = count($results);
		
		if($count == 0) return null;
		elseif($count == 1) return $results[0];
		else return $results;

	}

	#查询
	public function select(){
		if(!is_resource($this->conn)) return false;
		
		$sql = printf('select * from %s', $this->table);
		if(isset($this->condition)) $sql .= ' where '.$this->condition;
		
		return $this->query($sql);
	}

	#插入	
	public function insert(&$infos){
		if(!is_resource($this->conn)) return false;
		
		$fields = $this->safe_fields($infos);
		$values = $this->safe_values($infos);
		
		$sql = printf("insert into %s ( %s ) value ( %s )", $this->table, $fields, $values);
		$query = $this->query($sql);
		$this->sql = $sql;
		return $query;
	}

	#获取最后一条语句
	public function get_last_sql(){
		return $this->sql;	
	}

	private function safe_fields($datas){
		$fields = array_keys($datas);
		array_walk($fields,	"array_walk_strim", "`");
		$sql = join(" , ", $fields);
		return "$sql";
	}
	
	private function safe_values($datas){
		$values = array_keys($datas);
		array_walk($values,	"array_walk_strim", "'");
		$sql = join(" , ", $values);
		return "$sql";
	}

	public function update($info){
		if(!is_resource($conn)){
			$sql = 'update '.$this->table.' set ';
			foreach($info as $key => $val){
				$info[$key] = $key.'=\''.$val.'\'';
			}
			$sql .= join(' , ', $info);
			if(isset($this->condition)) $sql .= ' where '.$this->condition;
			$query = mysql_query($sql, $this->conn);
			return $query;
		}
	}
	
	public function table($table){
		$this->table  = $this->safe($table, '`');
		return $this;
	}
	
	#删除语句
	public function delele($table){
		if(!is_resource($conn)){
			$sql = "delete from ".$this->table ."where". $this->condition;
			$query = mysql_query($sql, $this->conn);
			return $query;
		}
	}

	#获取数据库的表
	public function show_tables(){
		$sql = 'show tables';
		$query_result = $this->query($sql);
		return $query_result;
	}

	#连库操作
	public function connect($db, $setnames = 'set names utf8'){
		static $conn;
		if(!is_resource($conn)){
			$conn = mysql_connect($db['host'], $db['username'], $db['password']);	
			mysql_select_db($db['database'], $conn);
			mysql_query($setnames, $conn);
		}
		return $this->conn = $conn;
	}

	#切库函数
	public function db($db){
		static $conn;
		if(is_resource($this->conn)) mysql_close($this->conn);
		$conn = mysql_connect($db['host'], $db['username'], $db['password']);	
		if($conn) mysql_select_db($db['database'], $conn);
		mysql_query('set names utf8', $conn);
		$this->conn =$conn;
		return $this;
	}

}

function M(){
	$mysql_instance = new MysqlClass();
	return $mysql_instance;
}

?>
