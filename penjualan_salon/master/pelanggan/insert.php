<?php
	session_start();
	if (!$_SESSION['admin']){
		header("location:/errors/failed.php");
	}
	
	$path = $_SERVER['DOCUMENT_ROOT'];
	if($_SESSION['login_user'] != null) {
	
	include_once $path . '/config/database.php';

	$database = new database();
	$db = $database->getConnection();		

	$page_title = "Tambah Data";
	//$kode = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Kode Error.');

	include_once $path . '/admin/header.php';
	echo "<div class='col-md-3 col-sm-5'>";
	include_once $path . '/admin/sidebarmenu.php';
	echo "</div>";
	include_once $path . '/objects/customer.php';
	
	$customer = new customer($db);
//	$users->username = $kode;	 
	//$customer->ShowOne();
	
	echo "<div class='container'>";
		echo "<div class='col-md-9'>";
		if($_POST){
			//public $cust_kode, $cust_nama, $cust_alamat, $cust_jk, $cust_tempat, $cust_dob, $isactive;
			include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/customer.php';
			$customer  = new customer($db);
			$customer->cust_kode = $_POST['cust_kode'];
			$customer->cust_nama = $_POST['cust_nama'];
			$customer->cust_alamat = $_POST['cust_alamat'];
			$customer->cust_jk = $_POST['cust_jk'];
			$customer->cust_tempat = $_POST['cust_tempat'];
			$customer->cust_dob = $_POST['cust_dob'];//tanggal lahir pelanggan
			$customer->isactive = $_POST['isactive'];
		
			//fungsi insert data pelanggan
			
		if($customer->insert()){
				echo "<div class='alert alert-success alert-dismissable'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
				echo "Pelanggan Baru berhasil di Tambah";
				echo "</div>";
			}
			else {
				echo "<div class='alert alert-danger alert-dismissable'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
				echo "pelanggan Baru gagal di tambah";
				echo "</div>";
			}
		}

		echo "<div class='row'>";
		echo "<form id='form_reg' class='form-horizontal' action='' method='POST' role='form'>";
		echo "<legend class='text-center'>Tambah Data Pelanggan</legend>";
		//dari sini
		
		echo "<div class='form-group'>";
		echo "  <label for='cust_kode' class='col-sm-3 control-label'>Kode Pelanggan</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='cust_kode' placeholder='Kode Pelanggan' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='cust_nama' class='col-sm-3 control-label'>Nama Pelanggan</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='cust_nama' placeholder='Nama Pelanggan' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='cust_alamat' class='col-sm-3 control-label'>Alamat Pelanggan</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<textarea class='form-control' id='cust_alamat' name='cust_alamat' placeholder='Alamat Pelanggan' required>";
		echo "</textarea>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='cust_tempat' class='col-sm-3 control-label'>Tempat Lahir</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input class='form-control' id='cust_tempat' name='cust_tempat' placeholder='Tempat Pelanggan' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='cust_dob' class='col-sm-3 control-label'>Tanggal Lahir</label>";		
		echo"  <div class='col-sm-7'>";
		echo"  		<input type='text' class='form-control' id='cust_dob' name='cust_dob' placeholder='yyyy-mm-dd'  required'>";

		echo"  </div>";
		echo" </div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='cust_jk' class='col-sm-3 control-label'>Jenis Kelamin</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<select class='form-control' id='cust_jk' name='cust_jk' required>";
		echo "<option>LAKI-LAKI</option>";
		echo "<option>PEREMPUAN</option>";
		echo "</select>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='isactive' class='col-sm-3 control-label'>Aktif / tidak Aktif</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<select class='form-control' id='isactive' name='isactive' placeholder='' required>";
			if($customer->isactive > 0) {
				$rdoadmin = 'selected';
				$rdouser = null;
			}
			else {
				$rdoadmin = null;
				$rdouser = 'selected';
			}
		echo "<option value = 1 {$rdoadmin}>Aktif</option>";
		echo "<option value = 0 {$rdouser}>Tidak Aktif</option>";
		echo "</select>";
		echo "  </div>";
		echo "</div>";
//sampe sini		
		
		echo "<div class='form-group'>";
		echo "  <div class='col-sm-3'></div>";
		echo "  <div class='col-sm-7'>";
		echo "<button type='submit' class='btn btn-primary col-sm-2'>Simpan</button>";
		echo "<a href='/admin/pelanggan/' class='btn btn-warning col-sm-2' style='margin-left:10px; padding-left:10px;'>Batal</a>";
		echo "  </div>";
		echo "</div>";
		echo "</form>";
		echo "</div>";

		include_once $path . '/admin/footer.php';
		echo "</div>";
	}
	else {
		header("location:/errors/404.php");
	}
	?>
	<script>
	$('#cust_dob').datepicker({
    		format: 'yyyy-mm-dd'
		});
	</script>