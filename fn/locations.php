<?php
	include_once('auth.php');
	include_once('functions.php');
	
	$city = $_REQUEST["city"];

	$sql = "select distinct(locality) from shopkeeper where city='$city'";
	$result = query($sql);

	header("Content-Type: application/json");
	echo json_encode($result);
?>
