<?php
	if($_POST){
		
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/customer.php';
		$customer  = new customer($db);
			$customer->cust_kode = $_POST['cust_kode'];
			$customer->cust_nama = $_POST['cust_nama'];
			$customer->cust_alamat = $_POST['cust_alamat'];
			$customer->cust_jk = $_POST['cust_jk'];
			$customer->cust_tempat = $_POST['cust_tempat'];
			$customer->cust_dob = $_POST['cust_dob'];//tanggal lahir pelanggan
			$customer->cust_hp = $_POST['cust_hp'];
			$customer->isactive = $_POST['isactive'];
			
			$customer->insert();
			header("refresh: 0");
	}
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Pelanggan</h4>
			</div>
		<div class="modal-body">
			<form class="form-horizontal" action="" method="post">
				<div class="row">
<?php
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
		echo "	<input class='form-control' id='cust_tempat' name='cust_tempat' placeholder='Tempat Lahir' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='cust_dob' class='col-sm-3 control-label'>Tanggal Lahir</label>";		
		echo"  <div class='col-sm-7'>";
		echo"  		<input type='text' class='form-control' id='cust_dob' name='cust_dob' placeholder='yyyy-mm-dd'  required>";

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
		echo "  <label for='cust_hp' class='col-sm-3 control-label'>Nomor Hp</label>";		
		echo"  <div class='col-sm-7'>";
		echo"  		<input type='text' class='form-control' id='cust_hp' name='cust_hp' placeholder='+62 / 08******'  required>";

		echo"  </div>";
		echo" </div>";
		
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

				?>
				<div class="row">
					<div class="col-md-8"></div>				
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Tambah</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>				
				</div>
<script>
	$('#cust_dob').datepicker({
    		format: 'yyyy-mm-dd'
		});
	</script>
	
			</form>
			
			</div>
		</div>
	</div>
</div>
</div>
