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
		
			$page_title = "Data Pelanggan";
			$kode = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Kode Error.');
			include_once $path . '/pages/header.php';
			
			echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-3'>";
			include_once $path . '/pages/sidebarmenu.php';
			echo "</div>";

	include_once $path . '/objects/supplier.php';
	
	$supplier = new supplier($db);
	$supplier->supplier_kode = $kode;	 
	$supplier->ShowOne();
	
echo "<div class='container'>";
		echo "<div class='col-md-9'>";
		if($_POST){
			include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/supplier.php';
			$supplier  = new supplier($db);
			$supplier->supplier_kode = $_POST['supplier_kode'];
			$supplier->supplier_nama = $_POST['supplier_nama'];
			$supplier->supplier_alamat = $_POST['supplier_alamat'];
			$supplier->supplier_hp = $_POST['supplier_hp'];
			$supplier->isactive = $_POST['isactive'];
			
			if($supplier->update()){
				echo "<div class='alert alert-success alert-dismissable'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
				echo "Supplier berhasil diubah.";
				echo "</div>";
			}
			else {
				echo "<div class='alert alert-danger alert-dismissable'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
				echo "Supplier gagal diubah.";
				echo "</div>";
			}
		}

		echo "<div class='row'>";
		echo "<form id='form_reg' class='form-horizontal' action='' method='POST' role='form'>";
		echo "<legend class='text-center'>Ubah Data Supplier</legend>";
		echo "<div class='form-group'>";
		echo "  <label for='supplier_kode' class='col-sm-3 control-label'>Supplier Kode</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='supplier_kode' value='{$supplier->supplier_kode}' readonly>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='supplier_nama' class='col-sm-3 control-label'>Nama Supplier</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='supplier_nama' value='{$supplier->supplier_nama}' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='supplier_alamat' class='col-sm-3 control-label'>Alamat Supplier</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='supplier_alamat' value='{$supplier->supplier_alamat}' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='supplier_hp' class='col-sm-3 control-label'>Nomor Hp</label>";		
		echo"  <div class='col-sm-7'>";
		echo"  		<input type='text' class='form-control' name='supplier_hp' value='{$supplier->supplier_hp}' placeholder='+62 / 08******'  required'>";

		echo"  </div>";
		echo" </div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='isactive' class='col-sm-3 control-label'>Aktif / Tidak</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<select class='form-control' id='isactive' name='isactive' value='{$supplier->isactive}' placeholder='Alamat Supplier' required>";
			if($supplier->isactive > 0) {
				$rdoadmin = 'selected';
				$rdouser = null;
			}
			else {
				$rdoadmin = null;
				$rdouser = 'selected';
			}
		echo "<option value = 1 {$rdoadmin}>Aktif</option>";
		echo "<option value = 0 {$rdouser}>Tidak</option>";
		echo "</select>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <div class='col-sm-3'></div>";
		echo "  <div class='col-sm-7'>";
		echo "<button type='submit' class='btn btn-primary col-sm-2'>Simpan</button>";
		echo "<a href='/master/supplier/' class='btn btn-warning col-sm-2' style='margin-left:10px; padding-left:10px;'>Batal</a>";
		echo "  </div>";
		echo "</div>";
		echo "</form>";
		echo "</div>";
		echo "</div>";
		include_once $path . '/pages/footer.php';
	}
	else 	{
		header("location:/pages/403.php");
	}
?>