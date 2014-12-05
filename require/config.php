<?php 
$currency = '$'; //Currency sumbol or code

// Style variables
$bootstrap = 'style/bootstrap.min.css';
$style = 'style/sytle.css';

// Require file locations
$header_loc = 'part/header.php';
$footer_loc = 'part/footer.php';

// Database connection
$db_username = 'dbproj';
$db_password = 'password';
$db_name = 'databaseproject';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);
 ?>