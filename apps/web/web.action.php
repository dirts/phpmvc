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
		return;
		#选择环境
		$dev 	= '/home/yujin/dev-yujins';
		#模块名字
		$mod 	= 'Bus';
		#表名字
		$table 	= 'user_bus'; 
		
		$mods 	= strtolower($mod);
		
		#=========
		//$file = WWWROOT.DS.APPS.'web'.DS.'wt.s';
		
		//$file_array = open($file);

		//$file_name = get_file_name($file);
		//$file_path = get_file_path($file);


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
		);
		

		$this->assign('mod', 	$mod);
		$this->assign('mods', 	$mods);
		$this->assign('table', 	$table);
		$this->assign('fields', $fields);
		$this->assign('index_field', $index_field);


		foreach($files as $k => $file){
			$path = get_file_path($file['path']);
			
			if(is_null($path)) $path= preg_replace("/(\w+\.)+(php|html)$/", "", $file['path']);
			
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

	function text(){
		$web_service = $this->service('web');
		$fields = $web_service->onem('ts_'.$table);
		
		echo json_encode($data);
	}

	#测接口
	function test(){
		$config = array(
			'sites'	=> array(
				array('title' => '李守岩', 		'url' => 'http://lishouyan.zhdapi.deving.zhisland.com/client'),
			),
			'apis' =>	array(
				array('title' => '用户列表', 	'url' => '/feed/user_list.json?user_id=0&feed_type=1'),
				array('title' => '发布',		'url' => '/feed/publish.json?content=2'),
			),
		);
		$this->assign('config', $config);
		$this->display('test.tpl');	
	}

	function zhim(){
		$site = $_POST['site'];
		$api 	= $_POST['api'];

		$curl = curl_init();
		$url = $site.$api;
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POSTFIELDS, array());
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
		$res = curl_exec($curl);
	}

	#切库
	function change_db(){
		//$page = http('http://lishouyan.static.deving.zhisland.com/index.php?mod=web&act=api');
		//$page = json_decode($page, true);
		//$page = array_merge($page, array('code'=>'1', 's'=>'1'));
		//console::log($page);
		
		$mod = $this->model('web');
		
		$db = $mod->m->db(config('mysql_server.zhtfeed'));
		//$db = $mod->m->db(config('mysql_server.zhisland'));
		//$db->table('user')->insert({'username'=>'admin', 'password'=>'stupid'});
		
		$res = $db->table('user')->select();
		//show_tables();
		//$data  = array_get_fields($res, 0);
		var_dump($res);
	}

	function db(){
		$mod = $this->model('web');
	}
		
	#mc test
	public function mc(){
		$mc = new Memcache;
		$mc->connect('10.8.14.105', 12000);
		$mc->set('test', 'value_001', 0, 3600);
		$mc_res = $mc->get('test');
		$mc->close();
	}
	
	public function pq(){
		phpQuery::newDocumentFile('http://www.baidu.com/');  
		$com = pq('#u a')->attr('href');
		var_dump($com);
	}

}
?>
