<html>
<head>
<title>jQuery Count Checked Checkboxes Examples </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
<p>
<label>
<input type="checkbox" name="fruits[]" class="fruits" value="apple" id="fruits_0">
Apple</label>
<br>
<label>
<input type="checkbox" name="fruits[]" class="fruits" checked="checked" disabled="disabled" value="mango" id="fruits_1">
Mango</label>
<br>
<label>
<input type="checkbox" name="fruits[]" class="fruits" value="grapes" id="fruits_2">
Grapes</label>
<br>
</p>

<p id="t" /></p>

<script type="text/javascript">
$(document).ready(function() {
	$('.fruits').click(function(){
		var a= ($("input:checkbox:checked:not(:disabled)").length );
		document.getElementById("t").innerHTML = a*0.5;
	});
});
</script>
</body>
</html>

<form action='https://dictionary.cambridge.org/search/british/direct/?utm_source=widget_searchbox_source&utm_medium=widget_searchbox&utm_campaign=widget_tracking' target="_blank" method='post'> 
	<table style='font-size:10px;background:#292929;border-collapse:collapse;border-spacing:0;width:150px;' > 
		<tbody> 
			
			<tr> 
				<td style='width:68px;background:none;border:none;padding:4px;'> 
					<input style='width:100%;display:block;font-size:10px;padding:2px;border:none;' id='comment' name='q' /> 
				</td> 
				<td style='width:50px;background:none;border:none;padding:0 4px 0 0;'> 
					<input style='width:100%;display:block;font-size:10px;padding:2px;border:none;float:right;background:#d0a44c;' type='submit' value='Look it up' /> 
				</td> 
			</tr> 
		</tbody> 
	</table> 
</form>

