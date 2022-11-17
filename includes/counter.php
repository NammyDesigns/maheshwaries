<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ASHA Trust</title>
</head>
	<body>
		<?php
		//include("includes/top.php");
			include_once("includes/config.php");
			$dbhandle = mysql_connect($hostname, $username, $password, $db_name) 
				or die("Unable to connect to MySQL");
						
				//select a database to work with
				$selected = mysql_select_db("ashadb",$dbhandle) or die("Could not select ashadb");
				
				 //Adds one to the counter
				 mysql_query("UPDATE counter SET counter = counter + 1");
				
				 //Retreives the current count
				 $count = mysql_fetch_row(mysql_query("SELECT counter FROM counter"));
				
				 //Displays the count on your site
				 print "<b>$count[0]</b>";
			?> 
	</body>
</html>
