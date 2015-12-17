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
	$customer = new customer($db);

	$orders->cust_kode = $_SESSION['current_customer'];
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
echo "				<div class='col-md-2'>";
echo "					<label id='order_id' value=" . $orders->order_id . ">: " . $orders->order_id . "</label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<label class='sr-only'></label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<div class='col-md-12'>";
echo "						<label>ID Pelanggan</label>";
echo "					</div>";
echo "				</div>"; 
echo "				<div class='col-md-4 form-inline'>";
echo "						<label id='cust_kode' value=" . $orders->cust_kode . " >: " . $orders->cust_kode . "</label>";
echo "				<div class='pull-right'>";
echo"				<button name='action' value='Cust Search' id='cust_search' class='btn btn-success btn' data-toggle='modal' data-target='#myModal2'>";
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
echo "					<label id='order_date' value=" . date('Y-m-d') . ">: ". date('d/M/y') . "</label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<label class='sr-only'></label>";
echo "				</div>";
echo "				<div class='col-md-2'>";
echo "					<div class='col-md-12'>";
echo "						<label>Nama</label>";
echo "					</div>";
echo "				</div>"; 
echo "				<div class='col-md-3'>";
echo "					<label>: Nama Pelanggan</label>";
echo "				</div>";
echo "			</div>";
echo "			<div class='row'>";
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
					$order_id=$item_kode;
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

include 'modal_pelanggan.php';
include 'modal_orderdetail.php';
include 'proses.php';

//include_once 'modal_pelanggan.php' ;
//echo "</div><!--Container-->";
echo "</div>";
include_once $_SERVER['DOCUMENT_ROOT']  . '/pages/footer.php';
?>
<script>
$(document).on('click', '.delete-detail', function(){	 
	    var itemid = $(this).attr('kode');
		var orderid = $('#order_id').attr('value');
	    var q = confirm("Anda yakin hapus data ini?");	 
	    if (q == true){	 
	        $.post('delete_detail.php', {
	            orderid: orderid,
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

$(document).on('click', '#btnproses', function(){
	var orderid = $('#order_id').attr('value');
	var cust_kode = $('#cust_kode').attr('value');
	var order_date = $('#order_date').attr('value');
	var username = '<?php echo $_SESSION['current_user']; ?>';
		
	$.post('proses.php', {
		order_id: orderid,
		cust_kode: cust_kode,
		order_date: order_date,
		username: username
	}, function(data, status){ 
		alert(data);
		location.assign('struk_new.php?id=' + orderid);
	}).fail(function() { 
		alert('Gagal Memproses.');
	});
	return false;
	});
	
function ChangeCust() {
	var cust_kode = "<?php echo $_SESSION['current_customer']; ?>";
	alert(cust_kode);
    // $.post('etc.php', {
		// hewan_kode : hewan_kode,
		// id : kategori_id
	// }, function(data){
		// document.getElementById("maxqty").innerHTML = "Max Qty = " + data;
		
		// if(parseInt(data)<=0)
			// alert("Tidak ada stok");
		// document.getElementById("qty").max = parseInt(data);
	};	
</script>