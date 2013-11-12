<?php

class webService extends Service{
	
	function get_users(){
		$web_model 	= $this->model('web');
		$info 		= $web_model->get_users();
		return $info;
	}
	
	function login($username, $password){
		$web_model 	= $this->model('web');
		$info 		= $web_model->login($username , $password);
		return $info;
	}

	function get_fields_info($table){
		$web_model 	= $this->model('web');
		$info 		= $web_model->get_fields_info($table);
		return $info;
	}

	function pin($arr){
		$web_model 	= $this->model('web');
	
		$web_model->pin($arr[0], $arr[1]);
		if(count($arr) == 3){
			$web_model->pin($arr[0], $arr[2]);
		}
	}

	function get_citys(){
		$web_model 	= $this->model('web');
		return $web_model->get_citys();	
	}
	
	function city_pinyins($citys){
		
		$web_model 	= $this->model('web');
		foreach($citys as $city){
			$pinyin = '';
			$id = $city['area_id'];
			$name = $city['title'];
			
			$num = $this->strlen_utf8($name);

			$f = mb_substr($name,0,1);
			$p = $web_model->get_pin($f);
			if($p){
				$p = mb_substr($p, 0, 1);
				$web_model->set_pin($id, $p);
			}else{
				var_dump($f);
			}
		}
	}

	function city_fixed($citys){
		$web_model 	= $this->model('web');
		foreach($citys as $city){
			if(preg_match('/市$/', $city['local_name'])){
				$name = preg_replace('/市$/', '', $city['local_name']);
				$web_model->city_fixed($city['id'], $name);
			}
		}	
	}

	function strlen_utf8($str){
			$i = 0;
			$count = 0;
			$len = strlen($str);
			while($i < $len){
					$chr = ord($str[$i]);
					$count ++ ;
					$i ++ ;
					if($i >=$len)break;
					if($chr & 0x80){
							$chr <<=1;
							while($chr & 0x80){
									$i++;
									$chr <<=1;
							}
					}
			}
			return $count;
	}
}

?>
