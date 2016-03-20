<?php
include_once 'config.php';
session_start ();
$shopkeeperEmail = $_SESSION ["shopkeeperEmail"];
$catId = $_REQUEST ["id"];
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
		$('.removeCartLink').click(function(e){
			e.preventDefault();
			var item = $(this).attr("id").replace("removeCartLink", "");
			var response = confirm("Are you sure you want to remove item from cart?");
			if (response) {
				window.location = 'fn/removefromcart.php?item=' + item;
			}
		});
	});
</script>
</head>
<body>
	<?php include_once 'header.php';?>
	<div class="main-content" id="cartDiv">
		<h2>Shopping Cart</h2>
		<hr>
		<form method="post" action="fn/confirmOrder.php">
			<div style="text-align: right">
				<label for="fulfilmentType1"><input type="radio" checked="checked"
					value="pickup" name="fulfilmentType" id="fulfilmentType1">Pick Up</label>&nbsp;&nbsp;
				<label for="fulfilmentType2"><input type="radio"
					value="homeDelivery" name="fulfilmentType" id="fulfilmentType2">Home
					Delivery</label>&nbsp;&nbsp;
				<button type="submit" class="btn btn-primary" id="confirmButton">Confirm
					Order</button>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th style="width: 60%">Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
<?php
$order = $_SESSION ["order"];
$count = 1;
foreach ( $order as $row ) {
	echo '<tr>';
	echo '<td>' . $row ["name"] . '</td>';
	echo '<td>' . $row ["qty"] . '</td>';
	echo '<td>' . $row ["amnt"] . '</td>';
	echo '<td><a href="#" class="removeCartLink" id="removeCartLink' . $row ["pid"] . '">Remove</a></td>';
	echo '</tr>';
	$count ++;
}
echo '<tr>';
echo '<td></td>';
echo '<td style="text-align: right"><b>Total</b></td>';
echo "<td>$_SESSION[orderAmount]</td>";
echo "<td></td>";
echo '</tr>';
?>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>

