<?php
include_once ('functions.php');

$emailAddress = $_REQUEST ['emailAddress'];
$password = $_REQUEST ['password'];

$result = query ( "select * from customer where emailAddress='$emailAddress' and password='$password'" );
if ($result != null && count ( $result ) > 0) {
	$_SESSION ["city"] = $result [0] ["city"];
	$_SESSION ["emailAddress"] = $emailAddress;
	$_SESSION ["customerName"] = $result [0] ["name"];
	$_SESSION ["order"] = array ();
	$_SESSION ["orderAmount"] = 0;
	header ( 'Location: shopSelection.php' );
} else {
	header ( 'Location: index.php?err' );
}
?>
