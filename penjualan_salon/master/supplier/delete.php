<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/supplier.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$supplier = new supplier($db);
		$supplier->supplier_kode = $_POST['object_id'];	 
		if($supplier->delete()){ echo "customer berhasil dihapus."; }
		else {echo "customer tidak bisa dihapus."; }
	}
?>
