<?php 
include_once 'require/config.php';
include $header_loc; ?>

<div id="Sign-Up"> 
	<fieldset style="width:40%">
		<legend>Registration Form</legend>
		<?php if (isset($_GET['error'])): ?>
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">Error:</span>
				<?php echo $_GET['error']; ?> <a href="login.php">login here</a>
			</div>
		<?php endif ?>
		<table border="0"> 
			<form method="POST" action="functions/connectivity-sign-up.php"> 
				<tr> 
					<td>Full Name</td><td> <input type="text" name="fullname"></td> 
				</tr> 
				<tr> 
					<td>User Name</td>
					<td> <input type="text" name="user"></td> 
				</tr> 
				<tr> 
					<td>Password</td>
					<td> <input type="password" name="pass"></td> 
				</tr> 
				<tr> 
					<td>Credit Card</td>
					<td> <input type="text" name="card"></td> 
				</tr> 
				<tr> 
					<td>Address</td>
					<td><input type="text" name="address"></td> 
				</tr> 
				<tr> 
					<td>Phone</td>
					<td><input type="text" name="phone"></td> 
				</tr> 
				<tr> 
					<td><input id="button" type="submit" name="submit" value="Sign-Up"></td> 
				</tr> 
			</form> 
		</table> 
	</fieldset> 
</div>
<?php include $footer_loc; ?>