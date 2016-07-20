<?php
//
// common functions
//
function yesno($data) {
	switch($data) {
		case "1":
			return("Ja");
			break;
		case "0":
			return("Nej");
			break;
		default:
			return("");
	}
}	
	
function codetype($codetype,$alertcode) {
	switch($codetype) {
		case "1":
			return("<span class=\"label label-info\">FÖRBRUKNING</span>");
			break;
		case "2";
			return("<span class=\"label label-success\">INFORMATION</span>");
			break;
		case "3";
			return("<span class=\"label label-warning\">VARNING</span>");
			break;
		case "4";
			return("<span class=\"label label-danger\">KRITISK</span>");
			break;
		default:
			return("<a href=\"\" onclick=\"getactaddalertcode('".$alertcode."');return false;\"><span class=\"label label-default\">OKÄND</span></a>");
	}
}

function fixdate($datestring) {
	if($datestring=="0000-00-00 00:00:00") {
		return("");
	} else {
		return($datestring);
	}
}

function ruleoutput($input,$serviceid,$alertcode) {
	switch($input) {
		case "1":
			return("Ja");
			break;
		case "0":
			return("<a href=\"#\" id=\"unlabeledlink\" onclick=\"getactaddrule('".$serviceid."','".$alertcode."');return false;\">Nej</a>");
			break;
	}
}

//
// activity functions
//
function activitylist() {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$actlist="";
			$codes=array();
			$rules=arraY();
			$csql=$mysqli->query("SELECT code,type FROM codes");
				while($cdata=$csql->fetch_array()) {
					$codes[$cdata["code"]]=$cdata["type"];
				}
			$rsql=$mysqli->query("SELECT serviceid,alertcode FROM rules");
				while($rdata=$rsql->fetch_array()) {
					$rules[$rdata["serviceid"]]=$rdata["alertcode"];
				}
			$sql=$mysqli->query("SELECT id,serviceid,model,alertcode,message,system,reportdate FROM activity ORDER BY id DESC LIMIT 500");
				while($data=$sql->fetch_array()) {
					$actlist.="<tr id=\"act-".$data["id"]."\">";
					$actlist.="<td>".$data["serviceid"]."</td>";
					$actlist.="<td>".$data["model"]."</td>";
					$actlist.="<td>".$data["alertcode"]."</td>";
					if(array_key_exists($data["alertcode"],$codes)) {
						$actlist.="<td>".codetype($codes[$data["alertcode"]],$data["alertcode"])."</td>";
					} else {
						$actlist.="<td>".codetype("",$data["alertcode"])."</td>";
					}
					$actlist.="<td>".$data["message"]."</td>";
					if(array_key_exists($data["serviceid"],$rules) && $rules[$data["serviceid"]]==$data["alertcode"]) {
						$actlist.="<td>".ruleoutput("1","","")."</td>";
					} else {
						$actlist.="<td>".ruleoutput("0",$data["serviceid"],$data["alertcode"])."</td>";
					}
					$actlist.="<td>".$data["system"]."</td>";
					$actlist.="<td>".$data["reportdate"]."</td>";
					$actlist.="</tr>";
				}
		mysqli_close($mysqli);
return($actlist);
}


//
// code functions
//
function addcode($code,$type,$msg) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$ac_code=$mysqli->real_escape_string($code);
			$ac_type=$mysqli->real_escape_string($type);
			$ac_msg=$mysqli->real_escape_string($msg);
			$mysqli->query("INSERT INTO codes (code,type,msgsupplie) VALUES ('".$ac_code."','".$ac_type."','".$ac_msg."')");
		mysqli_close($mysqli);
return("1");
}

function editcode($codeid,$type,$msg) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$ec_codeid=$mysqli->real_escape_string($codeid);
			$ec_type=$mysqli->real_escape_string($type);
			$ec_msg=$mysqli->real_escape_string($msg);
			$mysqli->query("UPDATE codes SET type='".$ec_type."',msgsupplie='".$ec_msg."' WHERE id='".$ec_codeid."'");
		mysqli_close($mysqli);
