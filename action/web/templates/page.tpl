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
	<a href="javascript:;" class="btn btn-mini btn-success" action-type="act-upload" tabindex="1">上传图片</a>
	<a href="{U app="web/logout"}" class="btn btn-mini btn-success" action-type="act-logout" tabindex="1" onclick="return false;">登出</a>
</div>
<div>
</div>
<div>
{foreach from=$tables item=table key=key}
		{$key} : 
		{foreach from=$table item="item"}
			<label><input type="radio" name="tablename" value="{$item}"> {$item}</label>
		{/foreach}
	</br>
{/foreach}
</div>
<a href="javascript:;" class="btn btn-success" action-type="act-create-page" tabindex="1">创建页面</a>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/jquery.form.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/{$lang.lang}.lang.js" type="text/javascript"></script>
<script src="http://sync_sy.zhisland.com:8080/static/core/js/icard/jquery.icard.js" type="text/javascript"></script>
<script src="static/web/page.js" type="text/javascript"></script>
</body>
</html>
