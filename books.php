<?php 
session_start();
include_once 'require/config.php';
include $header_loc;

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1">
		<h1 class="row title">Books</h2>
		<div class="row">
			<div class="books col-md-6">
				<!-- Search by title form -->
				<form class="row search" method="post" action="functions/search.php">
					<h5>Search by title:</h5>
					<div class="input-group search-bar">
						<input type="text" name="title" class="form-control" placeholder="title"></input>
						<span class="input-group-btn">
							<button class="btn btn-default">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
					<input type="hidden" name="type" value="search">
					<input type="hidden" name="return_url" value="<?php echo $current_url; ?>">
				</form>
				
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#advanceSearchModal">
					Advance search
				</button>

				<!-- Modal -->
				<div class="modal fade" id="advanceSearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="myModalLabel">Advane search</h4>
				      </div>
				      <form action="functions/search.php" method="post" name="advance">
				      	<div class="modal-body">
				      		<div class="form-group">
				      		    <label>Authors</label>
				      		    <input type="text" name="author" class="form-control" placeholder="">
				      		</div>
				      		<div class="form-group">
				      		    <label>Publishers</label>
				      		    <input type="text" name="publishers" class="form-control" placeholder="">
				      		</div>
				      		<div class="form-group">
				      		    <label>Title</label>
				      		    <input type="text" name="title" class="form-control" placeholder="">
				      		</div>
				      		<div class="form-group">
				      		    <label>Subject</label>
				      		    <input type="text" name="subject" class="form-control" placeholder="">
				      		</div>
				      		<select name="sort_by" form="advance">
							  	<option value="volvo">year</option>
							  	<option value="saab">score</option>
							</select>
							<select name="search_by" form="advance">
							 	<option value="and">and</option>
							 	<option value="or">or</option>
							</select>
							<input type="hidden" name="type" value="advance">
							<input type="hidden" name="return_url" value="<?php echo $current_url; ?>">
				      	</div>
				      	<div class="modal-footer">
				      	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      	  <button type="submit" class="btn btn-primary">Search</button>
				      	</div>
				      </form>
				    </div>
				  </div>
				</div>

				<!-- Display books -->
				<?php
				if (isset($_SESSION['search_title'])) {
					$query = "select * FROM books where title like '%".$_SESSION['search_title']."%'";
				} else if (isset($_SESSION['advance_search'])) {
					$query = "";
				} else {
					$query = "select * FROM books";
				}
				$result = $mysqli->query($query);
			
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
					<form method="post" action="functions/cart_update.php">
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

			<!-- Shopping cart -->
			<div class="shopping-cart col-md-5 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Shopping Cart</h3>
					</div>
					<div class="panel-body"><?php 
						if (isset($_SESSION["books"])) {
							$total = 0;
							echo '<ul>';
							foreach ($_SESSION["books"] as $cart_itm) {
						?>
						<li class="cart-itm">
								
							<div class="row">
								<div class="col-md-8">
									<h4><?php echo $cart_itm["title"] ?></h4>
								</div>
								<div class="col-md-2">
									<a href="functions/cart_update.php?removep=<?php echo $cart_itm["ISBN"]; ?>&return_url=<?php echo $current_url; ?>">
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
						</ul>
						<h5>Total: <?php echo $currency.$total; ?></h5>
						<span class="btn btn-default"><a href="functions/cart_update.php?checkout=1&return_url=<?php echo $current_url; ?>">Check Out</a></span>
						<span><a class="btn btn-danger" href="functions/cart_update.php?emptycart=1&return_url=<?php echo $current_url; ?>">Empty Cart</a></span>
						
						<?php
						} else {
							echo "Cart is empty";
						}
						?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
unset($_SESSION['search_title']);
unset($_SESSION['advance_search']);
 ?>

<?php include $footer_loc; ?>
