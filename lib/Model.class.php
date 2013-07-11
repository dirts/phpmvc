<?php
class Model {
	# 初始化一个数据库
	function __construct(){
		include_once(ROOTDIR.'/lib/mysql.php');
		$database = require_once(ROOTDIR.'/db.php');
			
		$this->m = M();
		$this->m->connect($database);
	}

	function where($condition){
		$this->m->where($condition);
		return $this;
	}

	function select($table){
		return $this->m->select($table);
	}

	function insert($info){
		return $this->m->insert($info);
	}
	
	function update($info){
		return $this->m->update($info);
	}
	
	function get_table(){
		return $this->m->get_table();
	}

	function table($table){
		$this->m->table($table);
		return $this;
	}

}
?>
