<?php
class galleryService extends Service{
		
	function upload($url){

		$dir = '/upload/';
		$file = $this->move($url, $dir);
		$web_model 	= $this->model('gallery');
		if($file){
			$info 		= $web_model->table('upload')->upload($file);
			return $info;
		}
	}
	
	function get_list(){
		$web_model 	= $this->model('gallery');
		return	$info 		= $web_model->table('upload')->get_list();
	}
	
	function move($file, $dir){
		#basename 函数获取文件名
		#pathinfo 可以获取路径:dirname，文件名:basename，扩展名:extension
		$name = basename($file);
		$newname = strtolower(time().'_'.$name);
		$res = copy(ROOTDIR.$file, ROOTDIR.$dir.$newname);
		if($res) return $dir.$newname;
		else return $res;
	}

}
?>
