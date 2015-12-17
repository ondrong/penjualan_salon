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
    <div id="top-nav" class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Cendekia Rumah Kecantikan</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i>  <?php echo $username; ?> <span class="caret"></span></a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <!--li><a href="/pages/setting.php"><i class="glyphicon glyphicon-cog"></i> Ganti Password</a></li-->
						<li><a href="/pages/session.php?act=logoff"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>