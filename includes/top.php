<?php
	include_once("includes/config.php");	
	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password, $db_name) or die("Unable to connect to MySQL");
	include_once("includes/functions/function.php");
?>