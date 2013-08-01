<?php

class Service{
	#初始化实例自动执行的方法
	function __construct(){
		//$this->model = new Model();
	}

	function model($app){
		include_once(ROOTDIR.DS.APPS.$app.DS.$app.MODEL_PHP);
		$Model_Class = $app.'Model';
		$model = new $Model_Class();
		return $model;
	}
	
	function get_table(){
		return $this->model->get_table();	
	}

}

?>
