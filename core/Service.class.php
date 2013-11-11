<?php

class Service{
	#初始化实例自动执行的方法
	function __construct(){
		//$this->model = new Model();
	}

	function model($app){
		$path = ROOT.DS.APPS.$app.DS.$app.MODEL_PHP;
		load($path);
		$Model_Class = $app.'Model';
		$model = new $Model_Class();
		return $model;
	}
	
	function get_table(){
		return $this->model->get_table();	
	}

}

?>
