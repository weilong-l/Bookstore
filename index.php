<?php 
session_start();

include_once 'require/config.php';

if (isset($_SESSION['login_user'])) {
	header('location: user.php');
} else {
	header('location: login.php');
}
?>
