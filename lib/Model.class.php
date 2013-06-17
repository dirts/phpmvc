<?php
class Model {
	# 初始化一个数据库
	function init_sql(){
		include_once(ROOTDIR.'/lib/mysql.php');
		$database = require_once(ROOTDIR.'/db.php');
			
		$this->m = M('author');
		$this->m->connect($database);
	}

	function where($condition){
		$this->m->where($condition);
		return $this;
	}

	function select(){
		return $this->m->select();
	}

	function insert($info){
		return $this->m->insert($info);
	}
	
	function update($info){
		return $this->m->update($info);
	}

}
?>
