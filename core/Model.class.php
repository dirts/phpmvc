<?php
class Model {
	
	# 初始化一个数据库,初始化model的时候就初始化一个mysql实例
	function __construct(){
		$this->m = M();
	}

	function connect($db){
		return $this->m->connect($db);
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
	
	function delete(){
		return $this->m->delete();
	}
	
	function update($info){
		return $this->m->update($info);
	}
	
	function table($table){
		$this->m->table($table);
		return $this;
	}

	function __call($name, $arguments){
		if(method_exists($this->m, $name)){
			return call_user_func_array(array($this->m, $name), $arguments);	
		}else{
			return false;	
		}
	}

}

?>
