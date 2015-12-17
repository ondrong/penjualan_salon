<?php
			$nama = isset($_SESSION['current_user']) ? $_SESSION['login_setup'] : null;
			include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
			$database = new database();
			$db = $database->getConnection();
			
			include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/users.php';
			$users  = new users($db);
			$users->username=$_SESSION['current_user'];
			$statement = $users->UserType();
			
			if($users->UserType()=="ADMIN")
			{
			echo "<div class='panel panel-primary' style='margin-top:2px;'>";
				echo "	<div class='panel-heading'> </div>";
  echo "<div class='panel-body'>";
	echo "	<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#menu-master'> MASTER<i class='pull-right caret'></i></a>";
		echo "<div class='collapse' id='menu-master'>";
			echo "<ul class='list-group'>";
				echo "<li class='list-group-item'><a href='/admin/karyawan/index.php'>Data Karyawan</a></li>";
			echo "	<!--";
					echo "<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#data'> MASTER<i class='pull-right caret'></i></a>";
			echo "		<div class='collapse' id='data'>";
					echo "	<ul class='list-group'>";
			echo "			<li class='list-group-item'><a href='/master/prodi/index.php'>Data Karyawan</a></li>";
					echo "	</ul>";
			echo "		</div>";
				
			echo "	</li-->";
			echo "	<li class='list-group-item'><a href='/master/pelanggan/index.php'>Data Pelanggan</a></li>";
			echo "	<li class='list-group-item'><a href='/master/jasa/index.php'>Data Jasa Salon</a></li>";
			echo "	<li class='list-group-item'><a href='/master/barang/index.php'>Data Barang</a></li>";
			echo "	<li class='list-group-item'><a href='/master/supplier/index.php'>Data Supplier</a></li>";
			echo "</ul>";
	echo "	</div>  ";
	echo "	<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#menu-mahasiswa'> TRANSAKSI <i class='pull-right caret'></i></a>";
	echo "	<div class='collapse' id='menu-mahasiswa'>";
	echo "		<ul class='list-group'>";
	echo "			<li class='list-group-item'><a href='/master/pembelian/index.php'>Transaksi Pembelian</a></li>";
	echo "			<li class='list-group-item'><a href='/master/penjualan/index.php'>Transaksi Penjualan Barang dan Jasa</a></li>";
	echo "			</ul>";
	echo "	</div>";
	echo "	<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#menu'> LAPORAN <i class='pull-right caret'></i></a>";
	echo "	<div class='collapse' id='menu'>";
echo "			<ul class='list-group'>";
		echo "		<li class='list-group-item'><a href='/master/laporan/pembelian/'>Laporan pembelian</a></li>";
				echo "<li class='list-group-item'><a href='/master/laporan/penjualan/'>Laporan penjualan</a></li>";			
		echo "	</ul>";
		echo "</div>";
echo "		<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#opsi'> LAIN-LAIN<i class='pull-right caret'></i></a>";
		echo "<div class='collapsed' id='opsi'>";
			echo "<ul class='list-group'>";
				echo "<!--li class='list-group-item'><a href='/master//index.php'>Option</a></li-->";
				echo "<li class='list-group-item'><a href='/pages/session.php?act=logoff'>Keluar</a></li>			";
		echo "	</ul>";
		echo "</div>";
echo "  </div>";
echo "</div>";
			}
			else
			{
				echo "<div class='panel panel-default' style='margin-top:2px;'>";
				echo "	<div class='panel-heading'> </div>";
  echo "<div class='panel-body'>";
	echo "	<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#menu-master'> MASTER<i class='pull-right caret'></i></a>";
		echo "<div class='collapse' id='menu-master'>";
			echo "<ul class='list-group'>";
			//	echo "<li class='list-group-item disabled'><a href='/admin/karyawan/index.php'>Data Karyawan</a></li>";
			echo "	<!--";
					echo "<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#data'> MASTER<i class='pull-right caret'></i></a>";
			echo "		<div class='collapse' id='data'>";
					echo "	<ul class='list-group'>";
			echo "			<li class='list-group-item'><a href='/master/prodi/index.php'>Data Karyawan</a></li>";
					echo "	</ul>";
			echo "		</div>";
				
			echo "	</li-->";
			echo "	<li class='list-group-item'><a href='/master/pelanggan/index.php'>Data Pelanggan</a></li>";
			echo "	<li class='list-group-item'><a href='/master/jasa/index.php'>Data Jasa Salon</a></li>";
			echo "	<li class='list-group-item'><a href='/master/barang/index.php'>Data Barang</a></li>";
			echo "	<li class='list-group-item'><a href='/master/supplier/index.php'>Data Supplier</a></li>";
			echo "</ul>";
	echo "	</div>  ";
	echo "	<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#menu-mahasiswa'> TRANSAKSI <i class='pull-right caret'></i></a>";
	echo "	<div class='collapse' id='menu-mahasiswa'>";
	echo "		<ul class='list-group'>";
	echo "			<li class='list-group-item'><a href='/master/pembelian/index.php'>Transaksi Pembelian</a></li>";
	echo "			<li class='list-group-item'><a href='/master/penjualan/index.php'>Transaksi Penjualan Barang dan Jasa</a></li>";
	echo "			</ul>";
	echo "	</div>";
	echo "	<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#menu'> LAPORAN <i class='pull-right caret'></i></a>";
	echo "	<div class='collapse' id='menu'>";
echo "			<ul class='list-group'>";
		echo "		<li class='list-group-item'><a href='/master/laporan/pembelian/'>Laporan pembelian</a></li>";
				echo "<li class='list-group-item'><a href='/master/laporan/penjualan/'>Laporan penjualan</a></li>";			
		echo "	</ul>";
		echo "</div>";
echo "		<a style='border-bottom:2px solid #fff;' href='#' class='list-group-item active collapsed' data-toggle='collapse' data-target='#opsi'> LAIN-LAIN<i class='pull-right caret'></i></a>";
		echo "<div class='collapsed' id='opsi'>";
			echo "<ul class='list-group'>";
				echo "<!--li class='list-group-item'><a href='/master//index.php'>Option</a></li-->";
				echo "<li class='list-group-item'><a href='/pages/session.php?act=logoff'>Keluar</a></li>			";
		echo "	</ul>";
		echo "</div>";
echo "  </div>";
echo "</div>";
			}

?>
