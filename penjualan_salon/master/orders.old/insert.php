<?php
	session_start();
	$page_title = "Tambah Order";
	include_once $_SERVER['DOCUMENT_ROOT'] . '/pages/header.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/orders.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/orderdetail.php';
echo "				<div class='col-md-3'>";
	include_once $_SERVER['DOCUMENT_ROOT'] .'/pages/sidebarmenu.php';
echo "				</div>";

	$database = new database();
	$db = $database->getConnection();
	$orders = new orders($db);
	$orderdetail = new orderdetail($db);

	$orders->order_id = $orders->AutoNumber();
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/customer.php';
	$custoer = new customer($db);
	$customer = new customer($db);

	$orders->cust_kode = "";
	$statement = $orderdetail->ShowTemp($orders->order_id);
	$bayar = isset($bayar) ? $bayar : 0;
	$kembali = isset($kembali) ? $kembali : 0;

echo "				<div class='col-md-9'>";

//echo "<div class='container'>";
echo "<div class='panel panel-default'>";
echo "<div class='panel-body'>";
echo "			<div class='row' style='border-bottom: none;'>";
echo "				<div class='col-md-2'>";
echo "					<label>Order No</label>";
echo "				</div>";
echo "				<div class='col-md-3'>";
echo "					<label>: " . $orders->order_id . "</label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<label class='sr-only'>Order No</label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<div class='col-md-8'>";
echo "						<label>Pelanggan</label>";
echo "					</div>";
echo "				</div>"; 
/* echo " <div class='form-group'>";
echo "				<label class='col-md-2 control-label' for='cust_kode'>Nama Pelanggan</label>";
echo "					<div class='col-md-8'>";
echo "						<select id='cust_kode' name='cust_kode' class='form-control'>";
echo "							<option>- PILIH -</option>";
									$statement = $lists->ListPelanggan();	
									while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
									extract($row);
echo "										<option value={$row['cust_nama']}>{$row['cust_nama']}</option>";
									}
echo "						</select>";
echo "					</div>";
echo "				</div>";
 */
echo "				<div class='col-md-3 form-inline'>";
echo "						<label>: " . $orders->cust_kode . "</label>";
//echo "						<a href='#' class='pull-right'>Ganti</a>";
echo "				<div class='pull-right'>";
echo"				<button name='action' value='Cek Ongkos' id='cust_search' class='btn btn-success btn' data-toggle='modal' data-target='#myModal2'>";
echo "				<i class='glyphicon glyphicon-edit'></i> Ganti";
echo "				</button>";
echo "				</div>";
echo "				</div>";
echo "			</div>";

echo "			<div class='row'>";
echo "				<div class='col-md-2'>";
echo "					<label>Tanggal</label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<label>: ". date('d/M/y') . "</label>";
echo "				</div>";
echo "			</div>";
echo "			<div class='row'>";
echo "				<div class='form-inline col-md-8'>";
echo "					<button name='action' value='Cek Ongkos' id='cust_search' class='btn btn-primary btn' data-toggle='modal' data-target='#myModal1'>";
echo "					<i class='glyphicon glyphicon-plus'></i> Tambah Item";
echo "					</button>";
echo "				</div>";
echo "			</div>";
echo "			<div class='row'>";
echo "			<div class='col-md-12'>";
echo "				<table class='table table-hover table-responsive table-bordered'>";
echo "					<tr>";
echo "						<th>No</th>";
echo "						<th>Item Name</th>";
echo "						<th>Qty</th>";
echo "						<th>Harga Satuan</th>";
echo "						<th>Total</th>";
echo "						<th>Action</th>";
echo "					</tr>";

	$no = 0;
	$total = 0;

	while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
		extract($row);
		$no += 1;
		echo "<tr>";
		echo "<td>" . $no . "</td>";
		echo "<td>" . $row['item_name'] . "</td>";
		echo "<td>" . $row['qty'] . "</td>";
		echo "<td>Rp. " . number_format($row['harga'], 2, '.', ',') . "</td>";
		echo "<td>Rp. " . number_format($row['qty'] * $row['harga'], 2, '.', ',') . "</td>";
		echo "<td>";
					$order_id=$item_kode;
		//echo"		<a href='deleteitem.php' kode={$item_kode} title='Hapus' class='btn btn-danger delete-object col-sm-5  glyphicon glyphicon-trash'>";
		echo "		<a kode='{$item_kode}' id='{$item_kode}' class='btn btn-default delete-object'>Delete</a>";
		echo "</td>";
		echo "</tr>";
		$total = $total + $row['qty'] * $row['harga'];
	}

