<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/customer.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$customer = new customer($db);
		$customer->cust_kode = $_POST['object_id'];	 
		if($customer->delete()){ echo "customer berhasil dihapus."; }
		else {echo "customer tidak bisa dihapus."; }
	}
?>
