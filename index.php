<?php 
session_start();

include_once 'require/config.php';

if (isset($_SESSION['login_user'])) {
	header('location: user.php');
} else {
	header('location: login.php');
}
?>
<!-- <a href="login.php">login.php</a><br>
<a href="register.php">register.php</a><br>
<a href="books.php">books.php</a><br> -->
