<?php
require_once "config.php";
require_once "reCaptcha.php";

if(!empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['txt'])) {
	
	// form
	$name 			= strip_tags(htmlspecialchars(urldecode($_POST['name'])));
	$lastname 		= strip_tags(htmlspecialchars(urldecode($_POST['lastname'])));
	$txt 			= strip_tags(htmlspecialchars(urldecode($_POST['txt'])));
	$googleFormData = strip_tags(htmlspecialchars(urldecode($_POST['g-recaptcha-response']))); // google data
	
	
	/* ============== */
	
	reCaptcha::setSecretKey(SECRET_KEY);
	$result = reCaptcha::sendAndCheck($googleFormData);

	if($result) {
		
		echo '<div style="color: green">Success!</div><br>';
		echo "Google response: ".reCaptcha::$response."<br><br>";
		echo "<b>Form data:</b><br>Name: ".$name."<br>Lastname: ".$lastname."<br>Text: ".$txt;
		
	} else echo 'fail';

	
	
} else echo "All fields must be filled!";
?>
