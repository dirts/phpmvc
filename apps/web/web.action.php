<?php
class WebAction extends Action {
	
	function login(){
		$this->assign('lang', $GLOBALS['lang']);
		$this->display('login.tpl');
	}

	function index(){
		
		$web_service = $this->service('web');
		$info = $web_service->get_users();
		var_dump($_SESSION);	

		$this->assign('param', array('x'=>'x'));
		$this->assign('info', $info);
		$this->assign('lang', $GLOBALS['lang']);
		$this->assign('time', date("Y-m-d"));
		$this->display('index.tpl');
	}

	function lists(){
		$this->assign('name','LIST');
		$this->display('list.tpl');
	}

	#api-demo.	
	function api(){
		$ip 	= getIP();
		$data 	= array(
			'code'		=> 0 , 
			'message'	=> '成功', 
			'data' 		=> $ip,
		);
		echo json_encode($data);
	}
	
	function dologin(){

		$username = $_POST['username'];
		$password = $_POST['password'];
		$web_service = $this->service('web');
		$info = $web_service->login($username, $password);
		if($info){
			$_SESSION['username'] = $info[0]['username'];
			$data 	= array(
				'code'		=> 0 , 
				'message'	=> '成功', 
				'data' 		=> array(
					'href'	=> U('web/index'),
				),
			);
		}else{
			$data 	= array(
				'code'		=> 2 , 
				'message'	=> '失败', 
				'data' 		=> $info,
			);
		}
		echo json_encode($data);
	}

}
?>
