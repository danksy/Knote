// initial build

<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "knotes_db";

	$conn = mysqli_connect($hostname, $username, $password, $database)
	OR die("Unable to connect to Database.");
?>