<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>页面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/static/core/css/bootstrap.css" rel="stylesheet">
<link href="/static/core/js/icard/css/jquery.icard.css" rel="stylesheet">
</head>
<body>
	<div class="container-fluid">
		<div class="alert alert-success">
			<strong>使用方法:</strong></br>
			<pre>
			#代码生成地址
			http://lishouyan.static.deving.zhisland.com/index.php?mod=web&act=fs</pre>
			文件地址: 
			<pre>
			/home/lishouyan/wwwroot/static.zhisland.com/alpha/apps/web/web.action.php fs()</pre>
			配置: 
			<pre>
			#选择环境 在李守岩的开发环境下生成代码
			$dev    = '/home/lishouyan/wwwroot/www.zhisland.com/alpha';

			#模块名字 index.php?app=admin&mod=Mtest&act=index 模块名字决定了您生成的代码具体要访问的链接地址
			$mod    = 'Mtest';

			#表名 ts_user
			$table  = 'user';
			</pre>
			<strong>生成文件:</strong></br>
			<pre>
			{%foreach from=$files item=file key=key %}
{%$file['path']%}   
			{%/foreach%}
			</pre>
		</div>
	</div>
<script src="static/core/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="static/core/js/jquery.form.js" type="text/javascript"></script>
<script src="static/core/js/icard/jquery.icard.js" type="text/javascript"></script>
<script src="static/web/web.js" type="text/javascript"></script>
</body>
</html>


