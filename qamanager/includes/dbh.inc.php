<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "web_app";

// Database connection
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// Display error if database connection fails
if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
} 

?>