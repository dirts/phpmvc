<?php
	
function U($app , $param=null){
	$app = explode('/', $app);
	$url = 'index.php?';
	$url .= 'mod='. $app[0]. '&act='. $app[1];
	if($param){
		foreach($param as $key => $val){
			$url .= '&'.$key.'='.$val;
		}
	}
	return $url;
}

function URL($param){
	return U($param['app'], $param['param']);
}

function redict($url){
	header('Location:'.$url);
	exit;
}


function getIP() { 
 	if (getenv('HTTP_CLIENT_IP')) { 
		$ip = getenv('HTTP_CLIENT_IP'); 
 	} 
 	elseif (getenv('HTTP_X_FORWARDED_FOR')) { 
 		$ip = getenv('HTTP_X_FORWARDED_FOR'); 
 	} 
 	elseif (getenv('HTTP_X_FORWARDED')) { 
 		$ip = getenv('HTTP_X_FORWARDED'); 
 	} 
 	elseif (getenv('HTTP_FORWARDED_FOR')) { 
 		$ip = getenv('HTTP_FORWARDED_FOR'); 
 	} 
 	elseif (getenv('HTTP_FORWARDED')) { 
 		$ip = getenv('HTTP_FORWARDED'); 
 	} 
 	else { 
 		$ip = $_SERVER['REMOTE_ADDR']; 
 	} 
 	return $ip; 
}

function preg_test($reg, $str){

	return preg_match($reg, $str);
}

function console_log($msg){
	echo '<pre>';
	var_dump($msg);
	echo '</pre>';
}

function array_walk_strim(&$item, $key, $sp){
	$item = "$sp$item$sp";
}

function get_post($key, $value){
	$return =  $_POST[$key];
	return $return;
}

#配置函数
function config($name, $value = ''){
	static $_config = array();
	if(is_array($name)){
		$_config = array_merge($_config, $name);
		return $_config;
	}else if(is_string($name)){
	
		$argc = func_num_args();
		if($argc == 1){
			$_tmp = $_config;
			$keys = explode('.', $name);
			foreach($keys as $k)
				$_tmp = $_tmp[$k];
			return $_tmp;
		}elseif($argc == 2){
			return $_config[$name] = $value;
		}
		return $_config;
	}

}
?>
