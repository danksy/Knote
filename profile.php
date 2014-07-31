<!DOCTYPE html>

<?php
	session_start();

	include("config.php");
	include("DBconnection.php");

	$username = $_SESSION['current'];
	$query = mysql_query("SELECT * FROM knotes_users WHERE UserName = '$username'") 
	OR die (mysql_error()); 
	$display = mysql_fetch_array($query);	
?>

<html lang="en">
<head>

<meta charset="utf-8" />

<title>Knotes - Home</title>

</head>
<body>

<strong>Name:</strong> <?php echo $display['FirstName'] . " " . $display['LastName'] ?><br/>
<strong>Username:</strong> <?php echo $display['UserName'] ?><br/>
<strong>Email:</strong> <?php echo $display['EMail'] ?><br/>
<strong>Telephone:</strong> <?php echo $display['TelNumber'] ?><br/>

<p><a href="profile_edit.php">Edit Profile</a></p>
<p><a href="signout.php">Sign Out</a></p>

</body>
</html>