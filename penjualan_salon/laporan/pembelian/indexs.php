<?php
	session_start();
	if (!$_SESSION['current_user']){
		header("location:/pages/failed.php");
	}
	$path = $_SERVER['DOCUMENT_ROOT'];
	if($_SESSION['current_user'] != null)
	{		
			include_once $path . '/config/database.php';
			$database = new database();
			$db = $database->getConnection();
			
			$datefrom = !empty($_POST['datefrom']) ? $_POST['datefrom'] : date('Y-m-d');
			$dateto = !empty($_POST['dateto']) ? $_POST['dateto'] : date('Y-m-d');
			
			$page_title = "Laporan Pembelian";
			include_once $path . '/pages/header.php';
			
			echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-3'>";
			include_once $path . '/pages/sidebarmenu.php';
			echo "</div>";

			echo "<h3>Laporan pembelian</h3>";
			echo "<div class='row'>";
			
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
				
				echo"lol";
				
				//tulis kode di sini
				echo "</div>";
				echo "</div>";
//				echo "</div>";
	//			echo "</div>";
			//include_once 'modalupdate.php';
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
</script>