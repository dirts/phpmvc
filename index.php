<?php

	session_start();
	date_default_timezone_set('Asia/Chongqing');
	include_once('lib/common.php');
	load('config.php');
	load('plugins/ChromePhp.php');
	
	load('lib/file_system.php');
	load(ROOTDIR.'/lib/Mysql.class.php');
	load('lib/core.php');
	load('lib/Action.class.php');
	load('lib/Service.class.php');
	load('lib/Model.class.php');
	load(SMARTY_PATH.'Smarty.class.php');

	$d = new D();

?>
