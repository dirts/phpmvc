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

}

?>
