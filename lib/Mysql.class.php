<?php

class MysqlClass{

	var $conn ;
	private $db;

	function __construct(){
		$this->connect( require_once(ROOTDIR.'/db.php'));
	}
	
	function where($condition){
		$this->condition = $condition;
	}

	function query($sql){
		if($this->conn){
			$query = mysql_query($sql, $this->conn);
			
			if(is_bool($query)) return $query;
			if($query){
				$results = array();
				while($res = mysql_fetch_assoc($query))
					$results[] 	= $res;
				$count = count($results);
				if($count == 0) return null;
				elseif($count == 1) return $results[0];
				else return $results;
			}

		}else{
			return false;
		}
	}

	function select($table){
		if(!is_resource($this->conn)) return false;
		
		$sql = 'select * from '.$table;
		if(isset($this->condition)) $sql .= ' where '.$this->condition;
		$query = mysql_query($sql, $this->conn);
		
		if(!$query) return $query;
				
		$results = array();
				
		while($res = mysql_fetch_assoc($query))
			$results[] 	= $res;
		
		$count = count($results);
		if($count == 0) return null;
		elseif($count == 1) return $results[0];
		else return $results;
			
	}
		
	function insert($infos, $table){
		if(!is_resource($this->conn)) return false;
		
		$fields = $this->safe_fields($infos);
		$values = $this->safe_values($infos);
		
		$sql = "insert into $table ( $fields ) value ( $values )";
		$query = mysql_query($sql, $this->conn);
		return $query;
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

	function wrap(&$item, $key, $sp){
		$itme = "$sp$item$sp";
	}

	private function safe($datas){
	}

	function update($info){
		if($this->conn){
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
	
	function table($table){
		$this->table  = $table;
	}

	function del(){
		if($this->conn){
			$sql = 'delete from '.$this->table.' where '.$this->condition;
			$query = mysql_query($sql, $this->conn);
			return $query;
		}
	}

	function get_table(){
		if($this->conn){
			$sql = 'show tables';
			$query = mysql_query($sql, $this->conn);
			if($query){
				$results = array();
				while($res = mysql_fetch_row($query)){
					array_push($results, $res);
				}
				return array_values($results);
			}else{
				return $query;
			}
		}
	}

	#连库操作
	function connect($db, $setnames = 'set names utf8'){
		static $conn;
		if(!is_resource($conn)) 	{
			$conn = mysql_connect($db['host'], $db['username'], $db['password']);	
			mysql_select_db($db['database'], $conn);
			mysql_query($setnames, $conn);
		}
		$this->conn =$conn;
		return $this->conn;
	}

	#切库函数
	function switch_db($db){
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
	//if($db) $mysql_instance->connect($db);
	return $mysql_instance;
}

?>
