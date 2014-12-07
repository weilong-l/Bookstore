<?php 
include_once 'require/config.php';
include $header_loc; ?>

<div id="Sign-Up" class='col-md-6 col-md-offset-3'> 
	<legend>Registration Form</legend>
	<?php if (isset($_GET['error'])): ?>
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<?php echo $_GET['error']; ?> <a href="login.php">login here</a>
		</div>
	<?php endif ?>
	<form method="POST" action="functions/connectivity-sign-up.php"> 
		<div class="form-group">
		    <label>Full name</label>
		    <input type="text" name="fullname" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>User name</label>
		    <input type="text" name="user" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Password</label>
		    <input type="text" name="pass" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Credit Card</label>
		    <input type="text" name="card" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Address</label>
		    <input type="text" name="address" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Phone</label>
		    <input type="text" name="phone" class="form-control" placeholder="">
		</div>
		<input id="button" class="btn btn-primary" type="submit" name="submit" value="Sign-Up">
	</form> 
</div>
<?php include $footer_loc; ?>