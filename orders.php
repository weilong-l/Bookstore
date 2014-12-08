<?php 
session_start();
include_once 'require/config.php';
include $header_loc;
?>

<div class="container">
	<div class="col-md-6 col-md-offset-3">
	<?php 
	if (!isset($_SESSION['login_user'])) {
	?>
	<div class="alert alert-warning" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		Please login <a href="login.php">here</a>
	</div>
	<?php
	} else {
	$order_query = "select * from orders where customer ='".$_SESSION["login_user"]."';";
	$order_result = $mysqli->query($order_query);

	if ($order_result) {
		while ($order = $order_result->fetch_object()) {
			$ISBN = $order->book;
			$book_query = "select * from books where ISBN = '".$ISBN."';";
			$book_result = $mysqli->query($book_query);
			if ($book_result) {
				// $book = $book_result->fetch_object();
				if ($book = $book_result->fetch_object()) {
	?>	
	<div class="orders panel panel-default">
		<div class="panel-body">
			<h4><?php echo $book->title; ?></h4>
			<p>Bought <?php echo $order->copy; ?> copies</p>
			<p>Bought on <?php echo $order->date; ?></p>
			<div class="panel panel-default">
				<div class="panel-heading" for="">Recomendations</div>
				<div class="panel-body">
					<?php 
						$recomendations_query = "select book, count(book) from (select book from orders where customer in(select customer from orders where book = '$ISBN') and book <> '$ISBN') other_book group by book order by count(book) desc;";
						$recomendation_result = $mysqli->query($recomendations_query);
						if ($recomendation_result) {
							while ($book = $recomendation_result->fetch_object()) {
								$book_query = "select * from books where ISBN = '".$book->book."';";
								$book_result = $mysqli->query($book_query);
								if ($rec_book = $book_result->fetch_object()) {
									?>
									<li>
										<a href="single_book.php?ISBN=<?php echo $rec_book->ISBN ?>"><?php echo $rec_book->title ?></a>
									</li>
									<?php
								}
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
				}
			}
		}
	}
}
	 ?>
	</div>
</div>

<?php include $footer_loc; ?>