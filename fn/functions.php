<?php
include_once ('config.php');
function connect() {
	global $db_username, $db_password, $db_server, $db_name;
	$mysqli = mysqli_connect ( "$db_server", "$db_username", "$db_password", "$db_name" );
	return $mysqli;
}
function query($sql) {
	$con = connect ();
	$res = mysqli_query ( $con, $sql );
	$result = array ();
	while ( $record = mysqli_fetch_assoc ( $res ) ) {
		$result [] = $record;
	}
	mysqli_close ( $con );
	return $result;
}
function update($sql) {
	$con = connect ();
	$res = mysqli_query ( $con, $sql );
	mysqli_close ( $con );
	return $res;
}
function save($sql) {
	$con = connect ();
	mysqli_query ( $con, $sql );
	$id = mysqli_insert_id ( $con );
	mysqli_close ( $con );
	return $id;
}
?>
