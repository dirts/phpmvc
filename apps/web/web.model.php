<?php
class webModel extends Model{

	function get_users(){
		$info = $this->select('author');
		return $info;	
	}

	
	function login($username, $password){
		$info = $this->where('username = "'.$username. '" and password = ' . $password)->select('user');
		return $info;	
	}

	#获取表自选信息
	function get_fields_info($table){
		$sql	= 'show full fields from '.$table;
		$res 	= $this->query($sql);
		return $res;
	}

	#生成汉字拼音对照表
	function pin($h, $p){
		//if( preg_match('/^\w+$/i', $p) ==0 ){
		//	var_dump($p);
		//};
		
		$sql	= "insert into pinyin (ch, pin) value ('$h', '$p')";
		$res 	=  $this->query($sql);
	}

	function get_citys(){
		$sql	= "select * from ts_area";
		$res 	=  $this->query($sql);
		return $res;
	}

	function get_pin($ch){
		$sql = "select pin from pinyin where ch like '%$ch%'";
		$res = $this->query($sql);

		if(is_null($res)) return false;
		if(count($res) > 1) $res = $res[0];
		return $res['pin'];
	}

	function set_pin($id,$p){
		$sql = "update ts_area set pinyin ='$p' where area_id= $id";
		$res = $this->query($sql);
	}

	function city_fixed($id, $name){
		$sql = "update ts_area set local_name ='$name' where id= $id";
		$res = $this->query($sql);
	}
}

?>
