<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/main.css">
	<script type = 'text/javascript' src = "<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$(".asd").click(function(){
			$(".xx").toggleClass("asdDisp");
		});

		$(".asd1").click(function(){
			$(".xx1").toggleClass("asdDisp");
		});

		$(".asd2").click(function(){
			$(".xx2").toggleClass("asdDisp");
		});

        // SEARCH BAR
		$("#name").keyup(function(){
			var txt = $("#name").val();
			$.ajax({
         type: "POST",
         url: "<?php echo base_url("customer/ajax_request"); ?>",
         data: {textbox: $("#name").val()},
         dataType: "text",
         cache:false,
         success:
              function(data){
                $("#results").html(data);
              }
          });
     return false;
 });
	});
</script>


</head>
<body>
	<div class="main">
		<div class="header-section">
				<div class="brand" style="flex-grow: 1; color:white; display: flex;">
					<h2><b>eZIMBA</b><i>Hard</i>Ware.com</h2>
					<div class="form__group field"
					style="display:flex; flex-direction: column; position: relative;">
						<input type="input" class="form__field"
						placeholder="Search for Item"
						name="name"
						id='name' autocomplete="off" />
						<div id = "results" style="position: absolute;width: inherit; top:2.5rem;
						min-height: 0px;background-color: white;"></div>
					</div>
				</div>
				<div class="brand-links2" style="display: flex; flex-direction: row;color:white;">
					<h5 style="margin-right:2rem;">
						<?php
echo anchor('ezimba/welcome', 'HOME'); ?>
					</h5>
					<h5 style="margin-right:2rem;">
						<?php
echo anchor('products', 'PRODUCTS'); ?>
					</h5>
					<h5 id ="cart" style="color:wheat;">
<?php
if (isset($_SESSION['admin_info'])) {
	if (!empty($_SESSION['admin_info'])) {
		echo "<span>";
		echo anchor('newproduct', 'ADD NEW PRODUCTS');
		echo "</span>";
		echo "<span style='padding-left:5px;color:red;'>";
		echo "<span>";
		echo anchor('adminlogout', 'LOGOUT HERE');
		echo "</span>";
	}
} else {
	if (isset($_SESSION['cart_data'])) {
		echo "<span>";
		$no_of_cartItems = count($_SESSION['cart_data']);
		echo $no_of_cartItems;
		echo "</span>";
	}
	echo anchor('displaycartitems', 'CART');
}
?>
					</h5>
				</div>
			</div>
		<div class="main-section">
