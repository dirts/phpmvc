<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>页面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="http://sync_sy.zhisland.com:8080/static/core/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<script src="static/seajs/dist/sea.js" type="text/javascript" id="seajsnode"></script>
<script type="text/javascript">
{literal}
	
	seajs.config({
		base : 'http://istatic.deving.zhisland.com/static/',
		alias: {
			'jquery' : 'core/js/jquery-1.8.0.min.js'
		}
	});

	seajs.use('hello/src/main.js');
{/literal}
</script>
</body>
</html>
