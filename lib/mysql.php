<?php

class M{

	var $conn ;

	function __construct(){
		$this->connect( require_once(ROOTDIR.'/db.php'));
	}
	
	function where($condition){
		$this->condition = $condition;
	}

	function query($sql){
		if($this->conn){
			$query = mysql_query($sql, $this->conn);
			
			if($query){
				$results = array();
				while($res = mysql_fetch_assoc($query)){
					$results[] 	= $res;
				}
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
		if($this->conn){
			$sql = 'select * from '.$table;
			if(isset($this->condition)) $sql .= ' where '.$this->condition;
			$query = mysql_query($sql, $this->conn);
			if($query){
				
				$results = array();
				
				while($res = mysql_fetch_assoc($query)){
					$results[] 	= $res;
				}
				$count = count($results);
				if($count == 0) return null;
				elseif($count == 1) return $results[0];
				else return $results;
			
			}else{
				return $query;
			}
		}
	}
		
	function insert($info){
		$keys = array_keys($info);
		$vals = array_values($info);
		$key = ' ( '.join(' , ', $keys).' ) ';
		$val = ' ( \''.join('\' , \'', $vals).'\' )';
	
		if($this->conn){
			$sql = 'insert into '.$this->table.$key.'values'.$val;
			$query = mysql_query($sql, $this->conn);
			return $query;
		}
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

	function connect($db){
		static $conn;
		if(!is_resource($conn)) 	{
			$conn = mysql_connect($db['host'], $db['username'], $db['password']);	
			mysql_select_db($db['database'], $conn);
			mysql_query('set names utf8', $conn);
		}
		$this->conn =$conn;
		return $this->conn;
	}

}

function M(){
	$m = new M();
	return $m;
}

?>
