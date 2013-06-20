<?php
class GalleryAction extends Action {
	function index(){
		echo '<pre>';
		var_dump($_FILES);
		echo '</pre>';
		if(is_uploaded_file($_FILES['upload']['tmp_name'])){
			//图片临时存放路径在php.ini的uploa_temp_dir选项指定。
			$res = move_uploaded_file($_FILES['upload']['tmp_name'], ROOTDIR.'/data/'.$_FILES['upload']['name']);
			var_dump($res);
		}   
	}
}
?>
