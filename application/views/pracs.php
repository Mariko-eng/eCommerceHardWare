<!DOCTYPE html>
<html lang="en">
<head>
<title>...eZimba#ardWare</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sublime project">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="padding: 100px;">
<div style="display: flex; flex-direction: column;">
	<div style="display: flex; flex-direction: row;" class="item">
		<div class="prix" style="margin: 10px;">Rice</div>
		<select class="sel">
			<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
		</select>
		<div class="prix" style="margin: 10px;">200</div><div class="sub_total">Sub-total : </div>
	</div>
	<div style="display: flex; flex-direction: row;" class="item">
		<div class="prix" style="margin: 10px;">Matooke</div>
		<select class="sel">
			<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
		</select>
		<div class="prix" style="margin: 10px;">500</div><div class="sub_total">Sub-total : </div>
	</div>
	<div style="display: flex; flex-direction: row;" class="item">
		<div class="prix" style="margin: 10px;">Beans</div>
		<select class="sel">
			<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
		</select>
		<div class="prix" style="margin: 10px;">700</div><div class="sub_total">Sub-total : </div>
	</div>
	<div class="total">Total: </div>
</div>
<div class="one" style="margin:20px;">
	<div class="one1" style="margin:20px; background: blue;">
		<div class="one12">
			<button>ONE1</button>
		</div>
		<div class="one11">5</div>
		<div class="one22">10</div>
	</div>
	<div class="one1" style="margin:20px; background: pink;">
		<div class="two1">15</div>
		<div class="two2">20</div>
	</div>
</div>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.item').find('.sel').change(function(){
			var s = $(this).val();
			var p = $(this).next().text();
			var sub = s * parseInt(p)
			$(this).next().next().html("<div class='sub_total'>Sub-total :"+ sub +"</div>");
			alert(s + " " + p + " "+sub);
		});
		$('.one1 > .one12').find('button').click(function(){
			var a = $(this).parent().next().text();
			var b = $(this).parent().parent().next().find('.two1').text();
			// var a = $(this).next().text();
			// var b = $(this).parent().next().find('.two1').text();
			alert(a +" -> "+ b);
		});
	});
</script>
</body>
</html>