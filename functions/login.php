<?php
function login($pass) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$loginpass=stripslashes($pass);
			if(!isset($loginpass)) { 
				$status="1";
			} elseif(empty($loginpass)) { 
				$status="1"; 
			} else {
				$hashpass=hash("sha512",md5(md5($loginpass)));
					if($hashpass==$password) {
						@session_start();
							session_regenerate_id(true);
							$_SESSION["sessid"]=session_id();
							$_SESSION["sesspass"]=$hashpass;
						$status="0";
					} else {
						$status="1";
					}
			}
return($status);
}

function logout() {
	@session_start();
		session_unset(); 
		session_destroy();
	header("Location:index.php?logout=1");
	exit;
}