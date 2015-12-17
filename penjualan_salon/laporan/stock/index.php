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
			$page_title = "Laporan Stock Barang";
			include_once $path . '/pages/header.php';
			
			echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-2'>";
			include_once $path . '/pages/sidebarmenu.php';
			echo "</div>";
			
			
			echo "<div class='col-md-9'>";
//			echo "<h3>Laporan Stock Barang</h3>";
			//echo "<div class='row'>";
				//echo"lol";
				//print laporan
	
			//$num = $statement->rowCount();
			
			
				echo "<div class='row'>";
				echo "<div id='Print'>";
					echo "<div class='page-header'>";
						echo"<h1>Laporan Stock Barang <small> Cendikia SALON & SPA</small></h1>";
					echo"</div>";
				echo "<table class='table table-striped table-bordered '>";
					echo "<tr>";
						echo "<th>No</th>";
						echo "<th>Nama Barang</th>";
						//echo "<th>Pelanggan</th>";
						echo "<th>Total Stock</th>";
						echo "<th>Last Update</th>";
						echo "<th>Petugas</th>";
					echo "</tr>";
					
			$statement = $laporan->ShowStockBarang();
			$no = 0;
			$total = 0;
			
				while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
					extract($row);
					$no += 1;
					echo "<tr>";
					echo "<td>" . $no . "</td>";
					echo "<td>" . $row['item_name'] . "</td>";
					echo "<th>". number_format($row['qty']) ."</th>";
					//date_format($date,"Y/m/d H:i:s");
					echo "<td>" . $row['last_update'] . "</td>";
					echo "<td>" . $row['username'] . "</td>";
					/*echo "<td>Rp. " . number_format($row['harga'], 2, '.', ',') . "</td>";
					echo "<td>Rp. " . number_format($row['qty'] * $row['harga'], 2, '.', ',') . "</td>";
					*/
					echo "</tr>";
					
//					$total = $row['qty'] * $row['harga'];
					$stotal = $stotal + $total;
				}

			 //batas post

			echo "</table>";
			//tulis kode di sini
			
/*echo "<div class='row' style='border-top: 1px solid black'>";
			echo "<p class='pull-right'>Total Penjualan = <b> Rp. " .number_format($stotal, 2, '.', ',') . "</b></p>";
echo "</div>";
	*/
			echo "</div>";
//			echo "</div>";
			echo "</div>";
				?>
				<button class='btn-md btn btn-success' onclick="printContent('Print')">CETAK</button>
				<?php
				echo "</div>";
				
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
