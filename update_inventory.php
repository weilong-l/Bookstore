<?php 
session_start();
include_once 'require/config.php';
include $header_loc;

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
	<?php 
	// Creating variables from input data
	if (isset($_POST["updateinv"])) {
		$ISBN = $_REQUEST['ISBN'];
		$add_copies = $_REQUEST['Increase_in_copy'];

		// Creating SQL queries: UPDATE
		$sql = "UPDATE books 
				set copies = copies + $add_copies
				WHERE ISBN='$ISBN'";
				
		// Check database connection
		if (mysqli_query($mysqli, $sql)) {
		    echo '<div class="alert alert-success" role="alert">New inventory updated successfully</div>';
		} else {
		    echo '<div class="alert alert-danger" role="alert">There were errors, update failed</div>';
		}
	}
	?>
	<h2>
		UPDATE INVENTORY
	</h2>
	<!--- (5) ARRIVAL OF MORE COPIES  -->
	<form action="update_inventory.php" method="POST">
		<div class="form-group">
		    <label>ISBN:</label>
		    <input type="text" name="ISBN" class="form-control" placeholder="">
		</div>

		<div class="form-group">
		    <label>Increase in copies:</label>
		    <input type="text" name="Increase_in_copy" class="form-control" placeholder="">
		</div>
		<input class="btn btn-primary" type="submit" name="updateinv" value="Update Inventory">
	</form>
</div>
	</div>
</div>

<?php include $footer_loc; ?>