return("1");
}

function deletecode($codeid) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$dc_codeid=$mysqli->real_escape_string($codeid);
			$mysqli->query("DELETE FROM codes WHERE id='".$dc_codeid."'");
		mysqli_close($mysqli);
return("1");
}

function codelist() {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$codelist="";
			$sql=$mysqli->query("SELECT id,code,type,msgsupplie FROM codes ORDER BY code ASC");
				while($data=$sql->fetch_array()) {
					$codelist.="<tr id=\"code-".$data["id"]."\">";
					$codelist.="<td><a href=\"#\" id=\"unlabeledlink\" onclick=\"geteditalertcode('".$data["id"]."');return false;\">".$data["code"]."</a></td>";
					$codelist.="<td>".codetype($data["type"],"")."</td>";
					$codelist.="<td>".$data["msgsupplie"]."</td>";
					$codelist.="</tr>";											
				}
		mysqli_close($mysqli);
return($codelist);
}

//
// daemon functions
//
function consolewrite($input) {
	print("[".date("Y-m-d H:i:s")."] ".$input."\r\n");
		$filename=date("Ymd").".txt";
		$outfile=fopen($_SERVER["PWD"]."/log/".$filename,"a");
		fwrite($outfile,"[".date("Y-m-d H:i:s")."] ".$input."\r\n");
		fclose($outfile);
}

function internalerror($errno,$errstr) {
	consolewrite("Error: [".$errno."] ".$errstr);
}

function getstringbetween($string,$start,$end) {
	$string=" ".$string;
	$ini=strpos($string,$start);
	if($ini==0) return "";
	$ini+=strlen($start);
	$len=strpos($string,$end,$ini)-$ini;
return substr($string,$ini,$len);
}

function writelogfile($serviceid,$header,$data) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		sleep(1);
		if($serviceid<>"") {
			$filename=date("Ymd-Hms")."-serviceid_".$serviceid.".txt";
		} else {
			$filename=date("Ymd-Hms").".txt";
		}
		$outfile=fopen($_SERVER["PWD"]."/reportslog/".$filename,"w");
		fwrite($outfile,$header."\n".$data);
		fclose($outfile);
}

function savetodb($serviceid,$model,$alertcode,$message,$system) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$mysqli->query("INSERT INTO activity (serviceid,model,alertcode,message,system,reportdate,checked) VALUES ('".$serviceid."','".$model."','".$alertcode."','".$message."','".$system."','".date("Y-m-d H:i:s")."','0')");
		mysqli_close($mysqli);
}

function sendmail($toaddr,$subject,$message) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
	require_once("functions/class.phpmailer.php");
	require_once("functions/class.smtp.php");
		$mail=new PHPMailer;
			$mail->isSMTP();
			$mail->CharSet="utf-8";
			$mail->Host=$smtp_host;
			$mail->Port=$smtp_port;
			$mail->SMTPSecure=$smtp_encryption;
			$mail->SMTPAuth=$smtp_auth;
			$mail->Username=$smtp_username;
			$mail->Password=$smtp_password;
			$mail->isHTML(false);
			$mail->setFrom($smtp_fromaddr);
			$mail->addAddress($toaddr);
			$mail->Subject=$subject;
			$mail->Body=$message."\n\nMed vänliga hälsningar,\nPrintFlow";
				if(!$mail->send()) {
				    consolewrite("E-post meddelande ej skickat");
				    return(false);
				} else {
					consolewrite("E-post meddelande skickat");
					return(true);
				}
}

function checkreport($reset,$repdate) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		if($repdate=="0000-00-00 00:00:00") {
			return(true);
		} elseif(floor((strtotime(date("Y-m-d H:i:s"))-strtotime($repdate))/(60*60*24))>=$reset) {
			return(true);
		} else {
			return(false);
		}
}

