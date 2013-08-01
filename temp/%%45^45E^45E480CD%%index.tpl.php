<?php /* Smarty version 2.6.26, created on 2013-07-22 10:54:33
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'U', 'index.tpl', 33, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>页面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="static/core/css/bootstrap.css" rel="stylesheet">
<link href="static/core/js/icard/css/jquery.icard.css" rel="stylesheet">
<link href="static/zhisland/css/css.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand"></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="active">
						<a href="">首页</a>
					</li>
					<li>
						<a href="">名单</a>
					</li>
					<li>
						<a href="">设置</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<ul class="user-list">
	<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['user']):
?>
		<li><?php echo $this->_tpl_vars['key']; ?>
 - <?php echo $this->_tpl_vars['user']['name']; ?>
  : <?php echo $this->_tpl_vars['user']['mtime']; ?>
 - <?php echo $this->_tpl_vars['user']['dtime']; ?>
 <a href="javascript:;">编辑</a><a href="<?php echo URL(array('app' => "zhisland/del_user"), $this);?>
&uid=<?php echo $this->_tpl_vars['user']['id']; ?>
" >删除</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<form action="<?php echo URL(array('app' => "zhisland/add_user"), $this);?>
" method="post">
	<div class="input-prepend">
    	<span class="add-on">名字</span>
		<input class="span2" name="name" type="text">
	</div>
	<div class="input-prepend">
    	<span class="add-on">上班时间</span>
		<input class="span1" name="mtime" type="text">
	</div>
	<div class="input-prepend">
    	<span class="add-on">下班时间</span>
		<input class="span1" name="dtime" type="text">
	</div>
	<input type="submit" value="提交" class="btn btn-success">
	<a href="javascript:;" class="btn btn-success" action-type="act-form-submit">提交</a>
</form>
<script src="static/core/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="static/core/js/jquery.form.js" type="text/javascript"></script>
<script src="static/core/js/icard/jquery.icard.js" type="text/javascript"></script>
</body>
</html>