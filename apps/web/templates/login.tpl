<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>登陆</title>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />
<link href="http://sync_sy.zhisland.com:8080/static/core/css/bootstrap.css" rel="stylesheet">
<link href="http://sync_sy.zhisland.com:8080/static/core/js/icard/css/jquery.icard.css" rel="stylesheet">
</head>
<body>
<div style="padding:100px;">
	<form action="index.php?mod=web&act=dologin" method="post" id="login">
		<input type="text" name="username" placeholder="输入用户名">
		<input type="password" name="password" placeholder="输入密码">
		<a href="javascript:;" class="btn btn-success" action-type="act-login">登陆</a>
	</form>
</div>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery.form.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/{$lang.lang}.lang.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/jquery.icard.js" type="text/javascript"></script>
<script src="static/web/login.js" type="text/javascript"></script>
</body>
</html>
