<?php
	session_start();
	if (!$_SESSION['current_user']){
		header("location:/pages/failed.php");
	}
	$path = $_SERVER['DOCUMENT_ROOT'];
	if($_SESSION['current_user'] != null)
	{		
			include_once $path . '/config/database.php';
			include_once $path . '/objects/laporan.php';
			$database = new database();
			
			$db = $database->getConnection();
			
			$laporan = new laporan($db);
			
			$stotal = 0;
			
			$datefrom = !empty($_POST['datefrom']) ? $_POST['datefrom'] : date('Y-m-d');
			$dateto = !empty($_POST['dateto']) ? $_POST['dateto'] : date('Y-m-d');
			
			$page_title = "Laporan Pembelian";
			include_once $path . '/pages/header.php';
			
			echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-2'>";
			include_once $path . '/pages/sidebarmenu.php';
			echo "</div>";
			
			
			echo "<div class='col-md-9'>";
			echo "<h3>Laporan Pembelian</h3>";
			//echo "<div class='row'>";
			
			echo "<form action='' method='post' class='form-inline' role='form'>";
				
				echo "<div class='form-group'>";
				echo "<label class='control-label' for='datefrom'>Dari</label>";
				echo "<div class=''>";
					echo "<input type='date' class='form-control' name='datefrom'  value={$datefrom} required>";
				echo "</div>";
				echo "</div>";
				
				echo "<div class='form-group' style=padding-left:5px;>";
					echo "<label class='control-label' for='dateto'>Sampai</label>";
				echo "<div class=''>";
					echo "<input type='date' class='form-control' name='dateto' value={$dateto} required>";
				echo "</div>";
				echo "</div>";
				
				echo "<div class='form-group' style=padding-left:5px;>";
					echo "<label class='control-label' for='button'></label>";
				echo "<div class=''>";
				echo "<button type='submit' class='btn-md btn btn-success'>Lihat</a>";
			
				echo "</div>";
				echo "</div>";
				echo "</form>";
				
				//echo"lol";
				//print laporan
	
	if($_POST) {
			$datefrom = !empty($_POST['datefrom']) ? $_POST['datefrom'] : date('Y-m-d');
			$dateto = !empty($_POST['dateto']) ? $_POST['dateto'] : date('Y-m-d');

			//$num = $statement->rowCount();
			
			
				echo "<div class='row'>";
				echo "<div id='Print'>";
					echo "<div class='page-header'>";
						echo"<h1>Laporan Pembelian <small> Cendikia SALON & SPA</small></h1>";
						echo"<small>Dari Tanggal {$datefrom} Sampai {$dateto} </small>";
					echo"</div>";
					echo "<table class='table table-striped table-bordered'>";
					echo "<tr>";
						echo "<th>No</th>";
	//					echo "<th>Kode</th>";
						echo "<th>Barang </th>";
						//echo "<th>Pelanggan</th>";
						echo "<th>Qty</th>";
						echo "<th>Harga Beli</th>";
						echo "<th>Total Harga</th>";
						echo "<th>Supplier</th>";
						
						
					echo "</tr>";
					
			$statement = $laporan->ShowPembelianByDate($datefrom, $dateto);
			$no = 0;
			$total = 0;
			
		while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
					extract($row);
					$no += 1;
					echo "<tr>";
					echo "<td>" . $no . "</td>";
//					echo "<td>" . $row['item_kode'] . "</td>";
					echo "<td>" . $row['item_name'] . "</td>";
					echo "<td>" . $row['qty'] . "</td>";
					echo "<td>Rp." . number_format($row['harga'], 2, '.', ',') . "</td>";
					echo "<td>Rp." . number_format($row['qty'] * $row['harga'], 2, '.', ',') . "</td>";
					echo "<td>" . $row['supplier_nama'] . "</td>";
					/*echo "<td>" . $no . "</td>";
					echo "<td>" . $row['item_name'] . "</td>";
					echo "<td>" . $row['qty'] . "</td>";
					echo "<td>Rp. " . number_format($row['harga'], 2, '.', ',') . "</td>";
					echo "<td>Rp. " . number_format($row['qty'] * $row['harga'], 2, '.', ',') . "</td>";
					 */
					 echo "</tr>";
					
					$total = $row['qty'] * $row['harga'];
					$stotal = $stotal + $total;
				}

			 //batas post

			echo "</table>";
			//tulis kode di sini
			
echo "<div class='row' style='border-top: 1px solid black'>";
			echo "<p class='pull-right'>Total Pembelian = <b> Rp. " .number_format($stotal, 2, '.', ',') . "</b></p>";
echo "</div>";
	
			echo "</div>";
//			echo "</div>";
			echo "</div>";
				?>
				<button class='btn-md btn btn-success' onclick="printContent('Print')">CETAK</button>
				<?php
				echo "</div>";
				}
				echo "</div>";
				
				echo "</div>";
			include_once $path . '/pages/footer.php';
		
	}
	else
	{
		header("location:/pages/403.php");
	}
?>

<script>$(document).on('click', '.delete-object', function(){	 
	    var id = $(this).attr('kode');
	    var q = confirm("Anda yakin hapus data ini?");	 
	    if (q == true){	 
	        $.post('Delete.php', {
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
	
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
