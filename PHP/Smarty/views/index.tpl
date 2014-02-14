Name and age:
<br /><br />

{$date}
<table>
	{foreach from=$people key = k item = p}
	<tr style = "background: {cycle values = 'silver, grey'}">
		<td>{$k}</td>
		<td>{$p}</td>
	</tr>
	{/foreach}
</table>