//
// log functions
//
function addlog($serviceid,$alertcode,$msg) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$al_serviceid=$mysqli->real_escape_string($serviceid);
			$al_alertcode=$mysqli->real_escape_string($alertcode);
			$al_msg=$mysqli->real_escape_string($msg);
			$mysqli->query("INSERT INTO log (serviceid,alertcode,msgsupplie) VALUES ('".$al_serviceid."','".$al_alertcode."','".$al_msg."')");
		mysqli_close($mysqli);
return("1");
}

function loglist() {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$codelist="";
			$sql=$mysqli->query("SELECT serviceid,alertcode,msgsupplie,reportsent FROM log ORDER BY id ASC");
				while($data=$sql->fetch_array()) {
					$loglist.="<tr>";
					$loglist.="<td>".$data["serviceid"]."</td>";
					$loglist.="<td>".$data["alertcode"]."</td>";
					$loglist.="<td>".$data["msgsupplie"]."</td>";
					$loglist.="<td>".$data["reportsent"]."</td>";
					$loglist.="</tr>";											
				}
		mysqli_close($mysqli);
return($loglist);
}

//
// rule functions
//
function addrule($serviceid,$alertcode,$resetdays,$email,$msg) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$ar_serviceid=$mysqli->real_escape_string($serviceid);
			$ar_alertcode=$mysqli->real_escape_string($alertcode);
			$ar_resetdays=$mysqli->real_escape_string($resetdays);
			$ar_email=$mysqli->real_escape_string($email);
			$ar_msg=$mysqli->real_escape_string($msg);
			$mysqli->query("INSERT INTO rules (serviceid,alertcode,email,message,resetdays,reportsent) VALUES ('".$ar_serviceid."','".$ar_alertcode."','".$ar_email."','".$ar_msg."','".$ar_resetdays."','')");
		mysqli_close($mysqli);
return("1");
}

function editrule($ruleid,$resetdays,$email,$msg) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$er_ruleid=$mysqli->real_escape_string($ruleid);
			$er_resetdays=$mysqli->real_escape_string($resetdays);
			$er_email=$mysqli->real_escape_string($email);
			$er_msg=$mysqli->real_escape_string($msg);
			$mysqli->query("UPDATE rules SET resetdays='".$er_resetdays."',email='".$er_email."',message='".$er_msg."' WHERE id='".$er_ruleid."'");
		mysqli_close($mysqli);
return("1");
}

function deleterule($ruleid) {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$dr_ruleid=$mysqli->real_escape_string($ruleid);
			$mysqli->query("DELETE FROM rules WHERE id='".$dr_ruleid."'");
		mysqli_close($mysqli);
return("1");
}

function rulelist() {
	if(file_exists("config.php")) {
		require("config.php");
	} else {
		require("../config.php");
	}
		$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			$codelist="";
			$codes=array();
			$csql=$mysqli->query("SELECT code,type FROM codes");
				while($cdata=$csql->fetch_array()) {
					$codes[$cdata["code"]]=$cdata["type"];
				}
			$sql=$mysqli->query("SELECT id,serviceid,alertcode,reportsent FROM rules ORDER BY serviceid ASC");
				while($data=$sql->fetch_array()) {
					$codelist.="<tr id=\"code-".$data["id"]."\">";
					$codelist.="<td><a href=\"#\" id=\"unlabeledlink\" onclick=\"geteditrule('".$data["id"]."');return false;\">".$data["serviceid"]."</a></td>";
					$codelist.="<td>".$data["alertcode"]."</td>";
					$codelist.="<td>".codetype($codes[$data["alertcode"]],$data["alertcode"])."</td>";
					$codelist.="<td>".fixdate($data["reportsent"])."</td>";
					$codelist.="</tr>";											
				}
		mysqli_close($mysqli);
return($codelist);
}