<?php

/*
	reCaptcha::setSecretKey('your key');
	reCaptcha::sendAndCheck($_POST['g-recaptcha-response'])); // boolean
	reCaptcha::$response // txt
	
*/

class reCaptcha {
	
	private static $secretKey 		= '';
	private static $hostname 		= 'https://www.google.com/recaptcha/api/siteverify';
	public static  $response 		= '';
	
	public static function setSecretKey($key = '') {
		self::$secretKey = $key;
	}
	
	public static function sendAndCheck($googleData) {
	
		// method post
		$ch = curl_init(self::$hostname);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'secret='.self::$secretKey.'&response='.$googleData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_exec($ch);

		$result 	= curl_multi_getcontent ($ch); // json
		$json 		= json_decode($result);
		
		self::$response = $result;
		curl_close ($ch);
		
		if($json->success) return true; else return false;
	}
	
	// static!
	private function __construct() {} 
}

?>
