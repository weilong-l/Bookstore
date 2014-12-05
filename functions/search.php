<?php 
include_once '../require/config.php';
session_start();

if (isset($_POST['type']) && $_POST['type'] == 'search') {
	$title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
	$return_url = base64_decode($_POST["return_url"]);

	$_SESSION['search_title'] = $title;
	header('Location:'.$return_url);
}

if (isset($_POST['type']) && $_POST['type'] == 'advance') {
	$_SESSION['advance_search'] = $_POST;
	$return_url = base64_decode($_POST["return_url"]);

	header('Location:'.$return_url);
}
?>