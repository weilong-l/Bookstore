<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="style/jquery-ui.css">
	<title>BookStore</title>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<a href="index.php" class="navbar-brand">BS</a>
		</div>

		<ul class="nav navbar-nav navbar-left">
			<?php if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == "admin"): ?>
				<li><a href="new_books.php">Add Books</a></li>
				<li><a href="update_inventory.php">Update Inventory</a></li>
				<li><a href="statistic.php">Statistic</a></li>
				<li><a href="logout.php">Logout</a></li>
			<?php endif ?>

			<?php if (isset($_SESSION['login_user']) && $_SESSION['user_type'] == "normal"): ?>
				<li><a href="books.php">Books</a></li>
				<li class="dropdown">
				  <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
				    <?php echo $_SESSION['name']; ?>
				    <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="user.php">Account info</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="orders.php">Your orders</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="feedbacks.php">Feedbacks</a></li>
				  </ul>
				</li>
				<li><a href="logout.php">Logout</a></li>
			<?php endif ?>

			<?php if (!isset($_SESSION['login_user'])): ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
			<?php endif ?>			
			
		</ul>
	</nav>