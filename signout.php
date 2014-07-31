<?php
	session_start();
	require "config.php";
	session_destroy();

	// redirect to index.php once signed out.
	header("location: index.php");
?>