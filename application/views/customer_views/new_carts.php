<!DOCTYPE html>
<html lang="en">
<head>
<title>...eZimba#ardWare</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sublime project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/js/jquery-3.5.1.min.js"></script>
<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>myassets/styles/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/styles/ezimba_cart_css.css">
<link rel="stylesheet" type="text/css" href = "<?php echo base_url(); ?>myassets/styles/cart_responsive.css">
</head>
<body>
<div class="super_container">

	<!-- Header -->

	<header class="header">
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
<?php
$homelink = base_url('ezimba/welcome');
$allproductslink = base_url('ezimba/allproducts');
$cartlink = base_url('ezimba/cartitems');
$checkoutlink = base_url('ezimba/checkout');
?>
							<div class="logo"><a href="<?=$homelink?>">...eZimba#ardWare</a></div>							<nav class="main_nav">
								<ul>
									<li class="hassubs active">
										<a href="<?=$homelink?>">Home</a>
										<ul>
											<li><a href="<?=$allproductslink?>">Products</a></li>
											<li><a href="<?=$cartlink?>">Cart</a></li>
											<li><a href="<?=$checkoutlink?>">Check out</a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="categories.html">Categories</a>
										<ul>
											<li><a href="categories.html">Category</a></li>
											<li><a href="categories.html">Category</a></li>
											<li><a href="categories.html">Category</a></li>
											<li><a href="categories.html">Category</a></li>
											<li><a href="categories.html">Category</a></li>
										</ul>
									</li>
									<?php
if (isset($_SESSION['userinfo'])) {
	$user = $_SESSION['userinfo'];
	$name = $user['fname'];
	$loglink = base_url('ezimba/logout');
} else {
	$loglink = base_url('ezimba/login');
}
?>
<?php if (isset($_SESSION['userinfo'])): ?>
	<li><a href="<?=$loglink?>"><?=$name?> : LOG OUT!</a></li>
<?php else: ?>

	<li><a href="<?=$loglink?>">LOGIN HERE!</a></li>
<?php endif?>
								</ul>
							</nav>
							<div class="header_extra ml-auto">
								<div class="shopping_cart">

									<?php
