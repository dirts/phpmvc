<?php
class WebAction extends Action {

	function index(){
		
		$web_service = $this->service('web');
		$info = $web_service->get_users();
	
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

}
?>
