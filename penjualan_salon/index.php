<?php
	session_start();
	if($_SESSION['current_user'] != null)
	{
		header("location: /pages/home.php");
	}
	else
	{
		header("location: /pages/login.php");
	}
?>