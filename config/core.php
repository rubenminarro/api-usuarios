<?php
	// show error reporting
	error_reporting(E_ALL);
	
	// set your default time-zone
	date_default_timezone_set('America/Santiago');
	
	// variables used for jwt
	$key = "A185234CADAFC6313A85B95C91709603D9A58426F2D92B7E90AE8EACDD1D8FBE";
	$issued_at = time();
	$expiration_time = $issued_at + (60 * 60); // valid for 1 hour
	//$issuer = "";
?>