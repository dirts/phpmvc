<?php
class GalleryAction extends Action {
	function index(){
		if(is_uploaded_file($_FILES['upload']['tmp_name'])){
			//图片临时存放路径在php.ini的uploa_temp_dir选项指定。
			$file 	=	'/data/'.$_FILES['upload']['name'];
			$res 	= move_uploaded_file($_FILES['upload']['tmp_name'], ROOTDIR.$file);
			if($res){
				$data = array(
					'code' 		=> 0,
					'message'	=> '上传成功',
					'data'		=> array(
						'img'	=> $file,
					),
				);
				echo json_encode($data);
			}
		}else{
				
		}
	}
}
?>
