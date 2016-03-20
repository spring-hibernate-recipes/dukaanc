<?php
include_once ('auth.php');
include_once ('functions.php');

$shopkeeperEmail = $_SESSION ["shopkeeperEmail"];

$sql = "select * from product where sellerEmail='$shopkeeperEmail' and stock > 0 limit 20";
$result = query ( $sql );

header ( "Content-Type: application/json" );
echo json_encode ( $result );
?>
