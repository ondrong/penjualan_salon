<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/users.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$users = new users($db);
		
		$users->username = $_POST['object_id'];	 
		if($users->delete()){ echo "User berhasil dihapus."; }
		else 
		{
			echo "User tidak bisa dihapus."; 
		}
	}
?>
