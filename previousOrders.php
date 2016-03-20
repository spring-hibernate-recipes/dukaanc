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
		<h2>Previous Orders</h2>
		<hr>
		<?php
		$sql = "select * from `order` where customerEmail='$emailAddress' and shopkeeperEmail='$shopkeeperEmail'";
		$orders = query ( $sql );
		if ($orders == null || count ( $orders ) <= 0) {
			echo "You do not have any previous orders with this shopkeeper.<br>";
			echo '<a href="home.php" class="btn btn-primary">Home</a>';
		} else {
			?>
<table class="table table-striped">
			<tbody>
		<?php foreach ($orders as $order) {?>
		<?php
				if ($order ["orderType"] == 1) {
					$order ["orderType"] = '<span class="label label-default">Pick Up</span>';
				} else if ($order ["orderType"] == 2) {
					$order ["orderType"] = '<span class="label label-default">Home Delivery</span>';
				}
				if ($order ["status"] == 1) {
					$order ["status"] = '<span class="label label-success">Placed</span>';
				} else if ($order ["status"] == 2) {
					$order ["status"] = '<span class="label label-warning">Ready</span>';
				} else if ($order ["status"] == 3) {
					$order ["status"] = '<span class="label label-primary">Done</span>';
				}
				?>
			<tr>
					<td><b>Date: </b><?php echo $order["createdDate"];?>&nbsp;<?php echo $order["status"];?>&nbsp;<?php echo $order["orderType"];?><br> <b>Amount: </b>INR. <?php echo $order["amount"];?><br>
						<div style="text-align: right"><a href="orderDetails.php?id=<?php echo $order["orderId"];?>">Details</a></div>
					</td>
				</tr>
		<?php }?>
	</tbody>
		</table>
		<?php }?>
	</div>
</body>
</html>

