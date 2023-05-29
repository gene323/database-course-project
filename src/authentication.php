<?php
	include("connection.php");
	session_start();
	if(!isset($_POST['username'])){
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
	} else {
		$username = $_POST['username'];
		$password = $_POST['password'];
	}

	$username = stripcslashes($username);
	$password = stripcslashes($password);
	$username = $conn->real_escape_string($username);
	$password = $conn->real_escape_string($password);

	$sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
	$res = $conn->query($sql);
	$row = $res->fetch_assoc();
	$count = $res->num_rows;

	if($count == 1){
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		header("refresh:0.2 url=edit/profile.php");
	} else{
		echo "<h1><center>Login failed. Invalid username or password.</center></h1>";
		header("refresh:2 url=login.php");
	}
?>