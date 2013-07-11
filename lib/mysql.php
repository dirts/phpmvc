<?php

class M{

	function where($condition){
		$this->condition = $condition;
	}

	function select($table){
		if($this->conn){
			$sql = 'select * from '.$table;
			if(isset($this->condition)) $sql .= ' where '.$this->condition;
			$query = mysql_query($sql, $this->conn);
			if($query){
				$results = array();
				while($res = mysql_fetch_assoc($query)){
					array_push($results, $res)	;
				}
				return $results;
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

	function table($table){
		$this->table  = $table;
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
		$this->conn = mysql_connect($db['host'], $db['username'], $db['password']);	
		mysql_select_db('test_lishouyan', $this->conn);
		return $this->conn;
	}

}

function M(){
	$m = new M();
	return $m;
}

?>
