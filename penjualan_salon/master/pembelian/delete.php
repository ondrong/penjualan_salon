<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/orderdetail.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$orderdetail = new orderdetail($db);
		$orderdetail->kode = $_POST['object_id'];	 
		if($orderdetail->Delete()){ echo "Kategori berhasil dihapus."; }
		else {echo "Gagal menghapus Kategori."; }
	}
?>
