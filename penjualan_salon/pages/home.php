<?php
	session_start();
			$page_title = "Halaman Awal";
			include_once 'header.php';

			if($_SESSION['current_user'] != null)
	{

			include_once 'header.php';
			
			echo "<div class='row'>";
			//echo "<div class='container'>";
			echo "<div class='col-sm-3'>";
			include_once 'sidebarmenu.php';
			echo "</div>";
			//echo "</div>";
			//echo "</div>";
			echo "<div class='col-md-9'>";
				//echo "<div class='container'>";
				//echo "<div class='page'>";
				//echo "<div class=''>";
				echo "<h3>Selamat Datang $username</h3>";
				//echo "<hr>";
				echo "</div>";
			
				echo"<div class='col-md-9'>";
				echo "<div class='alert alert-success'>";
				echo"    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
				echo " <i class='alert'>Jangan Lupa Berdoa Sebelum Melakukan Aktifitas <?php echo ; ?> </i>";
				echo "</div>";
				echo "</div>";//tutup alert
			
	?>
	
				<div class="col-md-5">
				   <div class="btn-group btn-group-justified">
                        <a href="/master/supplier" class="btn btn-default col-sm-5">
                            <i class="fa fa-5x fa-external-link"></i>
                            <br> Supplier
                        </a>
                        <a href="/master/pelanggan" class="btn btn-warning col-sm-5">
                            <i class="fa fa-5x fa-share"></i>
                            <br> Pelanggan</br>
                        </a>
						<a href="/master/orders" class="btn btn-primary col-sm-5">
                            <i class="fa fa-4x fa-share"></i>
                            <br> Penjualan</br>
                        </a>
						<a href="/master/pembelian" class="btn btn-success col-sm-5">
                            <i class="fa fa-5x fa-external-link"></i>
                            <br> Pembelian</br>
                        </a>
                        <!--a href="/master/" class="btn btn-success col-sm-5">
                            <i class="fa fa-5x fa-print"></i>
                            <br> Laporan
                        </a-->
                        
                    </div> 
<hr>					
				</div>
				
				<div class="col-md-4">
				<div class="panel panel-default">
                        <div class="panel-heading">
						
                            <h4>Notices <Span class="glyphicon glyphicon-tags pull-right"></span></h4></div>
                        <div class="panel-body">
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                Jangan Lupa berdoa terlibih dahulu
                            </div>
                            </div>
                    </div>
				</div>
				
							
				
			</div>
	<?php
			echo "</div>";
	//		echo "</div>";
			include_once 'footer.php';
	}
	else
	{
		header("location: /pages/403.php");
	}
?>
