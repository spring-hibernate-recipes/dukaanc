<?php
	session_start();
	unset($_SESSION['shopkeeperEmail']);
	unset($_SESSION['emailAddress']);
	header('Location: index.php');
?>
