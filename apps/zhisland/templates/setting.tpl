<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>页面</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="static/core/css/bootstrap.css" rel="stylesheet">
<link href="static/core/js/icard/css/jquery.icard.css" rel="stylesheet">
<link href="static/zhisland/css/css.css" rel="stylesheet">
<link href="static/core/css/calendar.css" rel="stylesheet">
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
<div id="calendar"></div>
<div>当前日期: {$time}</div>
<a href="javascript:;" action-type="act-clear" class="btn btn-success">清除日期选择</a>
<a href="javascript:;" action-type="act-select" class="btn btn-success">确定选择日期</a>
<script src="static/core/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="static/core/js/jquery.form.js" type="text/javascript"></script>
<script src="static/core/js/icard/jquery.icard.js" type="text/javascript"></script>
<script src="static/core/js/yahoo-dom-event.js" type="text/javascript"></script>
<script src="static/core/js/calendar.js" type="text/javascript"></script>
<script type="text/javascript">
{literal}

	YAHOO.namespace("example.calendar");
	YAHOO.example.calendar.init = function() {
		YAHOO.example.calendar.cal1 = new YAHOO.widget.Calendar("cal1","calendar", { MULTI_SELECT: true } );

		YAHOO.example.calendar.cal1.render();
	}
	YAHOO.util.Event.onDOMReady(YAHOO.example.calendar.init);


	;(function($){
		
		$('a[action-type="act-clear"]').on('click', function(){
			YAHOO.example.calendar.cal1.clear();
		});

		$('a[action-type="act-select"]').on('click', function(){
			var select = YAHOO.example.calendar.cal1.select();
			var temp = [];	
			
			for(var i = 0; i < select.length; i++){
				temp[i] = (select[i].getMonth()+1) + '-' +  (select[i].getDate());
			}

			var time = temp.join(',');
			var $url = '/index.php?mod=zhisland&act=up_time';
			
			$.post($url, {'time': time}, function(json){
				console.log(json);
			});
		
		});
		
	}(jQuery));

{/literal}
</script>
</body>
</html>
