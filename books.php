<?php include 'header.php'; ?>
<div class="container">
	<h1 class="row">Books</h2>
	<div class="row">
		<div class="col-md-5 col-md-offset-1"><!-- name, authors, published, title, subject -->
			<form class="" action="">
				<div class="input-group">
					<span class="input-group-addon">Username</span>
					<input type="text" class="form-control" placeholder="title">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Name</span>
					<input type="text" class="form-control" placeholder="name">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Published</span>
					<input type="text" class="form-control" placeholder="published">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Subject</span>
					<input type="text" class="form-control" placeholder="subject">
				</div>
			</form>
			<?php 
				include_once('class.MySQL.php');
				$db = new MySQL('databaseproject','dbproj','password');
				$result = $db->ExecuteSQL('select * FROM books');
			
				if ($result) {
					for ($i=0; $i < sizeof($result); $i++) { 
					 	# code...
						$book = $result[$i];
			?>
				<div class="book">
					<h3><?php echo $book['title']; ?></h3>
					<h4>Author: <?php echo $book['authors']; ?></h4>
					<p>Publisher: <?php echo $book['publisher']; ?></p>
					<p>Price: <?php echo $book['price']; ?></p>
					<p>Copies: <?php echo $book['copies']; ?></p>
					<p>Year: <?php echo $book['year']; ?></p>
					<p>ISBN: <?php echo $book['ISBN']; ?></p>
					<p>Format: <?php echo $book['format']; ?></p>
					<?php 
					if ($book['keywords']) {
						echo '<p>Keywords: '.$book['keywords'].'</p>';
					}
		
					if ($book['subject']) {
						echo '<p>Subject: '.$book['subject'].'</p>';
					}
					 ?>
				</div>
			<?php
					}
				}
			
			?>
		</div>

		<div class="col-md-4 col-md-offset-1">
			<h3>Shopping Cart</h3>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>
