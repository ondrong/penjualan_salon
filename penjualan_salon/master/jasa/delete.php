<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/items.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$items = new items($db);
		$items->item_kode = $_POST['object_id'];	 
		if($items->delete()){ echo "Jasa berhasil dihapus."; }
		else {echo "Jasa tidak bisa dihapus."; }
	}
?>
