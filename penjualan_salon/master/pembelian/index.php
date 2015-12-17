<?php
	session_start();
	$page_title = "Tambah Purchase";
	include_once $_SERVER['DOCUMENT_ROOT'] . '/pages/header.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/purchase.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/purchasedetail.php';
echo "				<div class='col-md-3'>";
	include_once $_SERVER['DOCUMENT_ROOT'] .'/pages/sidebarmenu.php';
echo "				</div>";

	$database = new database();
	$db = $database->getConnection();
	
	$purchase = new purchase($db);
	$purchasedetail = new purchasedetail($db);

	$purchase->purchase_id = $purchase->AutoNumber();
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/supplier.php';
	$supplier = new supplier($db);

	$purchase->supplier_kode = !empty ($_SESSION['current_supplier']) ? $_SESSION['current_supplier']:'-' ;
	$statement = $purchasedetail->ShowTemp($purchase->purchase_id);

echo "				<div class='col-md-9'>";

//echo "<div class='container'>";
echo "<div class='panel panel-default'>";
echo "<div class='panel-body'>";
echo "			<div class='row' style='border-bottom: none;'>";
echo "				<div class='col-md-2'>";
echo "					<label>Purchase ID</label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<label id='purchase_id' value=" . $purchase->purchase_id . ">: " . $purchase->purchase_id . "</label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<label class='sr-only'></label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<div class='col-md-12'>";
echo "						<label>ID Supplier</label>";
echo "					</div>";
echo "				</div>"; 
echo "				<div class='col-md-4 form-inline'>";
echo "						<label id='supplier_kode' value=" . $purchase->supplier_kode . " >: " . $purchase->supplier_kode . "</label>";
echo "				<div class='pull-right'>";
echo"				<button name='action' value='Supp Search' id='supp_search' class='btn btn-success btn' data-toggle='modal' data-target='#myModal2'>";
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
echo "					<label id='purchase_date' value=" . date('Y-m-d') . ">: ". date('d/M/y') . "</label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<label class='sr-only'></label>";
echo "				</div>";
/* echo "				<div class='col-md-2'>";
echo "					<div class='col-md-12'>";
echo "						<label>Nama</label>";
echo "					</div>";
echo "				</div>"; 
echo "				<div class='col-md-3'>";
echo "					<label>: Nama Supplier</label>";
echo "				</div>";
echo "			</div>";
 */echo "			<div class='row'>";
echo "				<div class='form-inline col-md-8'>";
echo "					<button name='action' value='Tambah Item' id='AddItem' class='btn btn-primary btn' data-toggle='modal' data-target='#myModal1'>";
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
		$purchase_id=$item_kode;
		//echo"		<a href='deleteitem.php' kode={$item_kode} title='Hapus' class='btn btn-danger delete-object col-sm-5  glyphicon glyphicon-trash'>";
		echo "		<a kode='{$item_kode}' class='btn btn-default delete-detail'>Delete</a>";
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
			echo "<input id='hidden-total' class='sr-only' value=" . $total . "></input>";
			echo "<input id='txttotal' type='text' class='form-control text-right' value=" . number_format($total, 0, '.', ',') . " readonly>";
		echo "</div>";
echo "</div>";
echo "			<div class='row  pull-right'>";
echo "				<div class='col-md-6'>";
echo "				<button id='btnproses' type='submit' action='proses' class='btnproses btn-block btn btn-primary'>";
echo "				<i class='glyphicon glyphicon-ok'></i> Proses</button>";
echo "				</div>";
echo "				<div class='col-md-6'>";
echo "				<button id='btnremove' type='submit' action='remove' class='btn-block btn btn-primary'>";
echo "				<i class='glyphicon glyphicon-remove'></i> Batal</button>";
echo "				</div>";
echo "			</div>";
echo "		</div> <!--Panel Body-->";
echo "	</div> <!--Panel Outside-->";

include 'modal_supplier.php';
include 'modal_purchasedetail.php';
include 'proses.php';

//include_once 'modal_pelanggan.php' ;
//echo "</div><!--Container-->";
echo "</div>";
include_once $_SERVER['DOCUMENT_ROOT']  . '/pages/footer.php';
?>
<script>
$(document).on('click', '.delete-detail', function(){	 
	    var itemid = $(this).attr('kode');
		var purchaseid = $('#purchase_id').attr('value');
	    var q = confirm("Anda yakin hapus data ini?");	 
	    if (q == true){	 
	        $.post('delete_detail.php', {
	            purchaseid: purchaseid,
				itemid: itemid
	        }, function(data,status){
					alert(data);	        	
	            location.reload();
	        }).fail(function() {
	            alert('Gagal menghapus.');
	        });	 
	    }
	    return false;
	});

$(document).on('click', '#btnproses', function(){
	var purchaseid = $('#purchase_id').attr('value');
	var supplier_kode = $('#supplier_kode').attr('value');
	var purchase_date = $('#purchase_date').attr('value');
	var username = '<?php echo $_SESSION['current_user']; ?>';
		
	$.post('proses.php', {
		purchase_id: purchaseid,
		supplier_kode: supplier_kode,
		purchase_date: purchase_date,
		username: username
	}, function(data, status){ 
		alert(data);
        location.reload();
//		location.assign('struk_new.php?id=' + purchaseid);
	}).fail(function() { 
		alert('Gagal Memproses.');
	});
	return false;
	});
	
</script>