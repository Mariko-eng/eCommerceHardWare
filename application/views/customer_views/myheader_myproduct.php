<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/js/jquery-3.5.1.min.js"></script>
	<title>eZimba#ardWare...</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Sublime project">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>myassets/styles/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css"  href = "<?php echo base_url(); ?>myassets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/styles/common.css">
	<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/styles/product.css">
	<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/styles/product_responsive.css">

</head>
<body>
<script type="text/javascript">
	$(document).ready(function(){
		$(".product_quantity_container").find('button').click(function(){
			var pid = $(".product_quantity_container").find('input').val();
			$.ajax({
			type:'POST',
			url : "<?php echo base_url('ezimba/addcartitem'); ?>",
			data:{pID: pid},
			dataType : "JSON",
			success : function(response){
				// var dt =  response.names.map(name => "<p>" +name+"</p>");
				// alert(dt);
				$(".product_quantity_container").find('.button').text(response.status);
				}
			});
		});
	});
</script>

