<?php
	if($_POST){
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/items.php';
		$items  = new items($db);
		$items->item_kode = $_POST['item_kode'];
		$items->item_name = $_POST['item_name'];
		$items->item_note = $_POST['item_note'];
		$items->isavailable = $_POST['isavailable'];
		$items->harga = $_POST['harga'];
		$items->item_type = 'BARANG';//$_POST['item_type'];
			
		$items->insert();
			header("refresh: 0");
	}
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Barang</h4>
			</div>
		<div class="modal-body">
			<form class="form-horizontal" action="" method="post">
				<div class="row">
				<?php
					echo "<div class='form-group'>";
		echo "  <label for='item_kode' class='col-sm-3 control-label'>Kode Barang</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='item_kode' placeholder='Kode Barang' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='item_name' class='col-sm-3 control-label'>Nama Barang</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<input type='text' class='form-control' name='item_name' placeholder='Nama Barang' required>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='item_note' class='col-sm-3 control-label'>Keterangan</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<textarea type='text' class='form-control' name='item_note' placeholder='Keterangan Barang' required></textarea>";
		echo "  </div>";
		echo "</div>";
		
		echo "<div class='form-group'>";
		echo "  <label for='isavailable' class='col-sm-3 control-label'>Tersedia / Tidak</label>";
		echo "  <div class='col-sm-7'>";
		echo "	<select class='form-control' id='isavailable' name='isavailable' placeholder='User Type' required>";
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
		echo "	<input type='number' class='form-control' name='harga' placeholder='Harga' required>";
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