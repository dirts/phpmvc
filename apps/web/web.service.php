<?php

class webService extends Service{
	
	function get_users(){
		$web_model 	= $this->model('web');
		$info 		= $web_model->get_users();
		return $info;
	}
	
	function login($username, $password){
		$web_model 	= $this->model('web');
		$info 		= $web_model->login($username , $password);
		return $info;
	}
}

?>
