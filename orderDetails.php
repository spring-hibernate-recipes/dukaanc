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
<?php

$sql = "select customer.name, customer.address, customer.locality, customer.city, customer.contactNumber, `order`.orderId, `order`.amount, `order`.createdDate, `order`.orderType, `order`.status from `order` join customer on `order`.customerEmail=customer.emailAddress where `order`.orderId='$_REQUEST[id]' and `order`.customerEmail='$emailAddress'";

$result = query ( $sql );

$orderId = $result [0] ["orderId"];
$orderItems = query ( "select product.name, orderItem.quantity, orderItem.amount from orderItem join product on orderItem.productId=product.id where orderId='$orderId'" );
?>
		<hr>
		<h2>Order date: <?php echo $result[0]["createdDate"]?></h2>
		<?php if ($result[0]["orderType"] == 1) {?>
			<span class="label label-default">Pick Up</span>
		<?php } else { ?>
			<span class="label label-default">Home Delivery</span>
		<?php }?>
		<?php if ($result[0]["status"] == 1) {?>
			<span class="label label-success">Placed</span>
		<?php } else if ($result[0]["status"] == 2) {?>
			<span class="label label-warning">Ready</span>
		<?php } else if ($result[0]["status"] == 3) {?>
			<span class="label label-primary">Done</span>
		<?php }?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Item</th>
					<th>Quantity</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ( $orderItems as $orderItem ) {
					?>
				<tr>
					<td><?php echo $orderItem["name"]?></td>
					<td><?php echo $orderItem["quantity"]?></td>
					<td><?php echo $orderItem["amount"]?></td>
				</tr>
				<?php
				}
				$orderAmnt = $result [0] ["amount"];
				echo "<tr>";
				echo "<td colspan=\"2\" style=\"text-align: right\">Total: Rs.</td>";
				echo "<td>$orderAmnt</td>";
				echo "</tr>";
				?>
			</tbody>
		</table>
	</div>
</body>
</html>
