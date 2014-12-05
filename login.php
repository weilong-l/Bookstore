
<?php 
include_once 'require/config.php';
include $header_loc; 
?>

<div class="container">
	<div class="row col-md-6 col-md-offset-3">
		<div class="row">
			<h1>Bookstore</h1>
		</div>
		<br>
		<form action="" class="row">
			<div class="row input-group">
				<span class="input-group-addon">Username</span>
				<input type="text" class="form-control" placeholder="username">
			</div>
			<br>
			<div class="row input-group">
				<span class="input-group-addon">Password</span>
				<input type="text" class="form-control" placeholder="password">
			</div>
			<br>
			<div class="row">
				<button class="btn btn-default">Submit</button>
			</div>
		</form>
	</div>
</div>

<?php include $footer_loc; ?>