<?php
 function say($what){
 	echo $what;
 }
 
function getPage($pageName)
{
 	global $dbhandle;
 	$selected = mysql_select_db("dbmaheshwaries",$dbhandle) or die("Could not select sdlaw");
	$result = mysql_query("SELECT matter FROM config where name='".$pageName."'");
	$row = mysql_fetch_array($result);						
	return ($row['matter']);					
 }
?>