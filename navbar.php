<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="home.php"
				style="font-family: 'Bevan', cursive"><span style="color: #ff0000">e</span>Dukaan</a>
		</div>
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<!-- <form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Go</button>
			</form> -->
			<ul class="nav navbar-nav navbar-right">
				<li><a href="cart.php" id="cartLink">Cart</a></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false"><?php echo $_SESSION["customerName"];?> <span
						class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="previousOrders.php">Previous Orders</a></li>
						<li><a href="changeContactDetails.php">Change Contact Details</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul></li>
			</ul>
		</div>
	</div>
</nav>
