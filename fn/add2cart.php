<?php
session_start ();
include_once ('functions.php');

$order = $_SESSION ["order"];
$result = query ( "select id, name, unitPrice from product where id='$_REQUEST[pid]'" );
if ($result == null || count ( $result ) == 0) {
	echo "0";
} else {
	$qty = $_REQUEST ['qty'];
	$price = $result [0] ['unitPrice'];
	$id = $result [0] ['id'];
	$name = $result [0] ['name'];
	if ($order [$id] == null) {
		$order [$id] = array (
				"pid" => $id,
				"name" => $name,
				"qty" => $qty,
				"amnt" => $qty * $price 
		);
	} else {
		$order [$id] = array (
				"pid" => $id,
				"name" => $name,
				"qty" => $order [$id] ["qty"] + $qty,
				"amnt" => $order [$id] ["amnt"] + ($qty * $price) 
		);
	}
	$_SESSION ["order"] = $order;
	$_SESSION ["orderAmount"] += $_REQUEST ["qty"] * $price;
	echo "1";
}
?>
