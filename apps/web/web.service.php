<?php

class webService extends Service{
	
	function get_users(){
		$web_model 	= $this->model('web');
		$info 		= $web_model->get_users();
		return $info;
	}
}

?>
