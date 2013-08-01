<?php
class Model {
	
	# 初始化一个数据库
	function __construct(){
		$this->m = M();
	}

	function query($sql){
		return $this->m->query($sql);
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
	
	function del(){
		return $this->m->del();
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
