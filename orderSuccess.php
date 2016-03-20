<?php
include_once 'config.php';
session_start ();
if (! isset ( $_SESSION ["orderType"] )) {
	header ( 'Location: home.php' );
}
$shopkeeperEmail = $_SESSION ["shopkeeperEmail"];
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
	<div
		style="position: fixed; top: 0px; width: 100%; z-index: 100000; background-color: #fff">
		<h2 style="font-family: 'Bevan', cursive; padding-left: 20px;">
			<span style="color: #ff0000">e</span>Dukaan
		</h2>
<?php include_once 'navbar.php';?>
</div>
	<div class="main-content" id="cartDiv">
			<?php
			echo "<h2>Order placed successfully.</h2>";
			if (isset ( $_SESSION ["orderType"] )) {
				if ($_SESSION ["orderType"] == 1) {
					echo "<h4>You order would be delivered to:</h4>";
				} else {
					echo "<h4>Please pick up your order from:</h4>";
				}
				echo "<hr>";
				echo "<h4>" . $_SESSION ["address"] . "</h4>";
				unset ( $_SESSION ["orderType"] );
				unset ( $_SESSION ["address"] );
			}
			?>
		</div>
</body>
</html>

