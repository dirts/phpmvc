<?php

define(M, 9);
define(D, 18);
$wkdays = array(
		'6-3',
		'6-4',
		'6-5',
		'6-6',
		'6-7',
		'6-8',
		'6-9',
		'6-13',
		'6-14',
		'6-17',
		'6-18',
		'6-19',
		'6-19',
		'6-20',
		'6-21',
		'6-24',
		'6-25',
		'6-26',
		'6-27',
		'6-28',
);

#是否早晨打卡时间ok
function m($ft, $mtime = M){
	$mtime = $mtime === null ? M : $mtime;
	$t = $ft[1];
	return ($t < $mtime) || ($t == $mtime && $ft[2]=='00');
}

#是否下班ok
function d($ft, $mtime = D){
	$mtime = $mtime === null ? D : $mtime;
	$t = $ft[1];
	return $t >= $mtime;
}

#最早，最晚时间间隔
function max_length($ft){
	$s = count($ft);
	if($s < 2) return;
	$a = $ft[0];
	$b = $ft[$s - 1];
	if($b[1] - $a[1] > 9) return true;
	elseif($b[1] - $a[1] < 9) return false;
	elseif($b[2] >= $a[2] - 1) return true;
}

#是否打卡ok
function check_md($a, $limit = null){
	$m = $d = 0;
	if(!$a || count($a) == 1) return null;
	#非弹性
	if($limit[0] == 9){
		foreach($a as $k => $v)
			if(m($v, $limit[0])) $m = 1;
			elseif(d($v, $limit[1])) $d = 1;

		return !$m || !$d ? false : true;
	}else{
		foreach($a as $k => $v)
			if(m($v, $limit[0]) && max_length($a))
				return true;
	}
	return false;
}

#是否有当天的打卡记录
function w($date, $a){
	return array_key_exists($date, $a);
}

#是否该员工需要打卡
function a($a){
	return $a === null || ($a[0] === null && $a[1] === null) ? false : true;
}

$wt = file('./wt');
foreach($wt as $v){
	$v = trim($v);
	if(strpos($v, "\t")){
		list($name, $wta, $wtb) = explode("\t", $v);
		$wtt[$name] = array(intval($wta), intval($wtb));
	}else
		$wtt[$v] = array(null, null);
}

$wks = array();
$data = file('./6.raw');

foreach($data as $v){
	#去掉多余的字符
	$v = preg_replace('/"(\d+),(\d+)"/', '"\1\2"', $v);
	$v = str_replace("\"", '', trim($v));
	#分隔成数组
	$ea = explode(',', $v);
	#名字
	$name = $ea[2];
	#时间
	$date = $ea[4];
	#小时
	list($hour, $minute, $sec) = explode(':', $ea[5]);
	$wks[$name][$date][] = array($date, $hour, $minute);
}

#遍历所有有打卡记录的员工
foreach($wks as $n => $w){
	if(!isset($wtt[$n])) $limit = array(9, 18);
	else $limit= $wtt[$n];
	if(!a($limit)) continue;
	#先检查该工作日是否上班
	foreach($wkdays as $day){
		if(!w($day, $w)){
			printf("姓名: %s(%s-%s) 异常日期: %s (无打卡记录)\r\n", $n, $limit[0], $limit[1], $day);
		}elseif(check_md($w[$day], $limit) === null){
			printf("姓名: %s(%s-%s) 异常日期: %s\r\n", $n, $limit[0], $limit[1], $day);
			foreach($w[$day] as $dd){
				printf("%s未打卡\r\n", $dd[1] > 11 ? '上班' : '下班');
			}
		}elseif(!check_md($w[$day], $limit)){
			printf("姓名: %s(%s-%s) 异常日期: %s\r\n", $n, $limit[0], $limit[1], $day);
			foreach($w[$day] as $dd){
				printf("打卡记录: %d:%d\r\n", $dd[1], $dd[2]);
			}
		}
	}
}
