<?php 
session_start();
include_once 'require/config.php';
include $header_loc;
?>

<?php 
// Query uer info
$info_query = "select * from customers where acc ='".$_SESSION["username"]."';";
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
 ?>


<?php include $footer_loc; ?>