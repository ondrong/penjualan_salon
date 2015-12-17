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
		
			$page_title = "Data Order";
			include_once $path . '/pages/header.php';
						echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-3'>";
			include_once $path . '/pages/sidebarmenu.php';
			echo "</div>";

		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/data.php';
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$records_per_page = 20;
		$from_record_num = ($records_per_page * $page) - $records_per_page;
		$data = new data($db);
		$statement = $data->showOrderData($from_record_num, $records_per_page);
		$num = $statement->rowCount();
		echo "<div class='container'>";
		echo "<div class='col-md-9'>";
		if($num>0){
	?>
		
		<div>
			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li class="active">Data Order</li>
			</ol>
		</div>
			
			<div class="row">
            <div class="col-md-12">
			<div class="panel panel-primary">
                        <div class="panel-heading">			
			               Data Order
                        </div>
                        <div class="panel-body">
						
				<div class="row">
				<div class="col-md-12">
				<div class="table-responsive">
                                <table id='example' class="table table-striped table-bordered table-hover" cellspacing='0' width='100%'>
                                        <thead>
										<tr>
                                        		<th>No</th>
                                        		<th>Kode Order</th>
												<th>Tangggal Order</th>
                                        		<th>Nama Pembeli</th>
												<th>Petugas</th>
                                        		<th>Action</th>
                                        </tr>
										</thead>
  <?php

				$no = 0;
				$total = 0;
				while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
				extract($row);
				$no += 1;
				echo "<tr>";
				echo "<td>" . $no . "</td>";
//					echo "<td>" . $row['item_kode'] . "</td>";
				echo "<td>" . $row['order_id'] . "</td>";
				echo "<td>" . $row['order_date'] . "</td>";
				echo "<td>" . $row['cust_nama'] . "</td>";
				echo "<td>" . $row['username'] . "</td>";
				echo "<td style='width:120px;'>";
				echo "<a href='orderdetail.php?id={$order_id}' title='Lihat' class='btn btn-success col-sm-7'>Lihat";
		//					echo "<a href='detail.php?id={$cust_kode}' title='Detail' class='btn btn-default col-sm-4  glyphicon glyphicon-zoom-in disabled'></a>";
				//echo "<a href='delete.php' kode={$supplier_kode} title='Hapus' class='btn btn-danger delete-object col-sm-4  glyphicon glyphicon-trash'></a>";
				echo "</td>";
				echo "</tr>";
				}
				echo "</table>";
							echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			
			
			echo "<div class='row text-center'>";
			include_once 'paging.php';
			//echo "</div>";
			echo "</div>";
			echo "</div>";
		}
	else
		{
			echo "<div>Data Tidak Ada</div>";
		}
		//	include_once 'modalinsert.php';
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
