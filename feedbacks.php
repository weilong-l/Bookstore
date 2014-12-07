<?php 
session_start();
include_once 'require/config.php';
include $header_loc;

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<?php if (isset($_SESSION['login_user'])): ?>

	<div class="feedbacks container">
		<div class="feedback-history col-md-5">
			<h3>Your feedbacks</h3>
			<?php 
			$query = "select * from feedback where author='".$_SESSION['login_user']."';";
			$history_result = $mysqli->query($query);
			if ($history_result) {
				echo '<ul>';
				while ($obj = $history_result->fetch_object()) {
			?>
			<div class="panel panel-default">
			    <li class="feedback panel-body">
			        <p class="feedback-content">"<?php echo $obj->opinion ?>"</p>
			        <strong>
			        	<?php 
			        	$query = "select title from books where ISBN='".$obj->book."';";
			        	$result = $mysqli->query($query);
			        	echo $result->fetch_object()->title;
			        	 ?>
			        </strong>
			        <strong class="rating"><?php echo $obj->score ?></strong><br>
			        by <strong><?php echo $obj->author ?></strong><br>
			        <span>Usefulness Rating: <?php echo $obj->usefulness ?></span><br>
					<span>Date: <?php echo $obj->date ?></span>
			    </li>
			</div>
			<?php
				}
				echo "</ul>";
			}
			 ?>
		</div>
		<div class="feedback-rated col-md-5 col-md-offset-1">
			<h3>Rated feedbacks</h3>
			<?php
			$useful_query = "select * from usefulness where reviewer ='".$_SESSION['login_user']."';";

			$rated_result = $mysqli->query($useful_query);
			if ($rated_result) {
				echo '<ul>';
				while ($obj = $rated_result->fetch_object()) {
					// Query the feedback info
					$feedback_query = "select * from feedback where author='".$obj->author."' and book='".$obj->book."';";
					$feedback_result = $mysqli->query($feedback_query)->fetch_object();
			?>
			<div class="panel panel-default">
			    <li class="feedback panel-body">
			        <p class="feedback-content">"<?php echo $feedback_result->opinion ?>"</p>
			        <strong>
			        	<?php 
			        	$query = "select title from books where ISBN='".$obj->book."';";
			        	$result = $mysqli->query($query);
			        	echo $result->fetch_object()->title;
			        	 ?>
			        </strong>
			        <strong class="rating"><?php echo $feedback_result->score ?></strong><br>
			        by <strong><?php echo $feedback_result->author ?></strong><br>
			        <span>Usefulness Rating: <?php echo $feedback_result->usefulness ?></span><br>
					<span>Date: <?php echo $feedback_result->date ?></span><br>
					Your rating is <strong><?php echo $obj->usefulness ?></strong>
			    </li>
			</div>
			<?php
				}
				echo "</ul>";
			}
			 ?>
		</div>
	</div>
	
<?php endif ?>

<?php include $footer_loc; ?>