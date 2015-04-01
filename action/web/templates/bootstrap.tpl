<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>页面</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0 " />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="http://www.bootcss.com/p/icheck/skins/all.css?v=0.8.0.3" rel="stylesheet">
<link href="http://dirts.github.io/dirts/js/css/icard.css" rel="stylesheet">
</head>
<body style="">

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand">logo</a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="active">
						<a href="">home</a>
					</li>
					<li>
						<a href="">about</a>
					</li>
					<li>
						<a href="">other</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid" style="margin-top:60px;height:1000px;">
	<div class="row-fluid">
		<div class="span2">
			<ul class="nav">
				<li><a href="#">goto</li>
				<li><a href="#">goto</li>
				<li><a href="#">goto</li>
				<li><a href="#">goto</li>
			</ul>
		</div>
		<div class="span10">
			<ul class="breadcrumb" style="margin-bottom: 5px;">
				<li><a href="#">首页</a> <span class="divider">/</span></li>
				<li><a href="#">Library</a> <span class="divider">/</span></li>
				<li class="active">Data</li>
			</ul>
			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Warning!</strong> Best check yo self, you're not looking too good.
			</div>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Warning!</strong> Best check yo self, you're not looking too good.
			</div>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Warning!</strong> Best check yo self, you're not looking too good.
			</div>
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Warning!</strong> Best check yo self, you're not looking too good.
			</div>
			<div class="btn-group" style="margin: 9px 0 5px;">
				<button class="btn">Left</button>
				<button class="btn">Middle</button>
				<button class="btn">Right</button>
			</div>
			<div class="progress progress-striped active">
				<div class="bar" style="width: 45%"></div>
			</div>
			<form>
				<div class="control-group error">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<input type="text" id="inputEmail" placeholder="Email">
					</div>
				</div>
				<div class="control-group info">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<input type="password" id="inputPassword" placeholder="Password">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">sex</label>
					<div class="controls">
						<div class="btn-group">
							<button class="btn dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Boy</a></li>
								<li><a href="#">Girl</a></li>
								<li class="divider"></li>
								<li><a href="#">GAY</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Content</label>
					<div class="controls">
						<textarea></textarea>
					</div>
					<span class="label label-success">标签一</span>&nbsp;&nbsp;
					<span class="label label-warning">标签二</span>
				</div>
				<div class="container-fluid">
				<div class="span2">
					<div class="" style="float:left"><input type="checkbox" name="choose" id="c-1"></div><label for="c-1">选项一</label>
				</div>
				<div class="span2">
					<div class="" style="float:left"><input type="checkbox" name="choose" id="c-2"></div><label for="c-2">选项一</label>
				</div>
				<div class="span2">
					<div class="" style="float:left"><input type="checkbox" name="choose" id="c-3"></div><label for="c-3">选项一</label>
				</div>
				<div class="span2">
					<div class="" style="float:left"><input type="checkbox" name="choose" checked disabled id="c-4"></div><label for="c-4">选项一</label>
				</div>
				</div>
				<div class="container-fluid">
				<div class="span2">
					<div class="" style="float:left"><input type="radio" name="achoose" id="r-1"></div><label for="r-1">选项一</label>
				</div>
				<div class="span2">
					<div class="" style="float:left"><input type="radio" name="achoose" id="r-2"></div><label for="r-2">选项一</label>
				</div>
				<div class="span2">
					<div class="" style="float:left"><input type="radio" name="achoose" id="r-3"></div><label for="r-3">选项一</label>
				</div>
				<div class="span2">
					<div class="" style="float:left"><input type="radio" name="achoose" checked disabled id="r-4"></div><label for="r-4">选项一</label>
				</div>
				</div>
			</form>
			<canvas id="myChart" width="400" height="400"></canvas>
			<a href="{U app="web/pdf"}" class="btn btn-success" action-type="act-logout" tabindex="1" onclick="return false;">EXPORT PDF</a>
		</div>
	</div>
</div>
<script src="http://dirts.github.io/dirts/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="http://dirts.github.io/dirts/js/jquery.idialog.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://www.bootcss.com/p/icheck/js/jquery.icheck.min.js?v=0.8.0.3" type="text/javascript"></script>
<script src="http://www.bootcss.com/p/chart.js/assets/Chart.js" type="text/javascript"></script>
<script type="text/javascript">
	{literal}
	;(function($){
		
		$('input').iCheck({
			checkboxClass : 'icheckbox_flat',
			radioClass : 'iradio_flat'
		});
		var data = [
			{
				value : 2,
				color : '#faafaa'
			},
			{
				value : 3,
				color : '#2345ee'
			},
			{
				value : 4,
				color : '#a235a2'
			},
			{
				value : 5,
				color : '#564a5e'
			}
		];

		var ctx = document.getElementById('myChart').getContext('2d');
		var myNewChart = new Chart(ctx).PolarArea(data);
		
		setTimeout(function(){
			var ctx = document.getElementById('myChart');
			var datauri = ctx.toDataURL();

			$(ctx).after('<img src="'+datauri+'">');
		}, 1000);

	}(jQuery));
	{/literal}
</script>
</body>
</html>
