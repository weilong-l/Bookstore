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
	if (isset($_POST['addbook'])) {
		// Creating variables from input data
		$ISBN = $_POST['ISBN'];
		$title = $_POST['title'];
		$authors = $_POST['authors'];
		$publisher = $_POST['publisher'];
		$year = $_POST['year'];
		$copies = $_POST['copies'];
		$price = $_POST['price'];
		$format = $_POST['format'];
		$keywords = $_POST['keywords'];
		$subject = $_POST['subject'];
	
		// My old code sql queries
		$sql = "INSERT INTO books (ISBN, title, authors, publisher, year, copies, price, format, keywords, subject)
		VALUES ('$ISBN', '$title', '$authors', '$publisher', '$year', '$copies', '$price', '$format', '$keywords', '$subject')";
	
		// Check database connection
		if (mysqli_query($mysqli, $sql)) {
		    echo '<div class="alert alert-success" role="alert">New record created successfully</div>';
		} else {
		    echo '<div class="alert alert-danger" role="alert">There were errors, insert failed</div>';
		}
	}
?>
	
	<h1>
		ADD NEW BOOKS
	</h1>
	
	<form action="new_books.php" method="POST">

		<div class="form-group">
		    <label>ISBN</label>
		    <input type="text" name="ISBN" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Title</label>
		    <input type="text" name="title" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Authors</label>
		    <input type="text" name="authors" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Publisher</label>
		    <input type="text" name="publisher" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Year of Publication</label>
		    <input type="text" name="year" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Number of copies</label>
		    <input type="text" name="copies" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Price</label>
		    <input type="text" name="price" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Keywords</label>
		    <input type="text" name="keywords" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Subject</label>
		    <input type="text" name="subject" class="form-control" placeholder="">
		</div>
		<div class="form-group">
		    <label>Increase in copies:</label>
			<select name="format">
				<option value="hardcover">Hardcover</option>
				<option value="softcover">Softcover</option>
			</select> <br>
		</div>

		<input class="btn btn-primary" type="submit" name="addbook" value="Add">
	</form> 
</div>
<?php include $footer_loc; ?>