<?php
session_start(); // Starting Session
include_once '../require/config.php';

$error=''; // Variable To Store Error Message
if(isset($_POST['submit'])) 
{
	if(!empty($_POST['user']))
	{
		$query = $mysqli->query("SELECT * FROM customers WHERE acc = '$_POST[user]' AND password = '$_POST[pass]'");
		if(!$query->fetch_array(MYSQLI_NUM)) 
		{ 
			$fullname 	= $_POST['fullname']; 
			$userName 	= $_POST['user']; 
			$password 	= $_POST['pass']; 
			$creditCard	= $_POST['card'];
			$address 	= $_POST['address'];
			$phone		= $_POST['phone'];

			$query = "INSERT INTO customers VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("ssssss", $fullname, $userName, $password, $creditCard, $address, $phone);
		    if ($stmt->execute() === True) 
		    {
		    	$error = "YOUR REGISTRATION IS COMPLETED...";
		    	$_SESSION['login_user']=$userName; // Initializing Session
		    	$_SESSION['name'] = $fullname;
				header("location: ../user.php"); // Redirecting To Other Page
		    }
		} 
		else 
		{ 
			$error = "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
			header("location: ../register.php?error=".$error."");
		}
	}
}
?>