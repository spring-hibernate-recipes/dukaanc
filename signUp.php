<?php
include_once 'functions.php';
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
	$('#city').change(function(e){
 		$.get('fn/locations.php?city=' + $(this).val(), function(data){
			var html = '';
			$.each(data, function(k, val){
				if (val['locality'] == "<?php show("locality")?>") {
					html += '<option selected="selected">' + val['locality'] + '</option>';
				}
				else {
					html += '<option>' + val['locality'] + '</option>';
				}
			});
			$('#locality').append(html);
		});
	});
});
</script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php"
					style="font-family: 'Bevan', cursive"><span style="color: #ff0000">e</span>Dukaan</a>
			</div>
		</div>
	</nav>
	<div class="main-content" style="padding-top: 70px;">
		<h2>
			New User - Sign Up <span style="color: #ff0000"><?php echo $_SESSION["msg"]; $_SESSION["msg"] = "";?></span>
		</h2>
		<hr>
		<form method="POST" action="register.php" class="form form-horizontal">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="name">Full Name</label>
				<div class="col-sm-10">
					<input class="form-control" name="name" id="name"
						value="<?php show("name")?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="emailAddress">Email
					Address</label>
				<div class="col-sm-10">
					<input class="form-control" name="emailAddress" id="emailAddress"
						value="<?php show("emailAddress")?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="contactNumber">Mobile
					Number</label>
				<div class="col-sm-10">
					<input class="form-control" name="contactNumber" id="contactNumber"
						value="<?php show("contactNumber")?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="address">Address</label>
				<div class="col-sm-10">
					<input class="form-control" name="address" id="address"
						value="<?php show("address")?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="city">City</label>
				<div class="col-sm-10">
					<select class="form-control" name="city" id="city">
						<option>-</option>
					<?php select("select distinct(city) from shopkeeper order by city asc", "city", "city", show("city", true))?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="locality">Locality</label>
				<div class="col-sm-10">
					<select class="form-control" name="locality" id="locality">
						<option>-</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="password">Password</label>
				<div class="col-sm-10">
					<input class="form-control" name="password" id="password"
						type="password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="retypePassword">Retype
					Password</label>
				<div class="col-sm-10">
					<input class="form-control" name="retypePassword" type="password"
						id="retypePassword">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="submitBtn">&nbsp;</label>
				<div class="col-sm-10">
					<button class="btn btn-primary" id="submitBtn">Register</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>

