<?php
class ZhislandModel extends Model{

	function get_users(){
		$info = $this->select('ts_user');
		return $info;	
	}
	
	function user_exists($name){
		$res = $this->where('name = \''.$name.'\'')->select('ts_user');
		return $res;
	}
	
	function add_user($user){
		$info = $this->table('ts_user')->insert($user);
		return $info;
	}

	function up_time($date){
		$return = $this->table('ts_time')->where('id = 1')->update(array( 'data' => $date));
		return $return;
	}

	function get_time(){
		$return = $this->where('id = 1')->select('ts_time');
		return $return;
	}
	
	function del_user($uid){
		return $this->table('ts_user')->where('id = '. $uid)->del();
	}

}
?>
