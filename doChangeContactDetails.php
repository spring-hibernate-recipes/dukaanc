<?php
include_once 'functions.php';

$shopkeeperEmail = $_SESSION ["shopkeeperEmail"];
$emailAddress = $_SESSION ["emailAddress"];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport"
	content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ezShoppe</title>
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<?php include_once('jquery.php');?>
<?php include_once('bootstrap.php');?>
<?php include_once('stylesheets.php');?>
<script>
	$(document).ready(function() {
		$.get('fn/categoriesByShop.php?shopkeeperEmail=<?php echo $shopkeeperEmail;?>', function(response){
			var html = '<ul class="nav navbar-nav">';
			$.each(response, function(k, row){
				html += '<li><a href="cat.php?id=' + (k + 1) + '">' + row['name'] + '</a></li>';
			});
			html += '</ul>';
			$('#bs-example-navbar-collapse-1').prepend(html);
		});
	});
</script>
</head>
<body>
	<?php include_once 'header.php';?>
	<div class="main-content">
	<?php $address = $_REQUEST["address"];?>
	<?php $city = $_REQUEST["city"];?>
	<?php $locality = $_REQUEST["locality"];?>
	<?php $contactNumber = $_REQUEST["contactNumber"];?>
	<?php $sql = "update customer set address='$address', city='$city', locality='$locality', contactNumber='$contactNumber' where emailAddress='$emailAddress'";?>
	<?php $result = update($sql);?>
	<?php if ($result) {?>
		<h2>Contact Details were successfully updated.</h2>
	<?php }else {?>
		<h2 style="color: #ff0000;">Contact Details could not be updated.
			Please contact administrator.</h2>
	<?php }?>
	<hr>
	<a class="btn btn-primary" href="home.php">Go back to Home</a>
	</div>
</body>
</html>

