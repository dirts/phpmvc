<?php /* Smarty version 2.6.26, created on 2013-06-25 10:38:21
         compiled from list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'U', 'list.tpl', 16, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>页面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="http://sync_sy.zhisland.com:8080/static/core/css/bootstrap.css" rel="stylesheet">
<link href="http://sync_sy.zhisland.com:8080/static/core/js/icard/css/jquery.icard.css" rel="stylesheet">
</head>
<body>
<div class="header" style="padding:2px;position:fixed;z-index:9;backgroud:#fafafa;box-shadow:0 2px 2px #999;background:#fff;width:100%;top:0px;">
	<?php echo $this->_tpl_vars['lang']['welcome']; ?>
 <b><?php echo $this->_tpl_vars['info'][0]['author_first']; ?>
 <?php echo $this->_tpl_vars['info'][0]['author_last']; ?>
</b>   <?php echo $this->_tpl_vars['lang']['now']; ?>
 <b><?php echo $this->_tpl_vars['time']; ?>
</b>
	<a href="javascript:;" class="btn btn-success" action-type="act-comfirm" tabindex="1"><?php echo $this->_tpl_vars['lang']['tan']; ?>
</a>
	<a href="javascript:;" class="btn btn-success" action-type="act-alert" tabindex="1"><?php echo $this->_tpl_vars['lang']['alert']; ?>
</a>
	<a href="javascript:;" class="btn btn-success" action-type="act-message" tabindex="1"><?php echo $this->_tpl_vars['lang']['msg']; ?>
</a>
	<a href="javascript:;" class="btn btn-danger" action-type="act-error" tabindex="1"><?php echo $this->_tpl_vars['lang']['error']; ?>
</a>
	<a href="<?php echo URL(array('app' => "web/api",'param' => $this->_tpl_vars['param']), $this);?>
" class="btn btn-success" action-type="act-api" tabindex="1"><?php echo $this->_tpl_vars['lang']['api']; ?>
</a>
	<a href="javascript:;" class="btn btn-success" action-type="act-upload" tabindex="1">上传图片</a>
	<a href="<?php echo URL(array('app' => "web/logout"), $this);?>
" class="btn btn-success" action-type="act-logout" tabindex="1" onclick="return false;">登出</a>
</div>
<div class="container">
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<img src="<?php echo $this->_tpl_vars['item']['url']; ?>
" width="100"/>&nbsp;
<?php endforeach; endif; unset($_from); ?>
</div>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery.form.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/<?php echo $this->_tpl_vars['lang']['lang']; ?>
.lang.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/jquery.icard.js" type="text/javascript"></script>
<script src="static/web/web.js" type="text/javascript"></script>
</body>
</html>