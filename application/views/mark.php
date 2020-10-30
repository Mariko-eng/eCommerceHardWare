<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">
	body {
		margin: 0 auto;
	}
	.header{
		display: flex;
		height: 5rem;
		background: blue;
		padding-left: 2rem;
		padding-right: 2rem;
	}
	.brand{
		flex-grow: 4;
	}
	.about{
		flex-grow: 2;
	}
	.contact{
		flex-grow: 2;
	}
	</style>
</head>
<body>
	<div class="header">
		<div class="brand">
			eConnect
		</div>
		<div class="about">
			About
		</div>
		<div class="contact">
			Contact Us
		</div>
	</div>
	<?php echo ENVIRONMENT ?>
	<?php set_cookie("name", "Mariko", '3600');?>
</body>
</html>