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
				html += '<li><a href="cat.php?id=' + row['id'] + '">' + row['name'] + '</a></li>';
			});
			html += '</ul>';
			$('#bs-example-navbar-collapse-1').prepend(html);
		});
		$.get('fn/productsByCategory.php?shopkeeperEmail=<?php echo $shopkeeperEmail;?>&id=<?php echo $catId;?>', function(response){
			var products = '';
			var count = 0;
			$.each(response, function(k, row){
				if (!row['imageUrl']) {
					row['imageUrl'] = 'prodimages/product.png';
				}
				else {
					row['imageUrl'] = "../prodImages/" + row['imageUrl'] + "_thumb.jpg";
				}
				var productDetails = '<div class="col-md-2" style="margin: 20px; height: 330px;"><div style="margin: 10px 0px; text-align: center; height: 40px;"><b>' + row['name'] + '</b></div><img class="img-fluid center-block" alt="product" src="' + row['imageUrl'] + '"><div style="margin: 10px 0px; text-align: center"><b>Price:</b><span style="color: red"> ' + row['unitPrice'] + ' Rs/' + row['unit'] + '</span></div><div style="margin: 10px 0px; text-align: center"><form id="add2cart' + count + '" class="addToCartForm form form-inline" style="display: inline-block"><input type="hidden" id="pid' + count + '" value="' + row['id'] + '"><input class="form-control" id="qty' + count + '" style="width: 5em; float: left"><label style="line-height: 2.5em;" for="qty' + count + '">&nbsp;' + row['unit'] + '&nbsp;</label><input type="submit" class="btn btn-primary" value="Add" style=" float: right" id="add2CartBtn' + count + '"></form></div></div>';
				products += productDetails;
				count++;
			});
			$('#productsDisplay').html(products);
			for (i=0; i<count; i++) {
				$('#add2CartBtn' + i).click(function(e){
					e.preventDefault();
					var id = parseInt($(this).attr("id").replace('add2CartBtn', ''));
					var qty = $('#qty' + id).val();
					var pid = $('#pid' + id).val();
					$.get("fn/add2cart.php?pid=" + pid + "&qty=" + qty, function(response){
						if (response == "1") {
							alert('Product added to cart.');
						}
					});
				});
			}
		});
	});
</script>
</head>
<body>
	<?php include_once 'header.php';?>
	<div class="main-content" id="productsDisplay"></div>
</body>
</html>

