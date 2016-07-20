<?php
@session_start();
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
	require("functions/login.php");
		if($_SESSION["sessid"]<>session_id() || $_SESSION["sesspass"]<>$password) {
			session_unset ();
			session_destroy ();
			header("Location:index.php?error=1");
			exit;
		}
		
		if(isset($_SESSION["sesstimeout"])) {
			$sesslife=time()-$_SESSION["sesstimeout"];
				if($sesslife>3600) {
					session_unset ();
					session_destroy ();
					header("Location:index.php");
					exit;
				}
		}
		$_SESSION["sesstimeout"]=time();
		
		if(isset($_GET["dologout"]) && stripslashes($_GET["dologout"])=="1") {
			logout();
		}