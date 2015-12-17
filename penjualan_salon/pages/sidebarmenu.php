<?php
			$nama = isset($_SESSION['current_user']) ? $_SESSION['login_setup'] : null;
			include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
			$database = new database();
			$db = $database->getConnection();
			
			include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/users.php';
			$users  = new users($db);
			$users->username=$_SESSION['current_user'];
			$statement = $users->UserType();
			?>
<div>
<ul class='nav nav-stacked'>
<?php					
     if($users->UserType()=='ADMIN')
			{
			echo"   <li class='nav-header'> <a href='#' data-toggle='collapse' data-target='#userMenu'>Master <i class='glyphicon glyphicon-chevron-right'></i></a>";
            echo"     <ul class='nav nav-stacked collapse' id='userMenu'>";
			echo"		<li class='active'> <a href='/master/users/'><i class='glyphicon glyphicon-user'></i> Data Karyawan</a></li>";		
			echo"		<li><a href='/master/pelanggan/'><i class='glyphicon glyphicon-user'></i> Data Pelanggan</span></a></li>";
            echo"            <li><a href='/master/supplier/'><i class='glyphicon glyphicon-user'></i> Data Supplier</a></li>";
            echo"            <li><a href='/master/barang/'><i class='glyphicon glyphicon-gift'></i> Data Barang</a></li>";
            echo"            <li><a href='/master/jasa/'><i class='glyphicon glyphicon-heart'></i> Data Jasa Salon</a></li>";
            echo"        </ul>";
            echo"    </li>";
				
			echo"	<li class='nav-header'> <a href='#' data-toggle='collapse' data-target='#menu3'> Transaksi <i class='glyphicon glyphicon-chevron-right'></i></a>";

            echo"        <ul class='nav nav-stacked collapse' id='menu3'>";
            echo"            <li><a href='/master/orders/'><i class='glyphicon glyphicon-transfer'></i> Transaksi Penjualan</a>";
            echo"            </li>";

            echo"       	<li><a href='/master/pembelian/'><i class='glyphicon glyphicon-briefcase'></i> Transaksi Pembelian</a>";
            echo"  			</li>";
            echo"            <li><a href='/master/orders/order.php'><i class='glyphicon glyphicon-shopping-cart'></i> Data Penjualan</a>";
            echo"            </li>";

			echo"            <li><a href='/master/pembelian/pembelian.php'><i class='glyphicon glyphicon-shopping-cart'></i> Data Pembelian</a>";
            echo"            </li>";
            echo"       </ul>";
            echo"    </li>";
				
            echo"    <li class='nav-header'> <a href='#' data-toggle='collapse' data-target='#menu2'> Laporan <i class='glyphicon glyphicon-chevron-right'></i></a>";

            echo"        <ul class='nav nav-stacked collapse' id='menu2'>";
            echo"            <li><a href='/laporan/pembelian/'target='_blank'><i class='fa fa-book'></i> Laporan pembelian</a>";
            echo"            </li>";
            echo"            <li><a href='/laporan/penjualan/'target='_blank'><i class='fa fa-print'></i> Laporan penjualan</a>";
            echo"            </li>";
            echo"            <li><a href='/laporan/stock/'target='_blank'><i class='glyphicon glyphicon-stats'></i> Laporan Stock barang</a>";
            echo"            </li>";
            echo"        </ul>";
            echo"    </li>";
            echo"    <li class='nav-header'>";
            echo"        <a href='#' data-toggle='collapse' data-target='#menu4'> Lain-lain <i class='glyphicon glyphicon-chevron-right'></i></a>";
            echo"        <ul class='nav nav-stacked collapse' id='menu4'>";
            //echo"            <li><a href='/pages/setting.php'><i class='glyphicon glyphicon-cog'></i> Ganti Password</a></li>";
            echo"            <li><a href='/pages/session.php?act=logoff'><i class='glyphicon glyphicon-off'></i> Keluar</a></li>";
            echo"        </ul>";
            echo"    </li>";
           // echo"</ul>";
			}
//jika bukan admin			
		else{
//			echo"lol";	
			echo"   <li class='nav-header'> <a href='#' data-toggle='collapse' data-target='#userMenu'>Master <i class='glyphicon glyphicon-chevron-right'></i></a>";
            echo"     <ul class='nav nav-stacked collapse' id='userMenu'>";
	//		echo"		<li class='active'> <a href='/master/users/'><i class='glyphicon glyphicon-user'></i> Data Karyawan</a></li>";		
			echo"		<li><a href='/master/pelanggan/'><i class='glyphicon glyphicon-user'></i> Data Pelanggan</span></a></li>";
            echo"            <li><a href='/master/supplier/'><i class='glyphicon glyphicon-user'></i> Data Supplier</a></li>";
            echo"            <li><a href='/master/barang/'><i class='glyphicon glyphicon-gift'></i> Data Barang</a></li>";
            echo"            <li><a href='/master/jasa/'><i class='glyphicon glyphicon-heart'></i> Data Jasa Salon</a></li>";
            echo"        </ul>";
            echo"    </li>";
				
			echo"	<li class='nav-header'> <a href='#' data-toggle='collapse' data-target='#menu3'> Transaksi <i class='glyphicon glyphicon-chevron-right'></i></a>";

            echo"        <ul class='nav nav-stacked collapse' id='menu3'>";
            echo"            <li><a href='/master/orders/'><i class='glyphicon glyphicon-transfer'></i> Transaksi Penjualan</a>";
            echo"            </li>";
            echo"       <li><a href='/master/pembelian/'><i class='glyphicon glyphicon-briefcase'></i> Transaksi Pembelian</a>";
            echo"  </li>";
            echo"            </ul>";
            echo"    </li>";
				
            echo"    <li class='nav-header'> <a href='#' data-toggle='collapse' data-target='#menu2'> Laporan <i class='glyphicon glyphicon-chevron-right'></i></a>";

            echo"        <ul class='nav nav-stacked collapse' id='menu2'>";
            echo"            <li><a href='#'><i class='fa fa-print'></i> Laporan pembelian</a>";
            echo"            </li>";
            echo"            <li><a href='#'><i class='fa fa-print'></i> Laporan penjualan</a>";
            echo"            </li>";
                       
            echo"        </ul>";
            echo"    </li>";
			
            echo"    <li class='nav-header'>";
            echo"        <a href='#' data-toggle='collapse' data-target='#menu4'> Lain-lain <i class='glyphicon glyphicon-chevron-right'></i></a>";
            echo"        <ul class='nav nav-stacked collapse' id='menu4'>";
            //echo"            <li><a href='/pages/setting.php'><i class='glyphicon glyphicon-cog'></i> Ganti Password</a></li>";
            echo"            <li><a href='/pages/session.php?act=logoff'><i class='glyphicon glyphicon-off'></i> Keluar</a></li>";
            echo"        </ul>";
            echo"    </li>";
            //echo"</ul>";
			}
			?>
</ul>			
</div>
<script>
$('[data-toggle=collapse]').click(function(){
  	// toggle icon
  	$(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-minus');
});
</script>