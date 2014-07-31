<!DOCTYPE html>

<?php
	session_start();

	include("config.php");
	include("DBconnection.php");

	$user = $_SESSION['current'];
	$query = mysql_query("SELECT * FROM knotes_users WHERE UserName = '$user'")
	OR die(mysql_error());
	$display = mysql_fetch_array($query);

	// get the form details when the 'update' button is clicked
	if(isset($_POST['update']))
	{
		// get values from input boxes in the form and add into variables
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$firstname = $_POST['f_name'];
		$lastname = $_POST['l_name'];
		$email = $_POST['e_mail'];
		$telnumber = $_POST['t_number'];

		$sql = "UPDATE knotes_users SET UserName = '$username', PassWord = '$password', FirstName = '$firstname', LastName = '$lastname', EMail = '$email', TelNumber = '$telnumber'";
		$result = mysql_query($sql);

		// redirect to 'profile' page
		header("location: profile.php");
	}
?>

<html lang="en">
<head>

<meta charset="utf-8" />

<title>Knotes - Home</title>

</head>
<body>

<form name="edit_form" method="post" action="profile_edit.php" />
Username<br/>
<input type="text" name="user" id="user" size="28" value="<?php echo $display['UserName'] ?>" /><br/>
Password<br/>
<input type="text" name="pass" id="pass" size="28" value="<?php echo $display['PassWord'] ?>" /><br/>
First Name<br/>
<input type="text" name="f_name" id="f_name" size="28" value="<?php echo $display['FirstName'] ?>" /><br/>
Last Name<br/>
<input type="text" name="l_name" id="l_name" size="28" value="<?php echo $display['LastName'] ?>" /><br/>
E Mail<br/>
<input type="text" name="e_mail" id="e_mail" size="28" value="<?php echo $display['EMail'] ?>" /><br/>
Telephone<br/>
<input type="text" name="t_number" id="t_number" size="28" value="<?php echo $display['TelNumber'] ?>" /><br/>
<input type="submit" name="update" id="update" value="Update Profile" />
</form>

<p><a href="signout.php">Sign Out</a></p>

</body>
</html>