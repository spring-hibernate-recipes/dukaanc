<?php
session_start ();
include_once 'functions.php';

$order = $_SESSION ["order"];
$type = $_REQUEST ["fulfilmentType"];
$customerEmail = $_SESSION ["emailAddress"];
$shopkeeperEmail = $_SESSION ["shopkeeperEmail"];
$amount = $_SESSION ["orderAmount"];

if ($type == "homeDelivery") {
	$type = 1;
	$cust = query ( "select address, locality, city from customer where emailAddress='$customerEmail'" ) [0];
	$address = $cust ["address"] . ", " . $cust ["locality"] . ", " . $cust ["city"];
} else {
	$shopkeeper = query ( "select address, locality, city from shopkeeper where emailAddress='$shopkeeperEmail'" ) [0];
	$type = 2;
	$address = $shopkeeper ["address"] . ", " . $shopkeeper ["locality"] . ", " . $shopkeeper ["city"];
}
$orderId = save ( "insert into `order` (customerEmail, shopkeeperEmail, amount, createdDate, status, address, orderType) values ('$customerEmail', '$shopkeeperEmail', '$amount', now(), '1', '$address', '$type')" );

foreach ( $order as $orderItem ) {
	save ( "insert into orderItem (orderId, productId, quantity, amount, status) values ('$orderId', '$orderItem[pid]', '$orderItem[qty]', '$orderItem[amnt]', '1')" );
}

if ($orderId) {
	$_SESSION ["address"] = $address;
	$_SESSION ["orderType"] = $type;
}
$_SESSION ["order"] = array ();
$_SESSION ["orderAmount"] = 0;
header ( "Location: ../orderSuccess.php" );
?>
