<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/list.php';
	$database = new database();
	$db = $database->getConnection();
	$lists = new lists($db);

	$statement = $lists->ListPelanggan();	
?>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title" id="myModalLabel">Pilih Pelanggan</h4>
			</div>
			<div class="modal-body">
			<form class="form-horizontal" action="#" method="post">
				<div class="form-group">
					<label class="col-md-3 control-label" for="cust_nama">Nama Pelanggan</label>
					<div class="col-md-7">
						<select id="cust_nama" name="cust_nama" class="form-control">
							<option>- PILIH -</option>
							<?php 
									$statement = $lists->ListPelanggan();	
									while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
									extract($row);
										echo "<option value={$row['cust_nama']}>{$row['cust_nama']}</option>";
									}
							?>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8"></div>				
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Proses</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>				
				</div>				
			</form>
			</div>
		</div>
	</div>
</div>
