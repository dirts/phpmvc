<ul>
{foreach from=$fields item=field key=key}
	<li>
		{$field.Field} - {$field.Type} - {$field.Null} - {$field.Comment}
	</li>
{/foreach}
</ul>
