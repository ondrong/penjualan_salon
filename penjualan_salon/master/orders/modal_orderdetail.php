<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/list.php';
	$lists = new lists($db);
	

echo "<div class='modal fade' id='myModal1' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='display: none;'>";
echo "	<div class='modal-dialog'>";
echo "		<div class='modal-content'>";
echo "			<div class='modal-header'>";
echo "				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>X</button>";
echo "				<h4 class='modal-title' id='myModalLabel'>Order Detail</h4>";
echo "			</div>";
echo "			<div class='modal-body'>";
echo "			<form class='form-horizontal' action='' method='post'>";
echo "				<div class='row'>";
echo "				<div class='form-group'>";
echo "					<label class='col-md-3 control-label' for='order_id'>Order ID</label>";
echo "					<div class='col-md-7'>";
echo "						<input type='text' id='order_id' name='order_id' class='form-control' value='{$orders->order_id}' readonly>";
echo "					</div>";
echo "				</div>";

echo "				<div class='form-group'>";
echo "					<label class='col-md-3 control-label' for='item_kode'>Nama Item</label>";
echo "					<div class='col-md-7'>";
echo "						<select id='item_kode' name='item_kode' class='form-control'>";
echo "							<option>- PILIH -</option>";

									$statement = $lists->ListItems();	
									while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
									extract($row);
										echo "<option value={$row['item_kode']}>{$row['item_name']}</option>";
									}
echo "						</select>";
echo "					</div>";
echo "				</div>";

echo "				<div class='form-group'>";
echo "					<label class='col-md-3 control-label' for='order_qty'>Jumlah</label>";
echo "					<div class='col-md-7'>";
echo "						<input type='number' id='order_qty' name='order_qty' class='form-control' value='' required>";
echo "					</div>";
echo "				</div>";
								
echo "				<div class='row'>";
echo "					<div class='col-md-8'></div>";				
echo "					<div class='col-md-4'>";
echo "						<button type='submit' class='btn btn-primary' name='action' value='act_orderdetail'><i class='glyphicon glyphicon-ok'></i> Tambah</button>";
echo "						<button type='button' class='btn btn-default' data-dismiss='modal'>";
echo "						<i class='glyphicon glyphicon-remove'></i> Batal</button>";
echo "					</div>		";		
echo "				</div>				";
echo "			</form>";
echo "			</div>";
echo "		</div>";
echo "	</div>";
echo " </div>";

	if($_POST){

		$orderdetail->order_id = $_POST['order_id'];
	    $orderdetail->item_kode = $_POST['item_kode'];
	    $orderdetail->qty = $_POST['order_qty'];
		$orderdetail->username = $_SESSION['current_user'];
		
		$orderdetail->InsertTemp();
//		header('location : insert.php');
		header('refresh: 0');
	}
	
?>

