<?php
	include_once('auth.php');
	include_once('functions.php');

	$shopkeeperEmail = $_REQUEST["shopkeeperEmail"];
	$catId = $_REQUEST["id"];

	$sql = "select * from product where sellerEmail='$shopkeeperEmail' and categoryId='$catId' and stock > 0";
	$result = query($sql);

	header("Content-Type: application/json");
	echo json_encode($result);
?>
