Dirt@PHP
======

## 模仿TP框架和minisystem框架，整体分为:

* Action.class.php
* Service.class.php
* Model.class.php

 其中action处理和返回页面，service层负责处理实际业务逻辑，model负责读写数据.

## index.php?mod=mod&act=act 为具体模块的地址

    <?php
    namespace Dirt\Action\Web;
    
    class Index extends \Dirt\Lib\Action {
    
        public function run() {
            $this->smarty();
            //接受参数
            $name = $this->get('name', '咋办项目组smarty:hello world!');
            $this->assign('name', '咋办软件项目租');
            $this->display('index.tpl');
        }
    }
    
    ?>

## Action.class.php 目前拥有方法(调用 smarty 方法):

	$this->assign('data', $data);
	$this->display('tempname.tpl');
	# 请求service的方法
	$this->service('mod');

## Service.class.php 拥有方法:

	$mod = $this->model('mod');
	$mod->method();

## 登陆验证和页面跳转

	* 增加了登陆验证
	* 增加了页面跳转
