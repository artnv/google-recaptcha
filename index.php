<?php
	require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Google reCaptcha</title>
	<link rel="stylesheet" href="main.css">
	
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="ajaxForm.js"></script> <!-- you can delete this file - ajaxForm.js -->
	
</head>
<body>
	<div class="main">
	
	<form method="post" action="post.php" id="form">
		<input type="text" id="name" name="name" placeholder="Name" autofocus  required><br>
		<input type="text" id="lastname" name="lastname" placeholder="Lastname"  required>
		<textarea id="txt" name="txt" placeholder="Text" required></textarea>
		
		<div id="cpt" class="g-recaptcha" data-sitekey="<?php echo KEY;?>"></div>
		
		<input type="submit" id="submit"><span id="status"></span>
	</form>

	<div id="res"></div>
	</div><!--/main-->
</body>
</html>
