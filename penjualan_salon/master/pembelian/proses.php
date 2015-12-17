<?php
	if($_POST){
		session_start();
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/purchase.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/purchasedetail.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$purchase = new purchase($db);
		$purchasedetail = new purchasedetail($db);
		
		$purchase->purchase_id = $_POST['purchase_id'];
		$purchase->purchase_date = $_POST['purchase_date'];
		$purchase->supplier_kode = $_POST['supplier_kode'];
		$purchase->username = $_POST['username'];
		$purchasedetail->username = $purchase->username;
		
		if($purchase->Insert())
		{
			if($purchasedetail->InsertData())
			{
				$purchasedetail->clearTemp();
				echo "Berhasil di proses";
			}
			else
			{
				echo "anak cacat";
			}
		}
		else
		{
			echo "gagal di proses";
		}
	
	}
?>