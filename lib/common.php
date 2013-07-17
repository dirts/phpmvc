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

?>
