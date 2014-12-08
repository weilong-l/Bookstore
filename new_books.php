<?php 
session_start();
include_once 'require/config.php';
include $header_loc;

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<div class="container">
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
	
	Details
	
	<form action="new_books.php" method="POST">
	
	ISBN: <br>
	<input type="text" name="ISBN"> <br>
	Title: <br>
	<input type="text" name="title"> <br>
	Authors: <br>
	<input type="text" name="authors"> <br>
	Publisher: <br>
	<input type="text" name="publisher"> <br>
	Year of Publication: <br>
	<input type="text" name="year"> <br>
	Number of copies: <br>
	<input type="text" name="copies"> <br>
	Price: <br>
	<input type="text" name="price"> <br>
	Format: <br>
	<select name="format">
		<option value="hardcover">Hardcover</option>
		<option value="softcover">Softcover</option>
	</select> <br>
	Keywords: <br>
	<input type="text" name="keywords"> <br>
	Subject: <br>
	<input type="text" name="subject"> <br>
	
	<input type="submit" name="addbook" value="Add">
	
	</form> 
</div>
<?php include $footer_loc; ?>