$cartlink = base_url("ezimba/cartitems");
?>
									<a href="<?=$cartlink?>">
										<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 viewBox="0 0 489 489" style="enable-background:new 0 0 489 489;" xml:space="preserve">
											<g>
												<path d="M440.1,422.7l-28-315.3c-0.6-7-6.5-12.3-13.4-12.3h-57.6C340.3,42.5,297.3,0,244.5,0s-95.8,42.5-96.6,95.1H90.3
													c-7,0-12.8,5.3-13.4,12.3l-28,315.3c0,0.4-0.1,0.8-0.1,1.2c0,35.9,32.9,65.1,73.4,65.1h244.6c40.5,0,73.4-29.2,73.4-65.1
													C440.2,423.5,440.2,423.1,440.1,422.7z M244.5,27c37.9,0,68.8,30.4,69.6,68.1H174.9C175.7,57.4,206.6,27,244.5,27z M366.8,462
													H122.2c-25.4,0-46-16.8-46.4-37.5l26.8-302.3h45.2v41c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h139.3v41
													c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h45.2l26.9,302.3C412.8,445.2,392.1,462,366.8,462z"/>
											</g>
										</svg>
										<div class="cartNo">Cart
											<?php if (isset($_SESSION['cart_data'])): ?>
												<span>(
													<?php
$no_of_cartItems = count($_SESSION['cart_data']);
echo $no_of_cartItems;
?>
												)</span>
											<?php else: ?>
												<span>(
													<?php
$no_of_cartItems = 0;
echo $no_of_cartItems;
?>
												)</span>
											<?php endif?>
										</div>
									</a>
								</div>
								<div class="search">
									<div class="search_icon">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 475.084 475.084" style="enable-background:new 0 0 475.084 475.084;"
										 xml:space="preserve">
										<g>
											<path d="M464.524,412.846l-97.929-97.925c23.6-34.068,35.406-72.047,35.406-113.917c0-27.218-5.284-53.249-15.852-78.087
												c-10.561-24.842-24.838-46.254-42.825-64.241c-17.987-17.987-39.396-32.264-64.233-42.826
												C254.246,5.285,228.217,0.003,200.999,0.003c-27.216,0-53.247,5.282-78.085,15.847C98.072,26.412,76.66,40.689,58.673,58.676
												c-17.989,17.987-32.264,39.403-42.827,64.241C5.282,147.758,0,173.786,0,201.004c0,27.216,5.282,53.238,15.846,78.083
												c10.562,24.838,24.838,46.247,42.827,64.234c17.987,17.993,39.403,32.264,64.241,42.832c24.841,10.563,50.869,15.844,78.085,15.844
												c41.879,0,79.852-11.807,113.922-35.405l97.929,97.641c6.852,7.231,15.406,10.849,25.693,10.849
												c9.897,0,18.467-3.617,25.694-10.849c7.23-7.23,10.848-15.796,10.848-25.693C475.088,428.458,471.567,419.889,464.524,412.846z
												 M291.363,291.358c-25.029,25.033-55.148,37.549-90.364,37.549c-35.21,0-65.329-12.519-90.36-37.549
												c-25.031-25.029-37.546-55.144-37.546-90.36c0-35.21,12.518-65.334,37.546-90.36c25.026-25.032,55.15-37.546,90.36-37.546
												c35.212,0,65.331,12.519,90.364,37.546c25.033,25.026,37.548,55.15,37.548,90.36C328.911,236.214,316.392,266.329,291.363,291.358z
												"/>
										</g>
									</svg>
									</div>
								</div>
								<div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Search Panel -->
		<div class="search_panel trans_300">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="search_panel_content d-flex flex-row align-items-center justify-content-end">
							<form action="#">
								<input type="text" class="search_input" placeholder="Search" required="required">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Social -->
		<div class="header_social">
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu menu_mm trans_300">
		<div class="menu_container menu_mm">
			<div class="page_menu_content">

				<div class="page_menu_search menu_mm">
					<form action="#">
						<input type="search" required="required" class="page_menu_search_input menu_mm" placeholder="Search for products...">
					</form>
				</div>
				<ul class="page_menu_nav menu_mm">
					<li class="page_menu_item has-children menu_mm">
						<a href="index.html">Home<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<li class="page_menu_item menu_mm"><a href="categories.html">Categories<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="product.html">Product<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="cart.html">Cart<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="checkout.html">Checkout<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="contact.html">Contact<i class="fa fa-angle-down"></i></a></li>
						</ul>
					</li>
					<li class="page_menu_item has-children menu_mm">
						<a href="categories.html">Categories<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<li class="page_menu_item menu_mm"><a href="categories.html">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.html">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.html">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.html">Category<i class="fa fa-angle-down"></i></a></li>
						</ul>
					</li>
					<li class="page_menu_item menu_mm"><a href="index.html">Accessories<i class="fa fa-angle-down"></i></a></li>
					<li class="page_menu_item menu_mm"><a href="#">Offers<i class="fa fa-angle-down"></i></a></li>
					<li class="page_menu_item menu_mm"><a href="contact.html">Contact<i class="fa fa-angle-down"></i></a></li>
				</ul>
			</div>
		</div>

		<div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>

		<div class="menu_social">
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>

	<!-- Cart Info -->

	<div class="cart_info" style="padding-top:150px; ">
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Column Titles -->
					<div class="cart_info_columns clearfix">
						<div class="cart_info_col cart_info_col_product">Product</div>
						<div class="cart_info_col cart_info_col_quantity">Quantity</div>
						<div class="cart_info_col cart_info_col_price">Price</div>
						<div class="cart_info_col cart_info_col_total"> Sub Total</div>
					</div>
				</div>
			</div>
			<div class="row cart_items_row">
				<div class="col">
					<?php
if (isset($_SESSION['cart_data'])) {
	$cart = $_SESSION['cart_data'];
	$total = 0;
}
?>
<?php if (isset($_SESSION['cart_data'])): ?>

					<?php foreach ($cart as $cart_item): ?>
						<?php
