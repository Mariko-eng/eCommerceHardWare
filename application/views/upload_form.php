<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error; ?>

<?php echo form_open_multipart('upload/do_upload'); ?>
<br/>
<input type="text" name="asd"><br/>
<input type="file" name="userfile" size="1000" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>