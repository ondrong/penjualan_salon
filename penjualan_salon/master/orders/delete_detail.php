<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/orderdetail.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$orderdetail = new orderdetail($db);
		$orderdetail->order_id = $_POST['orderid'];		
		$orderdetail->item_kode = $_POST['itemid'];
		if($orderdetail->deleteTemp()){ echo "Items berhasil dihapus."; }
		else {echo "Gagal menghapus Items."; }
	}
?>
