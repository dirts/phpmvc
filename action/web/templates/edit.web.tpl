<include file="../Public/header.bootstrap" />
<ul class="breadcrumb anti-radius i-shadow">
	<li><a href="#">首页</a> <span class="divider">/</span></li>
	<li class="active">编辑</li>
</ul>
<div class="container-fluid">
	<if condition="$id">
		<form action="{:U('admin/{%$mod%}/update', array('{%$index_field%}' => $id ))}" method="post">
	<else />
		<form action="{:U('admin/{%$mod%}/add')}" method="post">
	</if>
	{%foreach from=$fields item=field %}
	<div class="control-group">
		<label class="control-label" for="inputWarning">
			{%$field['Field']%}:
		</label>
		<div class="controls">
			{%$field['html']%}
			<span class="help-inline muted">
				{%$field['Type']%} : {%$field['Comment']%}
			</span>
		</div>
	</div>
	{%/foreach%}
	<div class="control-group">
		<label class="control-label" for="inputWarning">
		</label>
		<div class="controls">
			<a href="javascript:;" class="btn btn-success" action-type="act-form-submit">提交</a>
			<input type="submit" class="btn btn-success" action-type="act-form-submit" value="提交"/>
		</div>
	</div>
	</form>
</div>
<include file="../Public/core.js" />
<script type="text/javascript" src="__STATIC__/admin/{%$mods%}/js/{%$mods%}.core.js"></script>
<include file="../Public/foot.bootstrap" />
