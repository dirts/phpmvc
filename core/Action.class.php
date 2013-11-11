<?php
class Action {

	#将smarty初始化为对象实例的一个属性, 并借用smarty的方法为自身的方法.
	function init_smarty(){
		$this->smarty = new Smarty();
		$this->smarty->compile_dir = ROOT.TEMP;
		$this->smarty->config_dir = ROOT.CONFIGS;
		$this->smarty->cache_dir = ROOT.CACHE;
		$this->smarty->left_delimiter = '{%';
		$this->smarty->right_delimiter = '%}';
	}
	
	function fetch($file){
		return $this->smarty->fetch($file);	
	}

	function assign($name, $varable){
		$this->smarty->assign($name, $varable);	
	}

	function display($tpl){
		$this->smarty->display($tpl);
	}

	#调取service方法
	function service($app){
		$path = ROOT.DS.APPS.$app.DS.$app.SERVICE_PHP;
		load($path);
		$Service_Class = $app.'Service';
		$service = new $Service_Class();
		return $service;
	}
	
	#调取model方法
	function model($app){
		$path = ROOT.DS.APPS.$app.DS.$app.MODEL_PHP;
		load($path);
		$Model_Class = $app.'Model';
		$model = new $Model_Class();
		return $model;
	}

}
?>
