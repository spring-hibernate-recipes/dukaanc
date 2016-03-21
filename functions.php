<?php
// error_reporting ( E_ALL );
// ini_set ( 'display_errors', 1 );
include_once ('config.php');
session_start ();
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
function select($sql, $valueColumn, $optionColumn, $def) {
	$result = query ( $sql );
	foreach ( $result as $row ) {
		if ($row[$valueColumn] == $def) {
			echo "<option selected=\"selected\" value=\"$row[$valueColumn]\">$row[$valueColumn]</option>";
		}
		echo "<option value=\"$row[$valueColumn]\">$row[$valueColumn]</option>";
	}
}
function show($name, $ret = false) {
	if (isset($_REQUEST [$name])) {
		echo $_REQUEST [$name];
	}
	else {
		echo "";
	}
	if ($ret) {
		return $_REQUEST[$name];
	}
}
function checkNotNull($paramNames) {
	foreach ($paramNames as $paramName) {
		if (!isset($_REQUEST[$paramName]) || $_REQUEST[$paramName] == '') {
			throw new Exception("$paramName cannot be left blank");
		}
	}
}
?>
