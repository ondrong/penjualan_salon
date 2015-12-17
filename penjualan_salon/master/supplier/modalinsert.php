<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/supplier.php';
		$supplier  = new supplier($db);
		$supplier->supplier_kode = $_POST['supplier_kode'];
		$supplier->supplier_nama = $_POST['supplier_nama'];
		$supplier->supplier_alamat = $_POST['supplier_alamat'];
		$supplier->supplier_hp = $_POST['supplier_hp'];
		$supplier->isactive = $_POST['isactive'];
			
		$supplier->insert();
		header("refresh: 0");
	}
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Supplier</h4>
			</div>
		<div class="modal-body">
			<form class="form-horizontal" action="" method="post">
				<div class="row">
				<?php
					echo "<div class='form-group'>";
		echo "  <label for='supplier_kode' class='col-sm-3 control-label'>Supplier Kode</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' placeholder='Kode Supplier' name='supplier_kode' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='supplier_nama' class='col-sm-3 control-label'>Nama Supplier</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' placeholder='Nama Supplier' name='supplier_nama' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='supplier_alamat' class='col-sm-3 control-label'>Alamat Supplier</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' placeholder='Alamat Supplier' name='supplier_alamat' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='supplier_hp' class='col-sm-3 control-label'>Nomor Hp</label>";		
		echo"  <div class='col-sm-7'>";
		echo"  		<input type='text' class='form-control' id='supplier_hp' name='supplier_hp' placeholder='+62 / 08******'  required'>";

		echo"  </div>";
		echo" </div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='isactive' class='col-sm-3 control-label'>Aktif / Tidak</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<select class='form-control' id='isactive' name='isactive' placeholder='Alamat Supplier' required>";
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
				?>
				<div class="row">
					<div class="col-md-8"></div>				
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Tambah</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>				
				</div>				
			</form>
			</div>
		</div>
	</div>
</div>
</div>