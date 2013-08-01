class {%$mod%}Action extends AdministratorAction {
	
	#首页、列表页
	public function index(){

		#取得search input 中要查询的字段，直接在模版文件中更改字段名称（name）即可
		if(!empty($_POST)){
			$keys = array_keys($req = $_POST);
			$key = $keys[0];
		}else if(count($_GET) > 1){
			$keys = array_keys($req = $_GET);
			$key = $keys[1];
		}

		if(!empty($keys)) $map[$key] = array('like', '%'. $req[$key] .'%');
		else $map = '';
	
		var_dump($map);
		$data = app_service('{%$mod%}', '{%$mods%}')->get_list($map, '*', 'uid DESC');
		$this->assign('data', $data);

		$this->display('index');
	}

	#编辑页
	public function edit(){
		$id 	= $_REQUEST['{%$index_field%}'];

		$info 	= app_service('{%$mod%}', '{%$mods%}')->get_info((int)$id);
	
		$this->assign('id', $id);
		if($info && $info[0]) $this->assign('data', $info[0]);
		$this->display('edit');
	
	}

	#新增页
	public function create(){
		$this->display('edit');
	}

	#提交操作
	public function add(){
		$fields = $_POST;
		
		$res 	= app_service('{%$mod%}', '{%$mods%}')->add($fields);
		$data = array(
			'code' => '',
			'data' => $res,
			'msg' => '',
		);

		if($res){
			$data['code']  	= 0;
			$data['msg'] 	= '操作成功';
		}else{
			$data['code'] 	= 1;
			$data['msg']	= '操作失败';
		}
		echo json_encode($data);
	}
	
	#提交操作
	public function update(){
		$id = $_REQUEST['{%$index_field%}'];
		$fields = $_POST;
		
		$res 	= app_service('{%$mod%}', '{%$mods%}')->update($id, $fields);
		$data = array(
			'code' => '',
			'data' => $res,
			'msg' => '',
		);

		if($res){
			$data['code']  	= 0;
			$data['msg'] 	= '操作成功';
		}else{
			$data['code'] 	= 1;
			$data['msg']	= '操作失败';
		}
		echo json_encode($data);
	}

	#删除操作
	public function delete(){
		$id 	= $_REQUEST['{%$index_field%}'];

		$res 	= app_service('{%$mod%}', '{%$mods%}')->delete($id);
		$data = array('code' => '', 'msg' => '' );
		if($res){
			$data['code'] = 0;
			$data['msg'] = '操作成功';
		}else{
			$data['code'] = 1;
			$data['msg'] = '操作失败';
		}
		echo json_encode($data);
	}



}


