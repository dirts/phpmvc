<?php
//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
class WebAction extends Action {
	
	function pinyin(){
		$file  = file('/home/lishouyan/wwwroot/static.zhisland.com/alpha/apps/web/pinyin.txt');
		$tmp = array();
		if($file){
			foreach($file as $line){
				$arr = explode(',', $line);
				foreach($arr as $k => $v){
					$arr[$k] = trim($v);
				}
				$tmp[] = $arr;
			}
		}

		$service = $this->service('web');
		foreach($tmp as $a){
			$service->pin($a);
		}
		
	}

	function is_pinyin($str){
		return preg_match('/^\w+/i', $str);
	}

	function city(){
		$service = $this->service('web');
		$citys = $service->get_citys();
		$service->city_pinyins($citys);
	}
	
	function city_fixed(){
		$service = $this->service('web');
		$citys = $service->get_citys();
		$service->city_fixed($citys);
	}
	
	function fs(){
		#选择环境
		$dev 	= '/home/lishouyan/fs';
		#模块名字
		$mod 	= 'Bus';
		#表名字
		$table 	= 'user'; 
		
		$mods 	= strtolower($mod);
		


		$web_service = $this->service('web');
		$fields = $web_service->get_fields_info('ts_'.$table);


		//*处理字段
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


		//文件配置
		$files = array(
			'index.html' 		=> array(
					'path'		=> $dev.'/apps/admin/Tpl/default/'.$mod.'/index.html',
					'template'	=> 'index.web.tpl',
				),
			'edit.html'			=> array(
					'path'		=> $dev.'/apps/admin/Tpl/default/'.$mod.'/edit.html',
					'template'	=> 'edit.web.tpl',
				),
			'action.class.php'	=> array(
					'path'		=> $dev.'/apps/admin/Lib/Action/'.$mod.'Action.class.php',
					'template'	=> 'action.tpl',
				),
			'Service.class.php'	=> array(
					'path'		=> $dev.'/apps/'.$mods.'/Lib/Service/'.$mod.'Service.class.php',
					'template'	=> 'service.tpl',
				),
			'Model.class.php'	=> array(
					'path'		=> $dev.'/apps/'.$mods.'/Lib/Model/'.$mod.'Model.class.php',
					'template'	=> 'model.tpl',
				),
			'core.js'	=> array(
					'path'		=> $dev.'/static/admin/'.$mods.'/js/'.$mods.'.core.js',
					'template'	=> 'core.js.tpl',
				),
		);

		$this->assign('mod', 			$mod);
		$this->assign('mods', 			$mods);
		$this->assign('table', 			$table);
		$this->assign('fields', 		$fields);
		$this->assign('index_field', 	$index_field);

		foreach($files as $k => $file){
			$path = get_file_path($file['path']);
			
			if(is_null($path)) $path = preg_replace("/(\w+\.)+(php|html|js|css)$/", "", $file['path']);
			
			maketree($path);
			
			file_create($file['path']);
			$content = $this->fetch($file['template']);
			
			$ex = get_extension($file['path']);
			if( $ex == 'php' ) file_write($file['path'], '<?php' . PHP_EOL . $content);
			else file_write($file['path'], $content);
		}
	
		$this->assign('files', $files);
		$this->display('fs.tpl');
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

	#切库
	function change_db(){
		$web_mod = $this->model('web');
		
		$tables = $web_mod->query('select * from ts_user');
	
		$sql = $web_mod->get_last_sql();
		//$tables = array_get_fields($tables, 0);
		pre($sql);
	}

	#mc test
	public function mc(){
		$mc = new Memcache;
		$mc->connect('10.8.14.105', 12000);
		$mc->set('test', 'value_001', 0, 3600);
		$mc_res = $mc->get('test');
		$mc->close();
	}

}
?>
