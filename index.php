<!DOCTYPE html>
<?php
	require("config.php");
	require("functions/login.php");
	
	if(isset($_POST["blogin"]) && $_POST["blogin"]=="Logga in") {
		$login=login($_POST["password"]);
			if($login=="0") {
				header("Location:activity.php");
				exit;
			} elseif($login=="1") {
				$action="toastr.error('Felaktigt lösenord');";
			} else {
				$action="toastr.error('Ett fel uppstod');";
			}
	}
	if(isset($_GET["error"]) && $_GET["error"]=="1") {
		$action="toastr.error('Inte inloggad');";
	}
	if(isset($_GET["logout"]) && $_GET["logout"]=="1") {
		$action="toastr.success('Du är nu utloggad');";
	}
?>
<html lang="se">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>PrintFlow</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/adminlte.min.css">
		<link rel="stylesheet" href="css/toastr.min.css">
		<link rel="stylesheet" href="css/printflow.css">
		<!--[if lt IE 9]>
			<script src="js/html5shiv.min.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="hold-transition login-page" onload="<?php if(isset($action)) { print($action); } ?>">
		<div class="login-box">
			<div class="login-logo">
				<b>PRINT</b>FLOW
			</div>
			<div class="login-box-body">
				<form action="index.php" method="post">
					<div class="form-group has-feedback">
						<input type="password" name="password" id="password" class="form-control" placeholder="Lösenord" autofocus>
						<span class="fa fa-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
							&nbsp;
						</div>
						<div class="col-xs-4">
							<input type="submit" class="btn btn-primary btn-block btn-flat" name="blogin" value="Logga in">
						</div>
					</div>
				</form>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.slimscroll.min.js"></script>
		<script src="js/fastclick.min.js"></script>
		<script src="js/app.min.js"></script>
		<script src="js/toastr.min.js"></script>
	</body>
</html>