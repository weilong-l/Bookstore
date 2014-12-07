<?php 
session_start();
include_once 'require/config.php';
include $header_loc;
?>

<div class="container">
	<?php 
	if (!isset($_SESSION['login_user'])) {
	?>
	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		Please login <a href="login">here</a>
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
	<div class="orders">
		<h4><?php echo $book->title; ?></h4>
		<p><?php echo $order->copy; ?></p>
		<p><?php echo $order->date; ?></p>
	</div>
	<?php
				}
			}
		}
	}
}
	 ?>
</div>

<?php include $footer_loc; ?>