echo "				</table>";
echo "			</div>";
echo "		</div>";
echo "			<div class='row'>";
//Label Total
		echo "<div class='col-md-4 col-md-offset-6 text-right'>";
			echo "<label class='label-control' for='txttotal'>Total :</label>";
		echo "</div>";
//Angka Total
		echo "<div class='col-md-2'>";			
//			echo "<input id='txttotal' type='text' class='form-control text-right' value=" . $total. " readonly>";
			echo "<input id='hidden-total' class='sr-only' value=" . $total . "></input>";
			echo "<input id='txttotal' type='text' class='form-control text-right' value=" . number_format($total, 0, '.', ',') . " readonly>";
		echo "</div>";
//Label Total
		echo "<div class='col-md-4 col-md-offset-6 text-right'>";
			echo "<input id='hidden-bayar' class='sr-only' value=" . $bayar . "></input>";
			echo "<label class='label-control' for='txtbayar'>Bayar :</label>";
		echo "</div>";
//Angka Total
		echo "<div class='col-md-2'>";
			echo "<input id='hidden-total' class='sr-only' value=" . $kembali . "></input>";
			echo "<input id='txtbayar' type='text' class='form-control text-right'>";
		echo "</div>";
//Label Total
		echo "<div class='col-md-4 col-md-offset-6 text-right'>";
			echo "<label class='label-control' for='txtkembali'>Kembali :</label>";
		echo "</div>";
//Angka Total
		echo "<div class='col-md-2'>";			
			echo "<input id='txtkembali' type='text' class='form-control text-right' value='' readonly>";
		echo "</div>";
echo "</div>";
echo "			<div class='row  pull-right'>";
echo "				<div class='col-md-6'>";
echo "				<button id='btnproses' type='submit' action='proses' class='btn-block btn btn-primary'>";
echo "				<i class='glyphicon glyphicon-ok'></i> Proses</button>";
echo "				</div>";
echo "				<div class='col-md-6'>";
echo "				<button id='btnremove' type='submit' action='remove' class='btn-block btn btn-primary'>";
echo "				<i class='glyphicon glyphicon-remove'></i> Batal</button>";
echo "				</div>";
echo "			</div>";
echo "		</div> <!--Panel Body-->";
echo "	</div> <!--Panel Outside-->";
include_once 'modal_orderdetail.php';
include_once 'modal_pelanggan.php';
include_once 'proses.php';
//include_once 'modal_pelanggan.php' ;
//echo "</div><!--Container-->";
echo "</div>";
include_once $_SERVER['DOCUMENT_ROOT']  . '/pages/footer.php';
?>
<script>
$(document).on('click', '.delete-object', function(){	 
	    var id = $(this).attr('kode');
	    var q = confirm("Anda yakin hapus data ini?");	 
	    if (q == true){	 
	        $.post('deletitem.php', {
	            object_id: id
	        }, function(data,status){
					alert(data);	        	
	            location.reload();
	        }).fail(function() {
	            alert('Gagal menghapus.');
	        });	 
	    }
	    return false;
	});

$('#txtbayar')
.keydown(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		var bayar = accounting.unformat(this.value);
		var x = (document.getElementById("txttotal").value);
		var total = document.getElementById("hidden-total").value;
		var kembalian = bayar - total;
				
		if(keycode == '13'){
			document.getElementById("txtkembali").value = accounting.formatNumber(kembalian);
			this.value = accounting.formatNumber(bayar);
		}})
.focus(function(){this.value = null;})
.click(function(){this.value = null;})
.change(function(){
		var bayar = accounting.unformat(this.value);
		var x = (document.getElementById("txttotal").value);
		var total = document.getElementById("hidden-total").value;
		var kembalian = bayar - total;

		this.value = accounting.formatNumber(accounting.unformat(this.value));
		document.getElementById("txtkembali").value = accounting.formatNumber(kembalian);
		document.getElementById("hidden-bayar").value = accounting.unformat(this.value);

});

$('#btnproses').click(function(event){
/*	var orderid = $(#order_id).value;
	var orderdate = $(#order_id).value;
	var custid = $(#order_id).value;
	var bayar = $(#order_id).value;*/
	location.reload();
});
</script>