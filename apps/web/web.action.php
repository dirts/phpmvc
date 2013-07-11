<?php
class WebAction extends Action {
	
	function bootstrap(){
		$this->display('bootstrap.tpl');
	}
	
	function login(){
		//var_dump($GLOBALS);
		$this->assign('lang', $GLOBALS['lang']);
		$this->display('login.tpl');
	}

	function index(){
		
		if(!isset($_SESSION['username'])){
			redict(U('web/login'));
		}
		$web_service = $this->service('web');
		$info = $web_service->get_users();
		$tables = $web_service->get_table();

		$this->assign('tables', $tables);
		$this->assign('param', array('x'=>'x'));
		$this->assign('info', $info);
		$this->assign('lang', $GLOBALS['lang']);
		$this->assign('time', date("Y-m-d"));
		
		$this->display('index.tpl');
	}

	function lists(){
		$web_service = $this->service('gallery');
		$list = $web_service->get_list();
		$this->assign('list', $list);
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
	
	#pdf.
	function pdf(){
			
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

	# 登出
	function logout(){
		session_destroy();
		$data 	= array(
			'code'		=> 0 , 
			'message'	=> '成功', 
		);
		echo json_encode($data);
	}

	function seajs(){
		$this->display('seajs.tpl');
	}


	#page
	function page(){
		$web_service = $this->service('web');
		$tables = $web_service->get_table();

		$fetch = $this->fetch('page.tpl');
		
		var_dump(ROOTDIR.DS.'apps/web'.DS.'page2.tpl');
		#ob_get_contents
		file_put_contents(ROOTDIR.DS.'data'.DS.'page2.tpl', $fetch);
			
		$this->assign('tables', $tables);
		$this->display('page.tpl');
	}
}
?>
