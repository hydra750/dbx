<?php
$server = "ServerName";
$username = "Username";
$password = "Pass";
$database = "DatabaseName";

// Establishing connection to database
$conn = mysqli_connect($server, $username, $password, $database) or die("Connection failed: " . mysqli_connect_error());
?>
