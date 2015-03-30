<?php
namespace Dirt;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

date_default_timezone_set('Asia/Chongqing');
define('ROOT',  dirname(__FILE__));

//session_start();

include_once('./lib/Autoload.class.php');

$controller = new \Dirt\Lib\Controller();
$controller->run();

/*
load(ROOT.'/lib/file_system.php');
$files  = get_files(ROOT.'/lib/');
load(ROOT.'/config.php');
load(ROOT.'/lib/Mysql.class.php');
load(ROOT.'/lib/core.php');
loads(ROOT.'/core/');
load(SMARTY_PATH.'Smarty.class.php');
$d = new D();
*/

?>
