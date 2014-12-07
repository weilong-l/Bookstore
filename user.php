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
	// Query uer info
	$info_query = "select * from customers where acc ='".$_SESSION["login_user"]."';";
	$info_result = $mysqli->query($info_query);

	if ($info_result) {
		if ($user = $info_result->fetch_object()) {
	?>
	<div class="user-info">
		<h3><?php echo $user->fullname; ?></h3>
		<p><?php echo $user->addr; ?></p>
		<p><?php echo $user->phone; ?></p>
	</div>
	<?php
		}
	}
}
	 ?>
</div>



<?php include $footer_loc; ?>