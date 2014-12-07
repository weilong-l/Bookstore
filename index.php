<?php 
session_start();

include_once 'require/config.php';

if (isset($_SESSION['login_user'])) {
	if ($_SESSION['user_type'] == 'normal') {
		header('location: user.php');
	} else {
		header('location: admin_main.php');
	}
} else {
	header('location: login.php');
}
?>
