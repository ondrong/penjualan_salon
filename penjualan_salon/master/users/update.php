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
		
			$page_title = "Data Karyawan";
			$kode = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Kode Error.');
			include_once $path . '/pages/header.php';
			
			echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-3'>";
			include_once $path . '/pages/sidebarmenu.php';
			echo "</div>";


	include_once $path . '/objects/users.php';
	
	$users = new users($db);
	$users->username = $kode;	 
	$users->ShowOne();
	
			
	echo "<div class='container'>";
		echo "<div class='col-md-9'> ";
		echo "<div> ";
		echo"<div><ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/master/users/'>Data Karyawan</a></li><li class='active'>Ubah Data Karyawan</li>";
			echo"</ol";
			echo"</div>";
			echo"</div>";
					
		if($_POST){
			include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/users.php';
			$users  = new users($db);
			$users->username = $_POST['username'];
			$users->password = $_POST['password'];
			$users->userlevel = $_POST['userlevel'];
		//	$users->isactive = $_POST['isactive'];
			
			if($users->Update()){
				echo "<div class='alert alert-success alert-dismissable'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
				echo "User berhasil diubah.  <a href='/master/users/'>kembali</a>";
				echo "</div>";
			}
			else {
				echo "<div class='alert alert-danger alert-dismissable'>";
				echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
				echo "User gagal diubah.";
				echo "</div>";
			}
		}
		
		echo "<div class='row'>";
		
		echo "<form id='form_reg' class='form-horizontal' action='' method='POST' role='form'>";
		echo "<legend class='text-center'>Ubah Data Karyawan</legend>";
		echo "<div class='form-group'>";
		echo "  <label for='username' class='col-sm-3 control-label'>Username</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='username' value='{$users->username}' readonly>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='password' class='col-sm-3 control-label'>Password</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='password' class='form-control' name='password' value='{$users->password}' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='userlevel' class='col-sm-3 control-label'>User Type</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<select class='form-control' id='userlevel' name='userlevel' placeholder='User Type' required>";
			if($users->userlevel > 0) {
				$rdoadmin = 'selected';
				$rdouser = null;
			}
			else {
				$rdoadmin = null;
				$rdouser = 'selected';
			}
		echo "<option value = 1 {$rdoadmin}>ADMIN</option>";
		echo "<option value = 0 {$rdouser}>USER</option>";
		echo "</select>";
		echo "  </div>";
		echo "</div>";
		
/* 		echo "<div class='form-group'>";
		echo "  <label for='isactive' class='col-sm-3 control-label'>Aktif / tidak Aktif</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<select class='form-control' id='isactive' name='isactive' placeholder='User Type' required>";
			if($users->isactive > 0) {
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
		echo "</div>"; */
		
		echo "<div class='form-group'>";
		echo "  <div class='col-sm-3'></div>";
		echo "  <div class='col-sm-7'>";
		echo "<button type='submit' class='btn btn-primary col-sm-2'>Simpan</button>";
		echo "<a href='/master/users/' class='btn btn-warning col-sm-2' style='margin-left:10px; padding-left:10px;'>Batal</a>";
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