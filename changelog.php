<!DOCTYPE html>
<?php
	require("functions/logincheck.php");
	require("config.php");
	require("functions/printflow.php");
	require("includes/version.php");
?>
<html lang="se">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>PrintFlow</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/dataTables.bootstrap.css">
		<link rel="stylesheet" href="css/adminlte.min.css">
		<link rel="stylesheet" href="css/skin-blue.min.css">
		<link rel="stylesheet" href="css/printflow.css">
		<!--[if lt IE 9]>
			<script src="js/html5shiv.min.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a class="logo">
					<span class="logo-mini"><b>P</b>F</span>
					<span class="logo-lg"><b>PRINT</b>FLOW</span>
				</a>
				<nav class="navbar navbar-static-top" role="navigation">
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
				</nav>
			</header>
			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu">
						<li>
							<a href="activity.php">
								<i class="fa fa-tasks"></i> <span>Aktivitet</span>
							</a>
						</li>
						<li>
							<a href="codes.php">
								<i class="fa fa-bell-o"></i> <span>Varningskoder</span>
							</a>
						</li>
						<li>
							<a href="rules.php">
								<i class="fa fa-arrows-alt"></i> <span>Regler</span>
							</a>
						</li>
						<li>
							<a href="log.php">
								<i class="fa fa-file-text-o"></i> <span>Rapportlogg</span>
							</a>
						</li>
						<li>
							<a href="?dologout=1">
								<i class="fa fa-sign-out"></i> <span>Logga ut</span>
							</a>
						</li>
					</ul>
				</section>
			</aside>
			<div class="content-wrapper">
				<section class="content-header">
					<h1>Ändringslog</h1>
				</section>
				<section class="content">
					<div class="box">
						<div class="box-body">
							<h3 style="margin-top: 0px;">1.0.0</h3>
							<span class="label label-success">FUNKTION</span><br>
							<span class="label label-info">FIX</span><br>
							<span class="label label-warning">ÄNDRING</span>
						</div>
					</div>
				</section>
			</div>
			<?php
				require("includes/footer.php");
			?>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/jquery.slimscroll.min.js"></script>
		<script src="js/fastclick.min.js"></script>
		<script src="js/app.min.js"></script>
	</body>
</html>