<?php 
session_start();
include_once("db.php");
include 'header.php'; 
?>

<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1">
		<h1 class="row">Books</h2>
		<div class="row">
			<div class="books col-md-6"><!-- name, authors, published, title, subject -->
				<form class="row" action="">
					<div class="input-group">
						<span class="input-group-addon">Username</span>
						<input type="text" class="form-control" placeholder="title">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">Name</span>
						<input type="text" class="form-control" placeholder="name">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">Published</span>
						<input type="text" class="form-control" placeholder="published">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">Subject</span>
						<input type="text" class="form-control" placeholder="subject">
					</div>
					<br>
					<button class="btn btn-primary col-md-4 col-md-offset-8">Search</button>
				</form>
				<?php
				$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		
				$result = $mysqli->query('select * FROM books');
			
				if ($result) {
					while ($book = $result->fetch_object()) {
				?>
				<div class="book">
					<h3><?php echo $book->title; ?></h3>
					<h4>Author: <?php echo $book->authors; ?></h4>
					<p>Publisher: <?php echo $book->publisher; ?></p>
					<p>Price: <?php echo $book->price; ?></p>
					<p>Copies: <?php echo $book->copies; ?></p>
					<p>Year: <?php echo $book->year; ?></p>
					<p>Format: <?php echo $book->format; ?></p>
					<?php 
					if ($book->keywords) {
						echo '<p>Keywords: '.$book->keywords.'</p>';
					}
		
					if ($book->subject) {
						echo '<p>Subject: '.$book->subject.'</p>';
					}
					 ?>
					<form method="post" action="cart_update.php">
						<div class="input-group col-md-6 col-md-offset-6">
							<input class="form-control" type="number" name="product_qty" min="1" max="<?php echo $book->copies; ?>">
							<div class="input-group-btn">
								<button class="btn btn-primary">Add to cart</button>
							</div>
						</div>
						<input type="hidden" name="ISBN" value="<?php echo $book->ISBN; ?>"></p>
						<input type="hidden" name="type" value="add">
						<input type="hidden" name="return_url" value="<?php echo $current_url; ?>">
					</form>
				</div>
				<?php
					}
				}
				?>
			</div>
		
			<div class="shopping-cart col-md-5 col-md-offset-1">
				<h3>Shopping Cart</h3>
				<?php 
				if (isset($_SESSION["books"])) {
					$total = 0;
					echo '<ol>';
					foreach ($_SESSION["books"] as $cart_itm) {
				?>
				<li class="cart-itm">
		
					<div class="row">
						<div class="col-md-8">
							<h4><?php echo $cart_itm["title"] ?></h4>
						</div>
						<div class="col-md-2">
							<a href="cart_update.php?removep=<?php echo $cart_itm["ISBN"]; ?>&return_url=<?php echo $current_url; ?>">
								<span class="glyphicon glyphicon-remove"></span>
							</a>
						</div>
					</div>
		
					<!-- <p class="ISBN">ISBN: <?php echo $cart_itm["ISBN"]; ?></p> -->
					<p class="qty">Qty: <?php echo $cart_itm["qty"]; ?></p>
					<p class="price">Price: <?php echo $cart_itm["price"]; ?></p>
				</li>
				<?php
						$subtotal = $cart_itm["price"]*$cart_itm["qty"];
						$total = $total + $subtotal;
					}
				?>
				</ol>
				<h5>Total: <?php echo $currency.$total; ?></h5>
				<span class="btn btn-default"><a href="view_cart.php">Check Out</a></span>
				<span><a class="btn btn-danger" href="cart_update.php?emptycart=1&return_url=<?php echo $current_url; ?>">Empty Cart</a></span>
				<!-- echo "</ol>";
				echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="view_cart.php">Check-out!</a></span>';
				echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>'; -->
				<?php
				} else {
					echo "Cart is empty";
				}
				?>
			</div>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>
