<?php
	session_start();
	$_SESSION['admin'] = false;
	
	if($_GET['act']=="login") {
		$_SESSION['login_user'] = $_POST['username'];
		header("Location:/home.php");
	}	
	else
	{
		session_destroy();
		$_SESSION['login_user'] = null;
		$_SESSION['admin'] = false;
		header("Location:/index.php");
	} 
?>
