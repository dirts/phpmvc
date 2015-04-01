<?php
class GalleryAction extends Action {
	
	#上传
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

	#保存
	function upload(){
		$url 				= $_REQUEST['url'];
		$gallery_service 	= $this->service('gallery');
		$info 				= $gallery_service->upload($url);
		if($info){
			$data = array(
				'code'=>0,
				'message'=>'成功',
			);
			echo json_encode($data);
		}
	}

}
?>
