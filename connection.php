<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "simplelogin";

	$conn = new mysqli($servername, $username, $password, $db);

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to database: " . mysqli_connect_error();
	}
?>