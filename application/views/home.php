<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/home.css">
	<script type = 'text/javascript' src = "<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>

</head>
<body>
	<div class="mainapp">
		<div class="navbar">
			<div class="brand">
				<h2><b>eZIMBA</b><i>Hard</i>Ware.com</h2>
			</div>
			<div class="brand1">
				<h5><a href="#servicesid">Our Services</a></h5>
			</div>
			<div class="brand1">
				<h5><a href="#contactid"> Contact Us</a></h5>
			</div>
			<div class="brand1">
				<?php
if (!isset($_SESSION['userinfo'])) {
	echo "<h5>";
	echo anchor('customerlogin', 'Login Here');
	echo "</h5>";
} else {
	echo "<h5>";
	echo "ALREADY LOGGED IN";
	echo "</h5>";
}
?>
				}
			</div>
		</div>
		<div class="welcome">
			<h1 class="wel">WELCOME To The Best Online Construction System</h1>
			<div>
				<h1><?php echo anchor('products', 'CLICK Here TO SHOP NOW'); ?></h1>
			</div>
		</div>
		<div class="services" id="servicesid">
			<div class="serv1">
				<h2>Services</h2>
				<p>We Offer The Following services</p>
			</div>
			<div class="serv2">
				<div class="services1">
					<h5 class="h5A">Service-1</h5>
					<p class="pA">Get all your building materials delivered to your site with a few clicks.</p>
				</div>
				<div class="services1">
					<h5 class="h5A">Service-2</h5>
					<p class="pA">Get all your building materials delivered to your site with a few clicks.</p>
				</div>
				<div class="services1">
					<h5 class="h5A">Service-3</h5>
					<p class="pA">Get all your building materials delivered to your site with a few clicks.</p>
				</div>
				<div class="services1">
					<h5 class="h5A">Service-4</h5>
					<p class="pA">Get all your building materials delivered to your site with a few clicks.</p>
				</div>
			</div>
		</div>
		<div class="contact" id="contactid">
			<h2>Contact US</h2>
			<p>For Inquiries And Help</p>
			<div class="contact1">
				<div class="contact2">
					<input type="text" placeholder="* Your Name" />
					<input type="text" placeholder="* Your Email" />
					<input type="text" placeholder="* Your Phone Number" />
					<textarea placeholder="** Your Message"></textarea>
				</div>
				<div>
					<button>SEND MESSAGE</button>
				</div>
			</div>
		</div>
		<div class="footer">
			<div>
				<h3>Copyright eZIMBAHardWare.com</h3>
			</div>
			<div style="display: flex;">
				<h3>COOKIES POLICY</h3>
				<h3>Terms Of Use</h3>
				<h3>About Us</h3>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function (){
		$(".footer").hover(function(){
			$(this).toggleClass("jscssfooter");
		});
		$(".navbar").hover(function(){
			$(this).toggleClass("jscssnavbar");
		});
	});
</script>
</html>