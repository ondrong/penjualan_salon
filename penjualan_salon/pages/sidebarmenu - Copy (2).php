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
<ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">Master <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="userMenu">
						<?php
                        if($users->UserType()=="ADMIN")
			{
						echo"<li class='active'> <a href='/master/users/'><i class='glyphicon glyphicon-user'></i> Data Karyawan</a></li>";
			}
			else{
			}
			 ?>
						<li><a href="/master/pelanggan/"><i class="glyphicon glyphicon-user"></i> Data Pelanggan</span></a></li>
                        <li><a href="/master/supplier/"><i class="glyphicon glyphicon-user"></i> Data Supplier</a></li>
                        <li><a href="/master/barang/"><i class="glyphicon glyphicon-gift"></i> Data Barang</a></li>
                        <li><a href="/master/jasa/"><i class="glyphicon glyphicon-heart"></i> Data Jasa Salon</a></li>
                    </ul>
                </li>
				
				<li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu3"> Transaksi <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu3">
                        <li><a href="/master/orders/"><i class="glyphicon glyphicon-transfer"></i> Transaksi Penjualan</a>
                        </li>
                        <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Transaksi Pembelian</a>
                        </li>
                        </ul>
                </li>
				
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"> Laporan <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu2">
                        <li><a href="#"><i class="glyphicon glyphicon-file"></i> Laporan pembelian</a>
                        </li>
                        <li><a href="#"><i class="glyphicon glyphicon-book"></i> Laporan penjualan</a>
                        </li>
                       
                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu4"> Lain-lain <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu4">
                        <li><a href="/pages/setting.php"><i class="glyphicon glyphicon-cog"></i> Ganti Password</a></li>
                        <li><a href="/pages/session.php?act=logoff"><i class="glyphicon glyphicon-off"></i> Keluar</a></li>
                    </ul>
                </li>
            </ul>
</div>
<script>
$('[data-toggle=collapse]').click(function(){
  	// toggle icon
  	$(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-minus");
});
</script>