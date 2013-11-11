<?php

	date_default_timezone_set('Asia/Chongqing');
	define('ROOT',  dirname(__FILE__));
	
	session_start();
	
	include_once('lib/common.php');
	load(ROOT.'/lib/file_system.php');

	$files  = get_files(ROOT.'/lib/');

	load(ROOT.'/config.php');
	load(ROOT.'/lib/Mysql.class.php');

	load(ROOT.'/lib/core.php');
	
	loads(ROOT.'/core/');
	
	load(SMARTY_PATH.'Smarty.class.php');
	
	$d = new D();


?>
