<style>
.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#ccc;
}
<?php
session_start();
ob_start();
if (!$_SESSION['current_user']){
	header("location:/pages/failed.php");
	}
	$path = $_SERVER['DOCUMENT_ROOT'];
	if($_SESSION['current_user'] != null)
	{		
			include_once $path . '/config/database.php';
			$database = new database();
			$db = $database->getConnection();
		
			$page_title = "Data Karyawan";
			include_once $path . '/pages/header.php';
			
			echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-3'>";
			include_once $path . '/pages/sidebarmenu.php';
			echo "</div>";
			
		include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/users.php';
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$records_per_page = 5;
		$from_record_num = ($records_per_page * $page) - $records_per_page;

		$users = new users($db);
		$statement = $users->readAll($from_record_num, $records_per_page);
		$num = $statement->rowCount();
		echo "<div class='col-md-8'>";
		if($num>0){
			?>
			<div>
						<div class="form-group pull-right">
					<input type="text" class="search form-control" placeholder=" Apa Yang Anda Cari?">
			</div>	

			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li class="active">Data Karyawan</li>
			</ol>
			
			</div>
			<div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Karyawan
                        </div>
                        <div class="panel-body">
						
                            <div class="table-responsive">
                                <table id='example' class="table table-striped table-bordered table-hover results" cellspacing='0' width='100%'>
                                    <thead>
                                        <tr>
                                        		<th>No</th>
                                        		<th>Username</th>
                                        		<th>Level</th>
                                        		<th>Actions</th>
                                        </tr>
										<tr class="warning no-result">
										<td colspan="4"><i class="fa fa-warning"></i> Data Tidak Di temukan</td>
										</tr>
                                    </thead>
			
			
	<?php
		$total_rows = $users->countAll();
				//$nomor=($page-1)*$total_rows;
				//$nomor=($page-1)*5;
				$halaman = 0;
				$subtotal = 0;
				$no = isset($no) ? $users->nomor : 0;
	
				while ($row = $statement->fetch(PDO::FETCH_ASSOC)){	 
					extract($row);
					echo "<tr>";
					$no += 1; //= $no + 1;
					
				//$x = 0;
					echo "<tr>";
						echo "<td>{$no}</td>";
						echo "<td>{$username}</td>";
						//echo "<td>{$password}</td>";
						echo "<td>";
						if($userlevel > 0)
							echo "Admin";
						else
							echo "User";
						echo "</td>";
					/* 	echo "<th>";
						if($isactive ==1)
							echo "Active";
						else
							echo "Tidak Active";
						echo"</th>";
					 */	//style='width:200px;
						echo "<td>";
							echo "<a href='update.php?id={$username}' title='Ubah' class='btn btn-success col-sm-4 glyphicon glyphicon-edit'></button>";
							//echo "<a  data-toggle='modal' data-target='#UpdateModal' title='Ubah' class='btn btn-success col-sm-4'><i class='glyphicon glyphicon-edit'></i></a>";
							//echo "<a href='detail.php?id={$username}' title='Detail' class='btn btn-default col-sm-4  glyphicon glyphicon-zoom-in'></a>";
							echo "<a href='delete.php' kode={$username} title='Hapus' class='btn btn-danger col-sm-4 delete-object glyphicon glyphicon-trash'>";
						echo "</td>";
					echo "</tr>";
					$users->nomor = $no;
					//$x = $x + 1;
					}
			echo "</table>";

				//echo $users->nomor;
				echo "</div>";
?>
				<button name="action" id="" class="btn btn-primary btn" data-toggle="modal" data-target="#myModal">
					Tambah Data
				</button>
<?php
			echo "</div>";
			echo "</div>";
			echo "<div class='row text-center'>";
			include_once 'paging.php';
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
	else
		{
			echo "<div>Data Tidak Ada</div>";
		}
			//include_once 'modalupdate.php';
			include_once 'modalinsert.php';
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
$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});	
	
</script>
