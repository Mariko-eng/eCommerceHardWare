<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>
<?php
$pic = "lady1.png";
?>


<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>
<img src = "<?php echo $loc; ?>" alt="Photo"/><br>
<?php
$aa = base_url();
$bb = 'uploads/';
$cc = $loc1;
$dd = $aa . "" . $bb . "" . $cc;
?>
<br/>
<img src = "<?php echo $dd; ?>" alt="Photo2"/><br>



<p>Ekintu : <?php echo $loc; ?></p>
</body>
</html>