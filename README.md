a PHP-MVC : Dirt
======

## 模仿TP框架和minisystem框架，整体分为:
 * Action.class.php
 * Service.class.php
 * Model.class.php

 其中action处理和返回页面，service层负责处理实际业务逻辑，model负责读写数据.

## index.php?mod=mod&act=act 为具体模块的地址

## Action.class.php 目前拥有方法(调用 smarty 方法):

	$this->assign('data', $data);
	$this->display('tempname.tpl');
	# 请求service的方法
	$this->service('mod');

## Service.class.php 拥有方法:
