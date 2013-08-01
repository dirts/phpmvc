<?php

class ZhislandService extends Service{
	
	function get_users(){
		$web_model 	= $this->model('zhisland');
		$info 		= $web_model->get_users();
		return $info;
	}

	function add_user($name, $mtime, $dtime){
		$user = array(
			'name' 		=> $name,
			'mtime'		=> $mtime,
			'dtime'		=> $dtime,
		);
		
		$web_model = $this->model('zhisland');
		$info = $web_model->add_user($user);
		return $info;
	}

	function del_user($uid){
		$web_model = $this->model('zhisland');
		return $web_model->del_user($uid);
	}

	function up_time($date){
		$web_model = $this->model('zhisland');
		return $web_model->up_time($date);
	}

	function get_time(){
		$web_model = $this->model('zhisland');
		return $web_model->get_time();
	}

	function user_exists($name){
		$web_model = $this->model('zhisland');
		$info = $web_model->user_exists($name);
		return $info;
	}

	function sync_users($users){
		$web_model	= $this->model('zhisland');
		foreach($users as $k => $v){
			$user = array(
				'name' 		=> $k,
				'mtime'		=> $v[0],
				'dtime'		=> $v[1],
			);
			$res		= $web_model->add_user($user);
		}
	}


}

?>
