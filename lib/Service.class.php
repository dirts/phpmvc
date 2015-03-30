<?php
namespace Dirt\Lib;

class Service {
	
	# 初始化一个数据库,初始化model的时候就初始化一个mysql实例
	function __construct(){
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
