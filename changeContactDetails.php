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
	<div class="main-content" id="cartDiv">
		<h2>Change Address</h2>
		<hr>
		<?php $sql = "select * from customer where emailAddress='$emailAddress'";?>
		<?php $customerDetails = query($sql);?>
		<?php if ($customerDetails == null || count($customerDetails) == 0 ) {?>
			<span class="label label-danger">Customer Details not found. Please
			go back and retry.</span>
		<?php } else {?>
		<?php $customer = $customerDetails[0];?>
		<form action="doChangeContactDetails.php" method="POST">
			<div class="form-group">
				<label for="address">Address</label> <input class="form-control"
					id="address" name="address"
					value="<?php echo $customer["address"]?>">
			</div>
			<div class="form-group">
				<label for="locality">Locality</label> <input class="form-control"
					id="locality" name="locality"
					value="<?php echo $customer["locality"]?>">
			</div>
			<div class="form-group">
				<label for="city">City</label> <input class="form-control" id="city"
					name="city" value="<?php echo $customer["city"]?>">
			</div>
			<div class="form-group">
				<label for="contactNumber">Contact Number</label> <input
					class="form-control" id="contactNumber" name="contactNumber"
					value="<?php echo $customer["contactNumber"]?>">
			</div>
			<div class="form-group">
				<button class="btn btn-primary">Save Details</button>
			</div>
		</form>
		<?php }?>
	</div>
</body>
</html>

