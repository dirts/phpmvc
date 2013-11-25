<?php

#模块加载器
function load($file){
	require($file);
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
			foreach($keys as $k){
				if(!isset($_tmp[$k])) break;
				$_tmp = $_tmp[$k];
			}
			return $_tmp;
		}elseif($argc == 2){
			return $_config[$name] = $value;
		}
		return $_config;
	}

}
	
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


function array_walk_strim(&$item, $key, $sp){
	$item = "$sp$item$sp";
}

function get_post($key, $value){
	$return =  $_POST[$key];
	return $return;
}

#
function http($url){

		$options = array( 
			CURLOPT_RETURNTRANSFER => true,         // return web page 
			CURLOPT_HEADER         => false,        // don't return headers 
			CURLOPT_FOLLOWLOCATION => true,         // follow redirects 
			CURLOPT_ENCODING       => "",           // handle all encodings 
			CURLOPT_USERAGENT      => "spider",     // who am i 
			CURLOPT_AUTOREFERER    => true,         // set referer on redirect 
			CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect 
			CURLOPT_TIMEOUT        => 240,          // timeout on response 
			CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects 
			CURLOPT_POST           => 1,            // i am sending post data 
			CURLOPT_POSTFIELDS     => '',    // this are my post vars 
			CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl 
			CURLOPT_SSL_VERIFYPEER => false,        // 
			CURLOPT_VERBOSE        => 1                // 
		); 

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POSTFIELDS, array());
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 

	$respons = curl_exec($curl);
	return $respons;
}

?>
