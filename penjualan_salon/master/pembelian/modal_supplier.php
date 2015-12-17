<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/list.php';

	$database = new database();
	$db = $database->getConnection();
	$lists = new lists($db);

echo"	<div class='modal fade' id='myModal2' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='display: none;'>";
echo"	<div class='modal-dialog'>";
echo"		<div class='modal-content'>";
echo"			<div class='modal-header'>";
echo"				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>X</button>";
echo"				<h4 class='modal-title' id='myModalLabel'>Pilih Supplier</h4>";
echo"			</div>";
echo"			<div class='modal-body'>";
echo"			<form class='form-horizontal' action='' method='post'>";
echo"				<div class='form-group'>";
echo"					<label class='col-md-3 control-label' for='supplier_kode'>Nama Supplier</label>";
echo"					<div class='col-md-7'>";
echo"						<select id='supplier_kode' name='supplier_kode' class='form-control'>";
echo"							<option>- PILIH -</option>";
									$statement = $lists->ListSupplier();	
									while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
									extract($row);
										echo "<option value={$row['supplier_kode']}>{$row['supplier_nama']}</option>";
									}
echo"						</select>";
echo"					</div>";
echo"				</div>";
				
echo"				<div class='row'>";
echo"					<div class='col-md-8'></div>		";		
echo"					<div class='col-md-4'>";
echo"						<button id='pilihsupp' type='submit' class='btn btn-primary'><i class='glyphicon glyphicon-ok'></i> Proses</button>";
echo"						<button type='button' class='btn btn-default' data-dismiss='modal'>";
echo"						<i class='glyphicon glyphicon-remove'></i> Batal</button>";
echo"					</div>				";
echo"				</div>				";
echo"			</form>";
echo"			</div>";
echo"		</div>";
echo"	</div>";
echo" </div>";

	if($_POST){

		$_SESSION['current_supplier'] =  $_POST['supplier_kode'];
		$orders->supplier_kode = $_POST['supplier_kode'];

		header("refresh: 0");

//		header('location : insert.php');
	}

