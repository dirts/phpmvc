<?php
class D {

	#初始化实例自动执行的方法
	function __construct(){
		$req = $_REQUEST;
		$this->app = array();
		
		if(isset($_REQUEST[MOD])){
			$this->app[MOD] = $req[MOD];
		}else{
			$this->app[MOD] = 'web';
		}
		
		$mod_path = $this->get_mod_path($this->app);
		if(!file_exists($mod_path)){
			$this->app[MOD] = 'web';
			$mod_path = $this->get_mod_path($this->app);
		}
		
		if(isset($_REQUEST[ACT])) $this->app[ACT] = $req[ACT];
		else $this->app[ACT] = 'login';
		
		$this->load_app($mod_path, $this->app[MOD], $this->app[ACT]);
	}

	#实例消失自动执行的方法
	function __destruct(){
	}

	#初始化mod
	function load_app($file, $mod,$act){
		include_once($file);
		$mod_class = $mod.'Action';
		$modapp = new $mod_class();
			
		$this->load_lang();
		$modapp->init_smarty();
		$modapp->smarty->template_dir = ROOTDIR.DS.APPS.$mod.TEMPLATES;
			
		if(method_exists($modapp, $act)){
			$modapp->$act();
		}else{
			$modapp->login();
		}
	}

	#加载语言文件
	function load_lang(){
		if(isset($_REQUEST['lang'])){
			$lang = $_REQUEST['lang'];
		}else{
			$lang = DEFAULT_LANG;
		}
		
		$lang_file = $this->get_lang_file($this->app[MOD], $lang);

		if(file_exists($lang_file)){
			include_once($lang_file);
		}
	}

	#获取语言包
	function get_lang_file($mod, $lang){
		$file = ROOTDIR.DS.APPS.$mod.DS.'lang/'.$lang.DOT_PHP;
		if(!file_exists($file)){
			$file = ROOTDIR.DS.APPS.$mod.DS.'lang/'.DEFAULT_LANG.DOT_PHP;
		}
		return $file;
	}

	#获取mod路径
	function get_mod_path($app){
		$mod = $app[MOD];
		$file = APPS.$mod.DS.$mod.ACTION_PHP;
		return $file;
	}

}
