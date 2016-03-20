<?php
session_start ();
$itemId = $_REQUEST ["item"];
$order = $_SESSION ["order"];
$itemAmount = $order [$itemId] ["amnt"];
$_SESSION ["orderAmount"] = $_SESSION ["orderAmount"] - $itemAmount;
unset ( $order [$itemId] );
$_SESSION ["order"] = $order;
header ( "Location: ../cart.php" );
?>
