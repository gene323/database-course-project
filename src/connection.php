<?php
	$user = "root";
	$host = "localhost";
	$password = "";
	$db = "test";

	$conn = new mysqli($host, $user, $password, $db);

	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
?>