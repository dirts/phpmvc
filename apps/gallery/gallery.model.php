<?php
class webModel extends Model{

	function get_users(){
		//$info = $this->where('author_id = 2')->select('author');
		$info = $this->select('author');
		/*
		$insert = $this->insert(array(
			'author_last'		=> 'shouyan',
			'author_first'		=> 'li',
			'country'			=> 'USA',
		));
		*/
		
		/*
		$this->where('author_id = 1')->update(array(
			'author_last'		=> 'wan',
			'author_first'		=> 'li',
			'country'			=> 'USA',
		));
		*/
		return $info;	
	}
	
	function login($username, $password){
		$info = $this->where('username = "'.$username. '" and password = ' . $password)->select('user');
		return $info;	
	}

}

?>
