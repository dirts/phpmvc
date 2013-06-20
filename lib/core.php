<?php
class D {

	#初始化实例自动执行的方法
	function __construct(){
		//var_dump(__CLASS__);
	}

	#实例消失自动执行的方法
	function __destruct(){
		//var_dump(__CLASS__);
	}

	#初始化mod
	function init_mod($file,$mod,$act){
		if(file_exists($file)){
			include_once($file);
			$mod_class = $mod.'Action';
			$modapp = new $mod_class();
			
			if(isset($_REQUEST['lang'])){
				$lang = $_REQUEST['lang'];
			}else{
				$lang = DEFAULT_LANG;
			}
		
			$lang_file = $this->get_lang_file($mod,$lang);
			
			if(file_exists($lang_file)){
				include_once($lang_file);
			}

			$modapp->init_smarty();
			$modapp->smarty->template_dir = ROOTDIR.DS.APPS.$mod.TEMPLATES;
			
			if(method_exists($modapp, $act)){
				$modapp->$act();
			}else{
				echo 'mod has not.';
			}
		}else{
			echo 'mod has not.';
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
		$act = isset($app[ACT]) ? $app[ACT] : null;
		$file = APPS.$mod.DS.$mod.ACTION_PHP;
		return $file;
	}

	#实例初始化函数
	function init(){
		$req = $_REQUEST;
		$app = array();
		if(isset($_REQUEST[MOD])){
			$app[MOD] = $req[MOD];
			if(isset($_REQUEST[ACT])) $app[ACT] = $req[ACT];
			$mod_path = $this->get_mod_path($app);
			$this->init_mod($mod_path, $app[MOD], $app[ACT]);
		}else{
			$this->init_smarty();
			$smarty->template_dir = ROOTDIR.TEMPLATES; 
			$this->assign('name','Ned');
			$this->display('index.tpl');
		}	
	}

}
