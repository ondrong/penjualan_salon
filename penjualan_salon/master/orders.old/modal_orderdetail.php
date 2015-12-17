<?php 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/list.php';
	$lists = new lists($db);
	
	if($_POST){

		$orderdetail->order_id = $_POST['order_id'];
	    $orderdetail->item_kode = $_POST['item_kode'];
	    $orderdetail->qty = $_POST['order_qty'];
	    $orderdetail->notes = $_POST['order_notes'];
		
		$orderdetail->InsertTemp();
		header("refresh: 0");
	}
	
?>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title" id="myModalLabel">Order Detail</h4>
			</div>
			<div class="modal-body">
			<form class="form-horizontal" action="" method="post">
				<div class="row">
				<div class="form-group">
					<label class="col-md-3 control-label" for="order_id">Order ID</label>
					<div class="col-md-7">
						<input type="text" id="order_id" name="order_id" class="form-control" value="<?php echo $orders->order_id ?>" readonly>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="item_kode">Nama Item</label>
					<div class="col-md-7">
						<select id="item_kode" name="item_kode" class="form-control">
							<option>- PILIH -</option>
							<?php 
									$statement = $lists->ListItems();	
									while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
									extract($row);
										echo "<option value={$row['item_kode']}>{$row['item_name']}</option>";
									}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label" for="order_qty">Jumlah</label>
					<div class="col-md-7">
						<input type="number" id="order_qty" name="order_qty" class="form-control" value="">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label" for="order_notes">Notes</label>
					<div class="col-md-7">
						<textarea class="form-control" id="order_notes" name="order_notes"></textarea>
					</div>
				</div>
				</div>
				
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
