<?php
session_start();
ob_start();
if (!$_SESSION['current_user']){
	header("location:/pages/failed.php");
	}
$path = $_SERVER['DOCUMENT_ROOT'];
	if($_SESSION['current_user'] != null)
	{		
			include_once $path . '/config/database.php';
			$database = new database();
			$db = $database->getConnection();
		
		$page_title = "Ubah Data Barang";
		$kode = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Kode Error.');
		include_once $path . '/pages/header.php';
			
			echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-3'>";
			include_once $path . '/pages/sidebarmenu.php';
			echo "</div>";

		include_once $path . '/objects/items.php';
	
			$items = new items($db);
			$items->item_kode = $kode;	 
			$items->ShowOne();

			
	echo "<div class='container'>";
		echo "<div class='col-md-9'> ";
					
		if($_POST){
			include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/items.php';
			$items  = new items($db);
			$items->item_kode = $_POST['item_kode'];
			$items->item_name = $_POST['item_name'];
			$items->item_note = $_POST['item_note'];
			$items->isavailable = $_POST['isavailable'];
			$items->harga = $_POST['harga'];
			$items->item_type = 'BARANG';//$_POST['item_type'];
			
			if($items->update()){
				echo "<div class='alert alert-success alert-dismissable'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
				echo "Data Barang berhasil di Ubah.";
				echo "</div>";
			}
			else {
				echo "<div class='alert alert-danger alert-dismissable'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
				echo "Data Barang gagal di Ubah.";
				echo "</div>";
			}
		}

		
		echo "<div class='row'>";
		
		echo "<form id='form_reg' class='form-horizontal' action='' method='POST' role='form'>";
		echo "<legend class='text-center'>Ubah Data Barang</legend>";
		
echo "<div class='form-group'>";
		echo "  <label for='item_kode' class='col-sm-3 control-label'>Kode Barang</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='item_kode' value='{$items->item_kode}' placeholder='Kode Jasa' readonly>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='item_name' class='col-sm-3 control-label'>Nama Barang</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='item_name' value='{$items->item_name}' placeholder='Nama Jasa' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='item_note' class='col-sm-3 control-label'>Keterangan</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<textarea type='text' class='form-control' name='item_note' placeholder='Keterangan Jasa' required>{$items->item_note}</textarea>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='isavailable' class='col-sm-3 control-label'>Ketersediaan</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<select class='form-control' id='isavailable' name='isavailable' value='{$items->isavailable}' placeholder='User Type' required>";
			if($items->isavailable > 0) {
				$rdoadmin = 'selected';
				$rdouser = null;
			}
			else {
				$rdoadmin = null;
				$rdouser = 'selected';
			}
		echo "<option value = 1 {$rdoadmin}>Tersedia</option>";
		echo "<option value = 0 {$rdouser}>Tidak Tersedia</option>";
		echo "</select>";
		echo "  </div>";
		echo "</div>";
		
		
		echo "<div class='form-group'>";
		echo "  <label for='harga' class='col-sm-3 control-label'>Harga</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='harga' value='{$items->harga}' placeholder='' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <div class='col-sm-3'></div>";
		echo "  <div class='col-sm-7'>";
		echo "<button type='submit' class='btn btn-primary col-sm-2'>Simpan</button>";
		echo "<a href='/master/barang/' class='btn btn-warning col-sm-2' style='margin-left:10px; padding-left:10px;'>Batal</a>";
		echo "  </div>";
		echo "</div>";
		echo "</form>";
		echo "</div>";	
		echo "</div>";
		echo "</div>";
		include_once $path . '/pages/footer.php';
	}
	else 	{
		header("location:/pages/403.php");
	}
?>