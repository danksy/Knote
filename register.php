<!DOCTYPE html>

<html lang="en">
<head>

<meta charset="utf-8" />

<title>Knotes - Register</title>

</head>
<body>

<p><a href="index.php">Home</a></p>

<?php
session_start();
include "config.php";

// check to see if user is logged in. 
if(isset($_SESSION['current']))
{
	header("location: home.php");
}
// check to see if the user clicks the 'register' button
if(isset($_POST['register']))
{
	// Variables from the MySQL Table
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$repeatpassword = $_POST['r_pass'];
	$firstname = $_POST['f_name'];
	$lastname = $_POST['l_name'];
	$email = $_POST['e_mail'];
	$telnumber = $_POST['t_number'];

	// Prevent MySQL Injections  
	$username = stripslashes($username);
	$password = stripslashes($password);
	$repeatpassword = stripslashes($repeatpassword);
	$firstname = stripslashes($firstname);
	$lastname = stripslashes($lastname);
	$email = stripslashes($email);
	$telnumber = stripslashes($telnumber);

	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);
	$repeatpassword = mysqli_real_escape_string($conn, $repeatpassword);
	$firstname = mysqli_real_escape_string($conn, $firstname);
	$lastname = mysqli_real_escape_string($conn, $lastname);
	$email = mysqli_real_escape_string($conn, $email);
	$telnumber = mysqli_real_escape_string($conn, $telnumber);

	// Check to see if the user left any space empty
	if($username == "" || $password == "" || $repeatpassword == "")
	{
		echo "<p>Please complete the form.</p>";
	}
	else
	{
		// Check to see if user's password(s) match
		if($password != $repeatpassword)
		{
			echo "<p>Password(s) do not match</p>";
		}
		else
		{
			// Query Database to check if username is taken
			$query = mysqli_query($conn, "SELECT * FROM knotes_users
			WHERE UserName = '$username'")
			OR die("Cannot query the MySQL Table.");

			$row = mysqli_num_rows($query);
			
			if($row == 1)
			{
				echo "<p>Sorry, this username is already used.</p>";
			}
			else
			{
				// Create new account and add to Database 
				$add = mysqli_query($conn, "INSERT INTO knotes_users
				(id, UserName, PassWord, FirstName, LastName, EMail, TelNumber)
				VALUES (null, '$username', '$password', '$firstname', '$lastname', '$email', '$telnumber')")
				OR die("Cannot add new account");

				echo "<p>New Account Created.
				<a href='index.php'>Click Here </a> to login.</p>";
			}
		}
	}
}
?>

<form name="reg_form" method="post" action="register.php" />
	Username:
	<input type="text" name="user" id="user" size="28" /><br/>
	Password:
	<input type="password" name="pass" id="pass" size="28" /><br/>
	Repeat Password:
	<input type="password" name="r_pass" id="r_pass" size="28" /><br/>
	First Name:
	<input type="text" name="f_name" id="f_name" size="28" /><br/>
	Last Name:
	<input type="text" name="l_name" id="l_name" size="28" /><br/>
	Email:
	<input type="text" name="e_mail" id="e_mail" size="28" /><br/>
	Telephone:
	<input type="text" name="t_number" id="t_number" size="28" /><br/>
	<input type="submit" class="small button" name="register" id="register" value="Create Account" />
</form>

</body>
</html>