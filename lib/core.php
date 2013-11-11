<?php
class D {
	/*
		1.index.php 准备基础文件加载器
		2.加载库文件

	*/
	#初始化实例自动执行的方法
	function __construct(){
		$request = $_REQUEST;
		$this->app = array();
	
		if( empty( $request[MOD] ) && empty( $request[ACT] ) ){
			$this->app[MOD] = 'web';
			$this->app[ACT]	= 'index';
			redict(U(join('/', $this->app)));
		}

		if( empty($request[MOD]) ){
			$this->app[MOD] = 'web';
		}else{
			$this->app[MOD] = $request[MOD];
		}
	
		if( empty($request[ACT]) ){
			$this->app[ACT] = 'index';
		}else{
			$this->app[ACT]	= $request[ACT];
		}
		
		$mod_path = $this->get_mod_path($this->app);

		if(!file_exists($mod_path)){
			$this->app[MOD] = 'web';
			$mod_path = $this->get_mod_path($this->app);
		}
		
		if(isset($_REQUEST[ACT])) $this->app[ACT] = $request[ACT];
		else $this->app[ACT] = 'login';
		
		$this->load_app($mod_path, $this->app[MOD], $this->app[ACT]);
	}

	#实例消失自动执行的方法
	function __destruct(){
	
	}

	#初始化mod
	function load_app($file, $mod, $act){
		load($file);
		$mod_class = $mod.'Action';
		$modapp = new $mod_class();
			
		$this->load_lang();
		$modapp->init_smarty();
		$modapp->smarty->template_dir = ROOT.DS.APPS.$mod.TEMPLATES;
			
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
			load($lang_file);
		}
	}

	#获取语言包
	function get_lang_file($mod, $lang = DEFAULT_LANG){
		$file = ROOT.DS.APPS.$mod.DS.'lang/'.$lang.DOT_PHP;
		if(!file_exists($file)){
			$file = ROOT.DS.APPS.$mod.DS.'lang/'.$lang.DOT_PHP;
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
