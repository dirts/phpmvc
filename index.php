<?php
	session_start();
	date_default_timezone_set('Asia/Chongqing');
	include_once('lib/common.php');
	include_once('lib/core.php');
	include_once('lib/Action.class.php');
	include_once('lib/Service.class.php');
	include_once('lib/Model.class.php');
	include_once('config.php');
	require(SMARTY_PATH.'Smarty.class.php');

	$d = new D();
	$d->init();

?>
