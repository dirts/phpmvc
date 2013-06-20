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
		$name = basename($file);
		$newname = strtolower(time().'_'.$name);
		$res = copy(ROOTDIR.$file, ROOTDIR.$dir.$newname);
		if($res) return $dir.$newname;
		else return $res;
	}

}
?>
