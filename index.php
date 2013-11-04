<?php

	#error_reporting(E_ERROR | E_PARSE | E_STRICT);
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	session_start();
	date_default_timezone_set('Asia/Chongqing');
	include_once('lib/common.php');
	define('ROOT',  dirname(__FILE__));

	load('config.php');
	//load(ROOTDIR.'/plugins/ChromePhp.php');

	load(ROOTDIR.'/lib/file_system.php');
	load(ROOTDIR.'/lib/Mysql.class.php');

	load(ROOTDIR.'/lib/core.php');
	load(ROOTDIR.'/lib/Action.class.php');
	load(ROOTDIR.'/lib/Service.class.php');
	load(ROOTDIR.'/lib/Model.class.php');
	//load('plugins/querypath/src/querypath.php');
	load(ROOTDIR.'/plugins/phpquery/phpQuery/phpQuery.php');
	//load('lib/memcache.php');
	load(SMARTY_PATH.'Smarty.class.php');

	$d = new D();
	


?>
