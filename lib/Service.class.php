<?php

class Service{

	function model($app){
		include_once(ROOTDIR.DS.APPS.$app.DS.$app.MODEL_PHP);
		$Model_Class = $app.'Model';
		$model = new $Model_Class();
		$model->init_sql();
		return $model;
	}

}

?>
