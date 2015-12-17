<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>

<?php
	$page_title = "Struk Purchase";
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/purchase.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/purchasedetail.php';

	$database = new database();
	$db = $database->getConnection();
	$purchase = new purchase($db);
	$purchasedetail = new purchasedetail($db);

	$struk_purchaseid = !empty($struk_purchaseid) ? $struk_purchaseid : $_GET['id'];
	
	$row = $purchase->ShowPurchase($struk_purchaseid);

	echo"<div id='Print'>";//division untuk di print
	echo "<p>SALON &amp; SPA KECANTIKA</p>";
//	echo"-------------------------------------------------------------------";
	echo"_______________________________________";
	echo "<p>purchase ID : {$row['purchase_id']} </p>";
	echo "<p>Date : {$row['purchase_date']} </p>";
	echo "<p>Supplier : {$row['supplier_nama']} </p>";
	
	
echo "				<table class='table table-hover table-responsive table-bordered' style='border-top: 1px solid black'>";
echo "					<tr>";
echo "						<th style='border-bottom: 1px solid black'>No </th>";
echo "						<th style='border-bottom: 1px solid black'>Nama Item </th>";
echo "						<th style='border-bottom: 1px solid black'>Qty</th>";
echo "						<th style='border-bottom: 1px solid black'>Harga Satuan</th>";
echo "						<th style='border-bottom: 1px solid black'>Total</th>";
echo "					</tr>";

	$no = 0;
	$total = 0;

	$statement = $purchasedetail->ShowData($struk_purchaseid);

	while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
		extract($row);
		$no += 1;
		echo "<tr>";
		echo "<td>" . $no . "</td>";
		echo "<td>" . $row['item_name'] . "</td>";
		echo "<td>" . $row['qty'] . "</td>";
		echo "<td>Rp. " . number_format($row['harga'], 2, '.', ',') . "</td>";
		echo "<td>Rp. " . number_format($row['qty'] * $row['harga'], 2, '.', ',') . "</td>";
		echo "</td>";
		echo "</tr>";
		$total = $total + $row['qty'] * $row['harga'];
	}

echo "			</table>";

//echo"-------------------------------------------------------------------";
echo"_______________________________________";
echo"<p>Total : " . number_format($total, 2, '.', ',') . "</p>";

//echo"-------------------------------------------------------------------";
echo"_______________________________________";
echo"<p>*Barang yang di beli tidak bisa di kembalika lagi</p>";
echo"<p>***************terimakasih**************</p>";
echo"</div>"; //akhir dari div print
?>

<button class='btn-md btn btn-success' onclick="printContent('Print')">CETAK</button>
