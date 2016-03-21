<?php
	include_once('functions.php');

	$location = $_REQUEST["loc"];
	$sql = "select name, emailAddress, address from shopkeeper where locality='$location'";
	$result = query($sql);

	header("Content-Type: application/json");
	echo json_encode($result);
?>
