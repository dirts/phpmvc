<?php

define('WWWROOT',  				__DIR__);
define('CFG_LANG', 				'chinese');
define('APPS', 					'apps/');
define('MOD', 					'mod');
define('ACT',	 				'act');

define('TEMPLATES',	 			'/templates/');
define('TEMP',	 				'/temp/');
define('CONFIGS',	 			'/configs/');
define('CACHE',	 				'/cache/');

define('DS',					'/');
define('DOT_PHP', 				'.php');
define('ACTION_PHP', 			'.action.php');
define('SERVICE_PHP', 			'.service.php');
define('MODEL_PHP', 			'.model.php');

define('SMARTY_PATH', 			ROOT.'/plugins/smarty/');

define('DEFAULT_LANG', 			'cn');

#配置服务器
config(array(
	'mysql_server' => array(
		'zhisland'=>array(
			'host'		=> '192.168.2.70',
			'username'	=> 'zhisland',
			'password'	=> 'zhisland',
			'database'	=> 'zhisland',
		),
		'zhtfeed'=>array(
			'host'		=> '192.168.2.70',
			'username'	=> 'zhisland',
			'password'	=> 'zhisland',
			'database'	=> 'zhtfeed',
		),
		'default'=>array(
			'host'		=> '192.168.2.70',
			'username'	=> 'zhisland',
			'password'	=> 'zhisland',
			'database'	=> 'test_lishouyan',
		),
	)
));
