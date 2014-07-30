<!-- initial build -->

<!DOCTYPE html>

<html lang="en">
<head>

<meta charset="utf-8" />

<title>Knotes</title>

</head>
<body>

<?php
session_start();
include "config.php";

// check to see if current user is logged in.
if(isset($_SESSION['current']))
{
	// isset check to see if a variable has been 'set'
	header("location: home.php");
}
if(isset($_POST['login']))
{
	// take input from form fields and add into variables
	$username = $_POST['user'];
	$password = $_POST['pass'];

	// prevent MySQL injections
	$username = stripslashes($username);
	$password = stripslashes($password);

	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);

	// check to see if input fields are empty
	if($username == "" || $password == "")
	{
		echo "Please complete login details.";
	}
	else
	{
		$query = mysqli_query($conn, "SELECT * FROM knotes_users
		WHERE UserName = '$username' AND PassWord = '$password'")
		OR die("Cannot query the Database.");

		$count = mysqli_num_rows($query);

		// if login details have been found
		if($count == 1)
		{
			// create a new session for the user
			$_SESSION['current'] = $username;
			// redirect the user to the homepage if login details correct
			header("location: home.php");
		}
		else
		{
			echo "Username and/or Password is incorrect";
		}
	}
}
?>

<form name="login_form" method="post" action="index.php" />
	<p><input type="text" name="user" id="user" size="28" placeholder="Username" /></p>
	<p><input type="password" name="pass" id="pass" size="28" placeholder="Password" /></p>
	<p><input type="submit" class="small button" name="login" id="login" value="Sign in" /></p>
</form>

<p><a href="register.php">Register</a></p>

</body>
</html>