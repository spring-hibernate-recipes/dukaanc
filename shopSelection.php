<?php
$city = $_SESSION ["city"];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport"
	content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ezShoppe :: Customer</title>
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<?php include_once('jquery.php');?>
<?php include_once('bootstrap.php');?>
<?php include_once('stylesheets.php');?>
<link rel="stylesheet" href="style-index.css">
<script type="text/javascript" src="functions.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$.get('fn/locations.php', function(response){
			var html = '';
			$.each(response, function(k, row){
				html += '<option>' + row['locality'] + '</option>';
			});
			$('#control1').append(html);
		});
		$('#control1').change(function(){
			var locality = $(this).val();
			var html = '';
			$.get('fn/shopByLocation.php?loc=' + locality, function(response){
				$.each(response, function(k, row) {
					html += ('<option value="' + row['emailAddress'] + '">' + row['name'] + ', ' + row['address'] + '</option>');
				});
				$('#control2').append(html);
			});
		});
	});
</script>
</head>
<body>
	<div class="container container-table">
		<div class="row vertical-center-row">
			<div style="text-align: center">
			<?php if(isset($_REQUEST["err"])){echo "Email Address/Password invalid. Please retry.<br>";} ?>
			</div>
			<div class="text-center col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" style="font-family: 'Bevan', cursive">
							<span style="color: #ff0000">e</span>Dukaan
						</h3>
					</div>
					<div class="panel-body">
						<form id="form0" method="post" action="home.php">
							<div class="form-group">
								<label for="control1">Choose Location</label> <select
									name="location" class="form-control" id="control1">
									<option>-</option>
								</select>
							</div>
							<div class="form-group">
								<label for="control2">Choose Shopkeeper</label> <select
									name="shopkeeperEmail" class="form-control" id="control2">
									<option>-</option>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary" id="proceedBtn">Continue</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
