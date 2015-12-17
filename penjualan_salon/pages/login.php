<?php 
	session_start();
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php'; 
	$database = new database();
	$db = $database->getConnection();
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/users.php';
	$users  = new users($db);

	if($_POST) {
		$users->username = $_POST['username'];
		$users->password = $_POST['password'];
		
		if($users->LogIn())
		{
			$_SESSION['current_user'] = $_POST['username'];
			$_SESSION['login_setup'] = false;
			header('location:/');
		}
		else {
			header('location:/pages/failed.php');
		}
	}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Selamat Datang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href=<?php $_SERVER['DOCUMENT_ROOT'] ?> "/css/bootstrap.css" rel="stylesheet">
  <link href=<?php $_SERVER['DOCUMENT_ROOT'] ?> "/css/style.css" rel="stylesheet">
  <link href=<?php $_SERVER['DOCUMENT_ROOT'] ?> "/css/mystyle.css" rel="stylesheet">
  <script src=<?php $_SERVER['DOCUMENT_ROOT'] ?> "/js/jquery.js"></script>
  <script src=<?php $_SERVER['DOCUMENT_ROOT'] ?> "/js/bootstrap.js"></script>	
</head>
<body>
<!--div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4">
			<div class="account-wall" >
			<h1 class="text-center login-title">LOGIN</h1>
				<form class="form-login" action="" method="POST">
					<img src="/images/login.png" id="profile-img"/>
					<input type="username" class="form-control" id="username" name="username" placeholder="Username" required autofocus />
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
					<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
				</form>
			</div>
		</div>
	</div>
</div-->

  <body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Silahkan Login di Sini</h1>
        <!--
-->
                <div class="account-wall">
                    <img class="profile-img" src="/images/photo.png" alt="">
                    <form class="form-signin" action="" method="POST">
                        <input type="text" id="username" class="form-control" placeholder="Username / Kode Pegawai" required autofocus name="username">
                        <input type="password" id="password" class="form-control" placeholder="Password" required name="password">
                        <button class="btn btn-lg btn-primary btn-block" id="login" type="submit">
                            Masuk </button>
                        <!--label class="checkbox pull-left" style="color: #fff;">
                            <input type="checkbox" value="remember-me">
                            Ingat Saya
                        </label-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>