$aa = base_url();
$bb = 'uploads/';
$cc = $cart_item['Image'];
$dd = $aa . "" . $bb . "" . $cc;
?>
<?php
$total = $total + $cart_item['sub_total'];
?>
						<!-- Cart Item -->
					<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start 	justify-content-start">
						<!-- Name -->
						<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
							<div class="cart_item_image">
								<div><img src= "<?=$dd?>" alt=""></div>
							</div>
							<div class="cart_item_name_container">
								<div class="cart_item_name">
									<a href="#"><?=$cart_item['Name']?></a>
								</div>
							</div>
						</div>

						<!-- Quantity -->
						<div class="cart_item_quantity">
							<div class="update_order_qty" style="color: green; cursor: pointer; margin-bottom: 5px;">
								Update Order Quantity
							</div>
							<input type="number" name="" value = "<?=$cart_item['Quantity']?>">
							<div style="display: none;"><?=$cart_item['ProductID']?></div>
							<div class="cart_item_delete cart_item_edit" style="color: red; cursor: pointer; margin-top: 20px;">
								Delete Item From Cart !!!
							</div>
							<div class="productid" style="display: none;"><?=$cart_item['Name']?></div>
						</div>
						<!-- Price -->
						<div class="cart_item_price"><?=$cart_item['Price']?></div>
						<!-- Total -->
						<div class="cart_item_total"><?=$cart_item['sub_total']?></div>
					</div>

					<?php endforeach?>
				</div>
			</div>

			<div class="row row_cart_buttons">
				<div class="col">
					<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="button continue_shopping_button">
							<a href="<?php echo base_url('ezimba/allproducts'); ?>">
							Continue shopping</a></div>
						<div class="cart_buttons_right ml-lg-auto">
							<div class="button clear_cart_button"><a href="#">Clear cart</a></div>
							<div class="button update_cart_button cart_sum"
							style="font-size: large; padding-top: 15px;">TOTAL : <?=$total?></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row row_extra">
				<div class="col-lg-4">

					<!-- Delivery -->
					<div class="delivery">
						<div class="section_title">Shipping method</div>
						<div class="section_subtitle">Select the one you want</div>
						<div class="delivery_options">
							<label class="delivery_option clearfix">Next day delivery
								<input type="radio" name="radio">
								<span class="checkmark"></span>
								<span class="delivery_price">$4.99</span>
							</label>
							<label class="delivery_option clearfix">Standard delivery
								<input type="radio" name="radio">
								<span class="checkmark"></span>
								<span class="delivery_price">$1.99</span>
							</label>
							<label class="delivery_option clearfix">Personal pickup
								<input type="radio" checked="checked" name="radio">
								<span class="checkmark"></span>
								<span class="delivery_price">Free</span>
							</label>
						</div>
					</div>
				</div>

				<div class="col-lg-6 offset-lg-2">
					<div class="cart_total">
						<div class="section_title">Cart total</div>
						<div class="section_subtitle">Final info</div>
						<div class="cart_total_container">
							<ul>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Subtotal</div>
									<div class="cart_total_value ml-auto cart_sum1">Shs<?=$total?></div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Shipping</div>
									<div class="cart_total_value ml-auto">Free</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Total</div>
									<div class="cart_total_value ml-auto cart_sum2">Shs<?=$total?></div>
								</li>
							</ul>
						</div>
						<?php
$checkoutlink = base_url('ezimba/checkout');
?>
						<?php if ($total > 0): ?>
							<div class="checking_out button checkout_button">
								<a href="<?=$checkoutlink?>">Proceed to checkout</a>
							</div>
						<?php endif?>
					</div>
				</div>
			</div>

<?php else: ?>
	<h3>Cart is Empty</h3>
<?php endif?>

		</div>
	</div>

	<!-- Footer -->

	<div class="footer_overlay"></div>
	<footer class="footer">
		<div class="footer_background" style="background-image:url(<?php echo base_url('myassets/images/footer.jpg'); ?>)"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="footer_content d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
						<div class="footer_logo"><a href="#">...eZimba#ardWare</a></div>
						<div class="copyright ml-auto mr-auto"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
						<div class="footer_social ml-lg-auto">
							<ul>
								<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.cart_item').find('.update_order_qty').click(function(){
			var pID = $(this).next().next().text();
			var qty = $(this).next().val();
			var price = $(this).parent().next().text();
			var sub_total = qty * parseInt(price);
			$(this).parent().next().next().text(sub_total);

			$.ajax({
				type:"POST",
				url : "<?php echo base_url('ezimba/updatecartitemqty'); ?>",
				data : { PID : parseInt(pID), Qty : qty }
			});

			var main_total = 0;
			c_len = $('.cart_item_total').length;
			for(var i = 0; i < c_len; i++){
				var vl = $('.cart_item_total')[i].innerText;
				main_total = main_total + parseInt(vl);
			}

			$('.cart_sum').text('Shs ' + main_total);
			$('.cart_sum1').text('Shs ' + main_total);
			$('.cart_sum2').text('Shs ' + main_total);
		});

		$('.cart_item').find('.cart_item_delete').click(function(e){
			var self = this;
			var item = $(this).next().text();

			$.ajax({
				type:"POST",
				url : "<?php echo base_url('ezimba/removeitemfromcart'); ?>",
				data : { prod : item },
				dataType : "JSON",
				success : function(response){
					alert(response.isdelete);
					$(self).parent().parent().remove();

					cc_len = $('.cart_item_total').length;
					$('.cartNo').text("Cart (" + cc_len + ")");
					var main_total = 0;
					for(var i = 0; i < cc_len; i++){
						var vl = $('.cart_item_total')[i].innerText;
						main_total = main_total + parseInt(vl);
					}

					$('.cart_sum').text('Shs ' + main_total);
					$('.cart_sum1').text('Shs ' + main_total);
					$('.cart_sum2').text('Shs ' + main_total);

					if(main_total <= 0){
						$('.checking_out').remove();
					}
				}
			});

		});
	});
</script>

<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/styles/bootstrap4/popper.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/styles/bootstrap4/bootstrap.min.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/plugins/greensock/TweenMax.min.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/plugins/greensock/TimelineMax.min.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/plugins/greensock/animation.gsap.min.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/plugins/greensock/ScrollToPlugin.min.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/plugins/easing/easing.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/plugins/parallax-js-master/parallax.min.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>myassets/js/cart.js"></script>
</body>
</html>