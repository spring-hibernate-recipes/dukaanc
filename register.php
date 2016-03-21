<?php
	include_once 'functions.php';

	try {
		checkNotNull(array("name", "emailAddress", "contactNumber", "password", "retypePassword"));
	}
	catch (Exception $exception) {
		$_SESSION["msg"] = $exception->getMessage();
		include_once 'signUp.php';
	}
	$name = $_REQUEST['name'];
	$emailAddress = $_REQUEST['emailAddress'];
	$address = $_REQUEST['address'];
	$city = $_REQUEST['city'];
	$locality = $_REQUEST['locality'];
	$contactNumber = $_REQUEST['contactNumber'];
	$password = $_REQUEST['password'];
	$retypePassword = $_REQUEST['retypePassword'];
	if ($password != $retypePassword) {
		$_SESSION["msg"] = 'Passwords do not match..<br>';
		include_once 'signUp.php';
		exit();
	}
	$result = query("select * from customer where emailAddress='$emailAddress'");
	if (count($result) > 0) {
		$_SESSION["msg"] = 'This Email ID is already registered. Click <a href="index.php">here</a> to log in or <a href="forgotPassword.php">here</a> if you have forgotten your password..<br>';
		include_once 'signUp.php';
		exit();
	}
	
	$result = save("insert into customer(name, address, contactNumber, emailAddress, city, locality, password) values ('$name', '$address', '$contactNumber', '$emailAddress', '$city', '$locality', '$password')");
	$_SESSION["msg"] = "Registration successful. Now login to continue.<br>";
	
	header('Location: index.php');
?>