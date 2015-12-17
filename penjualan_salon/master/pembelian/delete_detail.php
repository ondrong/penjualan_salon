<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/purchasedetail.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$purchasedetail = new purchasedetail($db);
		$purchasedetail->purchase_id = $_POST['purchaseid'];		
		$purchasedetail->item_kode = $_POST['itemid'];
		if($purchasedetail->deleteTemp()){ echo "Items berhasil dihapus."; }
		else {echo "Gagal menghapus Items."; }
	}
?>
