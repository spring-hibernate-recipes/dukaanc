<?php
	session_start();
	if (!isset($_SESSION["shopkeeperEmail"]) || !isset($_SESSION["emailAddress"])) {
		header("Location: index.php?login");
	}
?>
