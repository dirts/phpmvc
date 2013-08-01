<?php

define('M', 9);
define('D', 18);

#是否早晨打卡时间ok
function zm($ft, $mtime = M){
	$mtime = $mtime === null ? M : $mtime;
	$t = $ft[1];
	return ($t < $mtime) || ($t == $mtime && $ft[2]=='00');
}

#是否下班ok
function zd($ft, $mtime = D){
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
			if(zm($v, $limit[0])) $m = 1;
			elseif(zd($v, $limit[1])) $d = 1;

		return !$m || !$d ? false : true;
	}else{
		foreach($a as $k => $v)
			if(zm($v, $limit[0]) && max_length($a))
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

class ZhislandAction extends Action {
	
	function index(){
		$web_service = $this->service('zhisland');
		$users = $web_service->get_users();

		$this->assign('users', $users);
		$this->display('index.tpl');
	}

	function setting(){
		$web_service = $this->service('zhisland');
		$time = $web_service->get_time();
		
		$this->assign('time', $time['data']);
		$this->display('setting.tpl');
	}

	function up_time(){
		$date  = $_POST['time'];
		$web_service = $this->service('zhisland');
		$data = $web_service->up_time($date);
		if($data){
			$return = array(
				'code'=>'0',
				'data'=>$data,
			);
		}else{
			$return = array(
				'code'=>'0',
				'data'=>$data,
			);
		}
		echo json_encode($return);
	}
	

	function del_user(){
		$uid = $_GET['uid'];
		$web_service = $this->service('zhisland');
		$res = $web_service->del_user($uid);
	}

	function add_user(){
		$name 	= $_POST['name'];
		$mtime 	= $_POST['mtime'];
		$dtime 	= $_POST['dtime'];
		
		$data = array(
			'code'		=> 1,
			'data'		=> '',
			'message'	=> '返回结果',
		);
		
		$web_service = $this->service('zhisland');
		$has_user = $web_service->user_exists($name);
		
		if($has_user){
			$data['data']	= $has_user;
			$data['code']	= 1;
			$data['message']	= '该用户已经存在';
			echo json_encode($data);
			return;
		}
		
		$res = $web_service->add_user($name, $mtime, $dtime);
	
		$data['data'] = $res;
		if($res) $data['code']	= 0;
		else $data['code']	= 1;
		
		echo json_encode($data);
	}

	function work(){
		
		$web_service = $this->service('zhisland');
		$users = $web_service->get_users();
		
		$wkdays = array(
						'7-1',
						'7-2',
						'7-3',
						'7-4',
						'7-5',
						'7-8',
						'7-9',
						'7-10',
						'7-11',
						'7-12',
						'7-15',
						'7-16',
						'7-17',
						'7-18',
						'7-19',
						'7-22',
						'7-23',
						'7-24',
						'7-25',
						'7-26',
						'7-29',
						'7-30',
						'7-31',
						);
		#parse users data.
		foreach($users as $user){
			list($id, $name, $mtime, $dtime) = array_values($user);
			if($mtime >  0 || $dtime > 0 ){
				$wtt[$name] = array(intval($mtime), intval($dtime));
			}else{
				$wtt[$name] = array(null, null);
			}
		}

		$wks = array();
		$data = file(ROOTDIR.DS.APPS.'zhisland/'.'7.raw');
		//$data = file(ROOTDIR.DS.APPS.'web/'.'6.raw');

		#parse log data.
		foreach($data as $v){
			#去掉多余的字符
			$v = preg_replace('/"(\d+),(\d+)"/', '"\1\2"', $v);
			$v = str_replace("\"", '', trim($v));
			$v = str_replace(" ", ',', $v);
			#分隔成数组
			$ea = explode(',', $v);
			#名字
			$name = $ea[2];
			#时间
			$date = $ea[4];
			#小时i
			list($hour, $minute) = explode(':', $ea[5]);
			$wks[$name][$date][] = array($date, $hour, $minute);
		}


		printf("<table class='table table-striped table-bordered table-hover'>");
		printf("<col width='200'>");
		printf("<col width='200'>");
		printf("<col width='200'>");
		printf("<tr><th>姓名</th><th>日期</th><th>详情</th></tr>");
		#遍历所有有打卡记录的员工
		foreach($wks as $n => $w){
			if(!isset($wtt[$n])) $limit = array(9, 18);
			else $limit= $wtt[$n];
			if(!a($limit)) continue;
			#先检查该工作日是否上班
			
			foreach($wkdays as $day){
				if(!w($day, $w)){
					printf("<tr><td>%s(%s-%s) </td><td> %s </td><td>(无打卡记录)\r\n</td></tr>", $n, $limit[0], $limit[1], $day);
				}elseif(check_md($w[$day], $limit) === null){
					printf("<tr><td>%s(%s-%s) </td><td> %s </td>", $n, $limit[0], $limit[1], $day);
					foreach($w[$day] as $dd){
						printf("<td>%s未打卡\r\n</td></tr>", $dd[1] > 11 ? '上班' : '下班');
					}
				}elseif(!check_md($w[$day], $limit)){
					printf("<tr><td> %s(%s-%s) </td><td> %s </td><td>", $n, $limit[0], $limit[1], $day);
					foreach($w[$day] as $dd){
						printf("打卡记录: %d:%d\r\n", $dd[1], $dd[2]);
					}
					printf("</td></tr>");
				}
			}
		}
		printf("</table>");
		$this->display('work.tpl');
	}
}

?>
