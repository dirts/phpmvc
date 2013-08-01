<?php
class WebAction extends Action {
	function filesystem(){
		#选择环境
		$dev 	= '/home/lishouyan/wwwroot/www.zhisland.com/alpha';
		#模块名字
		$mod 	= 'Wtest';
		#表名字
		$table 	= 'weibo'; 
		
		$mods 	= strtolower($mod);
		
		#=========
		$file = WWWROOT.DS.APPS.'web'.DS.'wt.s';
		
		$file_array = open($file);

		$file_name = get_file_name($file);
		$file_path = get_file_path($file);


		$web_service = $this->service('web');
		$fields = $web_service->get_fields_info('ts_'.$table);


		foreach($fields as $key => $field){
			if(is_primarykey($field)){
				$index_field = $field['Field'];
			}

			$t = field_type($field);
			
			if($t[0] == 'text'){
				$fields[$key]['html'] = '<textarea name="'.$field['Field'].'">{$data[\''.$field['Field'].'\']}</textarea>';
			}elseif($t[1] == 'tinyint'){
				$fields[$key]['html'] = '<input type="radio" name="'.$field['Field'].'" value="0" checked/>';
			}elseif( is_primarykey($field)){
				$fields[$key]['html'] = 'primaraykey';
			}else{
				$fields[$key]['html'] = '<input type="text" name="'.$field['Field'].'" value="{$data[\''.$field['Field'].'\']}"/>';
			};
		}
		
		#创建目录:home/lishouyan/www/
		maketree($dev.'/apps/admin/Tpl/default/'.$mod);	
		
		maketree($dev.'/apps/'.$mods.'/Lib/Action');	
		maketree($dev.'/apps/'.$mods.'/Lib/Service');	
		maketree($dev.'/apps/'.$mods.'/Lib/Model');	

		file_create($dev.'/apps/admin/Tpl/default/'.$mod.'/index.html');
		file_create($dev.'/apps/admin/Tpl/default/'.$mod.'/edit.html');
		
		file_create($dev.'/apps/admin/Lib/Action/'.$mod.'Action.class.php');
		
		file_create($dev.'/apps/'.$mods.'/Lib/Service/'.$mod.'Service.class.php');	
		file_create($dev.'/apps/'.$mods.'/Lib/Model/'.$mod.'Model.class.php');	
		
		

		$this->assign('mod', 	$mod);
		$this->assign('mods', 	$mods);
		$this->assign('table', 	$table);
		$this->assign('fields', $fields);
		$this->assign('index_field', $index_field);
		
		$index_html 	= $this->fetch('index.web.tpl');
		$edit_html 		= $this->fetch('edit.web.tpl');
		$admin_action 	= $this->fetch('action.tpl');
		$mod_service 	= $this->fetch('service.tpl');
		$mod_model 		= $this->fetch('model.tpl');
		
		file_write($dev.'/apps/admin/Tpl/default/'.$mod.'/index.html', $index_html);
		file_write($dev.'/apps/admin/Tpl/default/'.$mod.'/edit.html', $edit_html);
		file_write($dev.'/apps/admin/Lib/Action/'.$mod.'Action.class.php', '<?php'.PHP_EOL.$admin_action);
		file_write($dev.'/apps/'.$mods.'/Lib/Service/'.$mod.'Service.class.php', '<?php'.PHP_EOL.$mod_service);
		file_write($dev.'/apps/'.$mods.'/Lib/Model/'.$mod.'Model.class.php', '<?php'.PHP_EOL.$mod_model);

		return;
	}

	function bootstrap(){
		$res = preg_match('/ts/', 'tsssts');
		$this->display('bootstrap.tpl');
	}
	
	function login(){
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
		
		#ob_get_contents
		file_put_contents(ROOTDIR.DS.'data'.DS.'page2.tpl', $fetch);
			
		$this->assign('tables', $tables);
		$this->display('page.tpl');
	}

}
?>
