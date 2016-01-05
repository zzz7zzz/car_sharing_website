<?php

//destroy cookie
function cleanCookie()
{
	$cookie_email = "email";
	unset($_COOKIE[$cookie_email]);
	setcookie($cookie_email, '', time()-3600,'/');

	$cookie_password = "password";
	unset($_COOKIE[$cookie_password]);
	setcookie($cookie_password, '', time()-3600,'/');
}

//connect to the database 1
function connDB()
{
	$conn = new mysqli("localhost", "zzengnin", 
						"Nopointhackingme!128", "zzengnin_raspberry");
						//zzeng9.rochestercs.org for MAMP
						//localhost for bluehost server
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	return $conn; 
}
?>
