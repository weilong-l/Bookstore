<?php
session_start(); // Starting Session
include_once '../require/config.php';

if (isset($_POST['login'])) {
	$return_url = base64_decode($_POST["return_url"]);

	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else
	{
// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		$type = $_POST['usertype'];

// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		// $username = mysql_real_escape_string($username);
		// $password = mysql_real_escape_string($password);

// SQL query to fetch information of registerd users and finds user match.
		if ($type=="admin") {
			$query = $mysqli->query("select * from admin where password='$password' AND ad_acc='$username'");
		} else {
			$query = $mysqli->query("select * from customers where password='$password' AND acc='$username'");
		}
		$rows = mysqli_num_rows($query);
		if ($rows == 1) {
			$user = $query->fetch_object();
			$_SESSION['login_user']=$username; // Initializing Session
			$_SESSION['user_type'] = $type;
			if ($type=="admin") {
				$_SESSION['name']=$user->ad_acc;
				header("location: ../admin_main.php");
			} else {
				$_SESSION['name']=$user->fullname;
				header("location: ../user.php"); // Redirecting To Other Page
			}
			
		} else {
			$error = "Username or Password is invalid";
		}
		// mysql_close($connection); // Closing Connection
	}

	if (isset($error)) {
		header('location: '.$return_url.'?error='.$error);
	}
}
?>