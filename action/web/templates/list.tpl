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
	{$lang.welcome} <b>{$info[0].author_first} {$info[0].author_last}</b>   {$lang.now} <b>{$time}</b>
	<a href="javascript:;" class="btn btn-success" action-type="act-comfirm" tabindex="1">{$lang.tan}</a>
	<a href="javascript:;" class="btn btn-success" action-type="act-alert" tabindex="1">{$lang.alert}</a>
	<a href="javascript:;" class="btn btn-success" action-type="act-message" tabindex="1">{$lang.msg}</a>
	<a href="javascript:;" class="btn btn-danger" action-type="act-error" tabindex="1">{$lang.error}</a>
	<a href="{U app="web/api" param=$param}" class="btn btn-success" action-type="act-api" tabindex="1">{$lang.api}</a>
	<a href="javascript:;" class="btn btn-success" action-type="act-upload" tabindex="1">上传图片</a>
	<a href="{U app="web/logout"}" class="btn btn-success" action-type="act-logout" tabindex="1" onclick="return false;">登出</a>
</div>
<div class="container">
	{foreach from=$list item=item}
		<img src="{$item.url}" width="100"/>&nbsp;
	{/foreach}
</div>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery.form.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/{$lang.lang}.lang.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/jquery.icard.js" type="text/javascript"></script>
<script src="static/web/web.js" type="text/javascript"></script>
</body>
</html>
