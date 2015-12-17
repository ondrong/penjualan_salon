<?php
	if($_POST){
		session_start();
		include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/orders.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/orderdetail.php';
	    
		$database = new database();
		$db = $database->getConnection();
		$orders = new orders($db);
		$orderdetail = new orderdetail($db);
		
		$orders->order_id = $_POST['order_id'];
		$orders->order_date = $_POST['order_date'];
		$orders->cust_kode = $_POST['cust_kode'];
		$orders->username = $_POST['username'];
		$orderdetail->username = $orders->username;
		
		$_SESSION['bayar'] = $_POST['bayar'];
		$_SESSION['kembali'] = $_POST['kembali'];
		
//		echo $_SESSION['bayar'];
		
		if($orders->Insert())
		{
			if($orderdetail->InsertData())
			{
				$orderdetail->clearTemp();
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
		
		// if($orderdetail->Delete()){ echo "Kategori berhasil dihapus."; }
		// else {echo "Gagal menghapus Kategori."; }
	}
?>