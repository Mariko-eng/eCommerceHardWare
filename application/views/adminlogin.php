<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style.css">
	<script type = 'text/javascript' src = "<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>

</head>
<body>
	<div class ="container">
		<div class = "sec-container" id ="trigger">
			<h2 style="color:brown;">Login Here!</h2>
			<?php echo validation_errors(); ?>
			<form method="post">
				<h2 style="color: purple;">UserName</h2>
				<input type = "text" name="admin_name" autocomplete="OFF" />
				<h2 style="color: green;">Password</h2>
				<input type = "password" name="admin_pass" autocomplete="OFF" />
				<br/><br/>
				<button type="submit" name ="admin_loginSubmit"
				value ="submit" style="color: white; background-color: brown; border-radius: 20%;">
			LOGIN ADMIN</button>
	    	</form>

	    	<div style="color: brown;">
<?php
$datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
$time = time();
echo mdate($datestring, $time);
?>
			</div>
		</div>
	</div>
</body>
</html>