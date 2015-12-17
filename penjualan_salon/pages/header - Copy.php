<!DOCTYPE html>
<html lang="en">
<head> 
<?php
	include_once 'meta.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
	$database = new database();
	$db = $database->getConnection();

	include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/users.php';
	$users  = new users($db);
	$statement = $users->showone();
	$username=($_SESSION['current_user']);

?>    
</head>
<body> 

    <!-- container -->
    <div class="container-fluid">
      <div class="row">
	  <?php
	  		$users->username=$_SESSION['current_user'];
			$statement = $users->UserType();
			
			if($users->UserType()=="ADMIN")
			{
					echo"<nav class='navbar navbar-inverse' role='navigation'>";
			}
			else
			{
				echo"<nav class='navbar navbar-default' role='navigation'>";
			}
		?>
		  <div class="container-fluid">
			<div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuUtama">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="/admin/home.php" data-toggle="tooltip" title="Cendikia Beauty & Spa!">Cendikia Beauty & Spa</a>
		    </div>
			 <div class="collapse navbar-collapse" id="menuUtama">
			      <!--ul class="nav navbar-nav">
			        <li class="active"><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>
			      </ul-->
			      <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo $username; ?><span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="setting.php"><i class="glyphicon glyphicon-cog"></i> Ganti Pasword</a></li>
			            <li class="divider"></li>
			            <li><a href="/pages/session.php?act=logoff"><i class="glyphicon glyphicon-off"></i> Keluar</a></li>
			          </ul>
			        </li>
			       </ul>			      
			</div>  		    
		  </div>
		</nav>      
      </div>