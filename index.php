<?php include_once 'functions.php';?>
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
</script>
</head>
<body>
	<div class="container container-table">
		<div class="row vertical-center-row">
			<div style="text-align: center">
			<?php if(isset($_REQUEST["err"])){echo "Email Address/Password invalid. Please retry.<br>";} ?>
			<?php if(isset($_SESSION["msg"])){echo "$_SESSION[msg]"; unset($_SESSION["msg"]);} ?>
			</div>
			<div class="text-center col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" style="font-family: 'Bevan', cursive">
							<span style="color: #ff0000">e</span>Dukaan
						</h3>
					</div>
					<div class="panel-body">
						<form id="form0" method="post" action="authenticate.php">
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label> <input
									type="email" name="emailAddress" class="form-control"
									id="exampleInputEmail1" placeholder="Email">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label> <input
									type="password" name="password" class="form-control"
									id="exampleInputPassword1" placeholder="Password">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary" id="loginBtn">Login</button>
								&nbsp;&nbsp;<a href="signUp.php" class="btn btn-warning">Sign Up</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
