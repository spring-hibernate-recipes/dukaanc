<?php
include_once ('auth.php');
include_once ('functions.php');

$shopkeeperEmail = $_REQUEST ["shopkeeperEmail"];
$sql = "select id, name from category where shopkeeperEmail='$shopkeeperEmail'";
$result = query ( $sql );

header ( "Content-Type: application/json" );
echo json_encode ( $result );
?>
