
<?php 
include_once 'require/config.php';
include $header_loc;

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<div class="container">
	<div class="row col-md-6 col-md-offset-3">
		<div class="row">
			<h1>Login</h1>
		</div>
		<br>
		<?php 
		if (isset($_GET['error'])) {
			$error = $_GET['error'];
		?>
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<?php echo $error; ?>
		</div>
		<?php
		}
		 ?>
		<form action="functions/login_fun.php" method="post">
			<label for="">Username</label>
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="text" name="username" class="form-control" placeholder="username">
			</div>
			<br>
			<label for="">Password</label>
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-eye-open"></span></span>
				<input type="password" name="password" class="form-control" placeholder="password">
			</div>
			<br>
			<button class="btn btn-default col-md-2 col-md-offset-7">Login</button>
			<input type="hidden" name="return_url" value="<?php echo $current_url; ?>">
			<input type="hidden" name="login">
			<button class="btn btn-default col-md-2 col-md-offset-1"><a href="register.php">Register</a></button>
		</form>
	</div>
</div>

<?php include $footer_loc; ?>