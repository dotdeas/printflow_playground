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
		<link rel="stylesheet" href="css/toastr.min.css">
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
						<li class="active">
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
					<h1>Aktivitet</h1>
				</section>
				<section class="content">
					<div class="box">
						<div class="box-body">
							<table name="activity" id="activity" class="table table-bordered table-striped table-hover">
								<thead name="acthead" id="acthead">
									<tr>
										<th>Avtal</th>
										<th>Modell</th>
										<th>Kod</th>
										<th>Typ</th>
										<th>Meddelande</th>
										<th>Regel</th>
										<th>System</th>
										<th>Tidpunkt</th>
									</tr>
								</thead>
								<tbody name="actbody" id="actbody">
				                    <?php
										echo activitylist();
									?>
			                    </tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
			<?php
				require("includes/modal-newcode.php");
				require("includes/modal-newrule.php");
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
		<script src="js/modal.js"></script>
		<script src="js/printflow.js"></script>
		<script src="js/ajaxcalls.js"></script>
		<script src="js/toastr.min.js"></script>
		<script>
			$(function () {
				$('#activity').DataTable({
					"paging": true,
					"lengthChange": true,
					"searching": true,
					"ordering": true,
					"order": [ 7, 'desc' ],
					"info": false,
					"autoWidth": true,
					"pageLength": 100,
					"lengthMenu": [ [25, 50, 100, 250, 500, -1], [25, 50, 100, 250, 500, "Alla"] ],
					"language": {
					    "search": "Sök",
					    "lengthMenu": "Visa _MENU_ poster",
					    "infoEmpty": "Ingen aktivitet att visa",
					    "zeroRecords": "Inga matchande poster",
							"paginate": {
								"first": "Första",
								"last": "Sista",
								"next": "Nästa",
								"previous": "Föregående",
      						}
					    
					  }
				});
			});
		</script>
	</body>
</html>