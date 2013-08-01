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
	{foreach from=$users item=user key=key}
		<li>{$key} - {$user.name}  : {$user.mtime} - {$user.dtime} <a href="javascript:;">编辑</a><a href="{U app="zhisland/del_user"}&uid={$user.id}" >删除</a></li>
	{/foreach}
</ul>
<form action="{U app="zhisland/add_user"}" method="post">
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
