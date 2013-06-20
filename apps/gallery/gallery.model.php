<?php
class galleryModel extends Model{

	function upload($url){
		$insert = $this->insert(array(
			'url'		=> $url,
		));
		
		/*
		$this->where('author_id = 1')->update(array(
			'author_last'		=> 'wan',
			'author_first'		=> 'li',
			'country'			=> 'USA',
		));
		*/
		return $insert;	
	}

	function get_list(){
		$list = $this->select('upload');
		return $list;
	}

	function login($username, $password){
	}

}

?>
