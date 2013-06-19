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
	<a href="{U app="web/logout"}" class="btn btn-success" action-type="act-logout" tabindex="1" onclick="return false;">登出</a>
</div>
<div>
<!--
{foreach from=$info item=items}
	{foreach from=$items item=item key=key}
		{$key} : <b>{$item}</b>&nbsp;&nbsp;
	{/foreach}
	</br>
{/foreach}
-->
<pre>
{literal}

	var $comfirm = $.comfirm('点击确认执行一个操作，点击取消什么都不做').close().onok(function(){
		alert('执行了一个操作'); 
	});

	$('a[action-type="act-comfirm"]').on('click', function(){
		$comfirm.show().align();
	});

	var $alert = $.alert('点击确认关闭提示').close();
	$('a[action-type="act-alert"]').on('click', function(){
		$alert.show().align();
	});
	
	$('a[action-type="act-message"]').on('click', function(){
		$.message('提示一个消息，之后消失');
	});
	
	$('a[action-type="act-error"]').on('click', function(){
		$.ierror('提示一个错误消息，点x关闭');
	});
	
	$('a[action-type]').each(function(){
		$text = $(this).text();
		$(this).itips({'class' : 'i-simple-tips', 'content' : $text });
	});
{/literal}
</pre>
</div>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/{$lang.lang}.lang.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/jquery.icard.js" type="text/javascript"></script>
<script src="static/web/web.js" type="text/javascript"></script>
</body>
</html>
