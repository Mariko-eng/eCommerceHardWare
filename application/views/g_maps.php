<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type = 'text/javascript' src = "<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
	<?php echo $map['js']; ?>
</head>
<body>
	<input type="text" id="myPlaceTextBox" />
	<div>QWERTYS</div>
	<div style="width:600px; height:600px;">
<?php
echo $map['html'];
?>
	</div>

</body>
</html>
