<?php

#打开一个文件
function open($file){
	if(file_exists($file) && is_file($file)) return file($file);
	else return null;
}

function read($file){
	if(file_exists($file) && is_file($file)) return file_get_contents($file);
	else return null;
}

#获取路径中的文件名部分
function get_file_name($path){
	if(file_exists($path) && is_file($path)) return basename($path);
	else return null;
}

#获取文件所在目录
function get_file_path($path){
	if(file_exists($path)) return dirname($path);
	else return null;
}

function get_extension($file){ 
	$info = pathinfo($file); 
	return $info['extension']; 
}

#创建文件夹
function makedir($dir){
	if(!file_exists($dir)) return mkdir($dir);
	else return false;
}

#创建目录(基本逻辑实现，待完善)
function maketree($path){
	$tree 	= explode('/', $path);
	$len	= count($tree);
	$tmp	= array();

	$tmp[] = $tree[0];
	for($i = 1; $i < $len; $i++){
		$tmp[] = $tree[$i];
		$d = join('/', $tmp);
		if(!file_exists($d)){
			$b = mkdir($d);
			if(!$b) return false;
		}
	}
	return true;
}

#写入文件
function file_write($file, $data, $frags = null, $context = null){
	return file_put_contents($file, $data, $frags, $context);
}

#创建文件
function file_create($file, $data = ''){
	if(file_exists($file)) return false;
	return touch($file);
}

#获取字段类型
function field_type($field, $type = null){
	$field_type 	= $field['Type'];
	$type = preg_match('/^(int|tinyint|mediumint|char|varchar|text)+(\((\d+)\)){0,1}/i', $field_type, $matches);
	return $matches;
}

#判断字段是否是主键
function is_primarykey($field){
	if($field['Extra'] == 'auto_increment') return true;
	return false;
}

function slice_fileds($fields, $offset, $len = null){
		
	//return array_slice($fields);
}

?>
