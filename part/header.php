<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style/style.css">
	<title>BookStore</title>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<a href="index.php" class="navbar-brand">BOOKSTORE</a>
		</div>

		<ul class="nav navbar-nav navbar-left">
			<li><a href="books.php">Books</a></li>
			<?php 
			$_SESSION['name'] = "ANNA";
			if (isset($_SESSION['username'])) {
			?>
			<!-- <li><a href="orders.php">Orders</a></li> -->
			<li class="dropdown">
			  <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			    <?php echo $_SESSION['name']; ?>
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="user.php">Account info</a></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="orders.php">Your orders</a></li>
			  </ul>
			</li>
			<?php
			} else {
			?>
			<li><a href="login.php">Login</a></li>
			<li><a href="register.php">Register</a></li>
			<?php
			}
			 ?>
		</ul>
	</nav>