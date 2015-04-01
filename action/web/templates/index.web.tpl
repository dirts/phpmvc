<include file="../Public/header.bootstrap" />
<ul class="breadcrumb anti-radius i-shadow">
	<li><a href="#">首页</a> <span class="divider">/</span></li>
	<li class="active">列表</li>
</ul>
<div class="container-fluid">
	<div class="fluid">
		<div class="nav clearfix">
			<form class="float-left clearall" action="{:U('admin/{%$mod%}/index')}" method="post">
			<div class="input-append clearall">
				<input class="span2" type="text" name="uname">
				<input class="btn" type="submit" value="Search">
			</div>
			</form>
			<a href="{:U('admin/{%$mod%}/create')}" class="btn btn-success float-right">新增</a>
		</div>
	</div>
	<table class="table table-striped table-hover table-bordered">
		<col align="center" class="zhisland-table-num" />
		<col align="left" />
		<col align="right" />
		<col align="right" />
		<tr>
			{%foreach from=$fields item=field key=key %}
			<th>{%$field['Field']%}</th>	
			{%/foreach%}
			<th>操作</th>
		</tr>
		<volist id="item" name="data.data" key="key">
  		<tr>
			{%foreach from=$fields item=field key=key %}
			<td>{$item['{%$field['Field']%}']}</td>	
			{%/foreach%}
			<td>
				<a href="{:U('admin/{%$mod%}/edit', array( '{%$index_field%}' => $item['{%$index_field%}'] ))}"><i class="icon-edit"></i>编辑</a>
				<a href="{:U('admin/{%$mod%}/delete', array( '{%$index_field%}' => $item['{%$index_field%}'] ))}" action-type="action-del" onclick="return false;"><i class="remove"></i>删除</a>
			</td>
		</tr>
		</volist>
	</table>
	<div class="pagination clearfix">
		<ul>{$data.html}</ul>
	</div>
</div>
<include file="../Public/core.js" />
<script type="text/javascript" src="__STATIC__/admin/{%$mods%}/js/{%$mods%}.core.js"></script>
<include file="../Public/foot.bootstrap" />
