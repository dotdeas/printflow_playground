<?php
//
// config
//
require("config.php");
require("functions/printflow.php");
require("includes/version.php");
mb_internal_encoding("utf-8");
set_error_handler("internalerror");
set_time_limit(0);
error_reporting(0);

//
// daemon
//
if($build<>"") {
	consolewrite("Printflow Daemon v".$version."-".$build);
} else {
	consolewrite("Printflow Daemon v".$version);
}
consolewrite("Utvecklat av Andreas Persson");
consolewrite("Copyright (c) 2016 .DEAS Solutions");

$imap=imap_open($imap_string,$imap_user,$imap_pass) or die(consolewrite(imap_last_error()));

if($imap) {
	consolewrite("Ansluten till e-post server");
		$num=imap_num_msg($imap);
			for($x=1;$x<=$num;$x++) {
				consolewrite("Kontrollerar e-post id ".$x);
				$rawheader=imap_headerinfo($imap,$x);
				$dataheader=iconv_mime_decode($rawheader->subject);
					if(preg_match("#^Supply alert:#i",$dataheader)===1) {
						$data=imap_base64(imap_body($imap,$x));
							$serviceid=trim(getstringbetween($data,"Service ID:","<br"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"Model:","<br"));
									$suptype=trim(getstringbetween($data,"Supply type:","<br"));
									$message=trim(getstringbetween($data,"Supply description:","<br"));
									$alertcode=trim(getstringbetween($data,"Supply color:","<br"));
									$currlevel=trim(getstringbetween($data,"Current level:","<br"));
										if($suptype=="Toner") {
											$suprefix="tn";
										} elseif($suptype=="OrganicPhotoConductor") {
											$suprefix="dr";
										} else {
											$suprefix="";
										}
										if($currlevel<>"") {
											if($currlevel=="0%") {
												$alertcode="end".$suprefix.$alertcode;
											} else {
												$alertcode="ne".$suprefix.$alertcode;
											}
											savetodb($serviceid,$model,$alertcode,$message." (Nivå: ".$currlevel.")","3Manager");
										} else {
											savetodb($serviceid,$model,$alertcode,$message,"3Manager");
										}
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} elseif(preg_match("#^Alert:#i",$dataheader)===1) {
						$data=imap_base64(imap_body($imap,$x));
							$serviceid=trim(getstringbetween($data,"Service ID:","<br"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"Model:","<br"));
									$message=trim(getstringbetween($data,"Alert description:","<br"));
									$alertcode=trim(getstringbetween($message,"{","}"));
										if($alertcode=="") {
											if($message=="Sleep") {
												$alertcode="sleep";
											} elseif($message=="Low Power") {
												$alertcode="lowpower";
											} elseif($message=="Paper Jam") {
												$alertcode="paperjam";
											} elseif($message=="Calibrating") {
												$alertcode="calibrating";
											} elseif($message=="Warming up") {
												$alertcode="warmingup";
											}

										}
									savetodb($serviceid,$model,$alertcode,$message,"3Manager");
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} elseif(preg_match("#^@Remote Supply Call#i",$dataheader)===1) {
						$data=imap_body($imap,$x);
							$serviceid=trim(getstringbetween($data,"1.Customer Name / ID:","\r\n"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"6.Model name:","\r\n"));
									$message=trim(getstringbetween($data,"8.","\r\n"));
										if($message=="End Supply Type: Supply Call: Toner (K)") {
											$alertcode="endtnblack";
										} elseif($message=="End Supply Type: Supply Call: Toner (C)") {
											$alertcode="endtncyan";
										} elseif($message=="End Supply Type: Supply Call: Toner (M)") {
											$alertcode="endtnmagenta";
										} elseif($message=="End Supply Type: Supply Call: Toner (Y)") {
											$alertcode="endtnyellow";
										} elseif($message=="End Supply Type: Supply Call: Staple (x1000)") {
											$alertcode="endstaple";
										} elseif($message=="End Supply Type: Supply Call: Booklet staple (x1000)") {
											$alertcode="endsdstaple";
										} elseif($message=="End Supply Type: Supply Call: Waste Toner Bottle") {
											$alertcode="endwaste";
										} else {
											$alertcode="unknown";
										}
									savetodb($serviceid,$model,$alertcode,$message,"@Remote");
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} elseif(preg_match('#^Alarm Call Received#i',$dataheader)===1) {
						$data=imap_body($imap,$x);
							$serviceid=trim(getstringbetween($data,"1.Customer Name / ID:","\r\n"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"5.Model name:","\r\n"));
										if(trim(getstringbetween($data,"7.Alarm Call Detail:","\r\n"))=="Error Alarm Call") {
											$repdate=trim(getstringbetween($data,"8.Receive date and time:"," "));
											$message=trim(getstringbetween($data,"11.Latest 10 SC History:\r\n01.",","));
											$alertcode=strtolower(trim(getstringbetween($data,"11.Latest 10 SC History:\r\n01.",":")));
										} elseif(trim(getstringbetween($data,"7.Alarm Call Detail:","\r\n"))=="Jam Alarm Call") {
											$premessage=trim(getstringbetween($data,"12.Latest 10 Jam History:\r\nPaperCount\r\n01.","\r\n"));
											$message=substr($premessage,0,-20);
											$alertcode="paperjam";
										} elseif(trim(getstringbetween($data,"7.Alarm Call Detail:","\r\n"))=="Alarm Call: Part PM Alarm") {
											$message="PM Counter: ".trim(getstringbetween($data,"13.PM Counter\r\n01.","\r\n"));
											$alertcode="partpm";
										}
									savetodb($serviceid,$model,$alertcode,$message,"@Remote");
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} elseif(preg_match('#^@Remote CC1111 Received#i',$dataheader)===1) {
						$data=imap_body($imap,$x);
							$serviceid=trim(getstringbetween($data,"1.Customer Name / ID:","\r\n"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"5.Model name:","\r\n"));
									$premessage=trim(getstringbetween($data,"PaperCount\r\n01.","\r\n"));
									$message="Continuous Jam: ".substr($premessage,0,-20);
									$alertcode="cc1111";
									savetodb($serviceid,$model,$alertcode,$message,"@Remote");
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} elseif(preg_match('#^@Remote Authkey Change#i',$dataheader)===1) {
						$data=imap_body($imap,$x);
							$serviceid=trim(getstringbetween($data,"1.Customer Name / ID:","\r\n"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"5.Model name:","\r\n"));
									$message="Authkey Change";
									$alertcode="authkeychange";
									savetodb($serviceid,$model,$alertcode,$message,"@Remote");
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} elseif(preg_match('#^@Remote Disconnected#i',$dataheader)===1) {
						$data=imap_body($imap,$x);
							$serviceid=trim(getstringbetween($data,"1.Customer Name / ID:","\r\n"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"5.Model name:","\r\n"));
									$message="Device Disconnected";
									$alertcode="disconnected";
									savetodb($serviceid,$model,$alertcode,$message,"@Remote");
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} elseif(preg_match('#^@Remote Reconnected#i',$dataheader)===1) {
						$data=imap_body($imap,$x);
							$serviceid=trim(getstringbetween($data,"1.Customer Name / ID:","\r\n"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"5.Model name:","\r\n"));
									$message="Device Reconnected";
									$alertcode="reconnected";
									savetodb($serviceid,$model,$alertcode,$message,"@Remote");
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} elseif(preg_match('#^@Remote Firmware Failure#i',$dataheader)===1) {
						$data=imap_body($imap,$x);
							$serviceid=trim(getstringbetween($data,"1.Customer Name / ID:","\r\n"));
								if($serviceid<>"") {
									$model=trim(getstringbetween($data,"5.Model name:","\r\n"));
									$message="Firmware Failure";
									$alertcode="fwfailure";
									savetodb($serviceid,$model,$alertcode,$message,"@Remote");
								}
						writelogfile($serviceid,$dataheader,$data);
						imap_delete($imap,$x);
					} else {
						imap_delete($imap,$x);
					}
			}
	consolewrite("Tömmer papperskorg på e-post server");
		imap_expunge($imap);
	consolewrite("Kopplar från e-post server");
		imap_close($imap);
} else {
	consolewrite("Kunde inte ansluta till e-post server");
}

consolewrite("Kontrollerar regler");
	$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
		$codes=array();
		$rules=array();
			$csql=$mysqli->query("SELECT code,msgsupplie FROM codes");
				while($cdata=$csql->fetch_array()) {
					$codes[$cdata["code"]]=$cdata["msgsupplie"];
				}
			$rsql=$mysqli->query("SELECT serviceid,alertcode FROM rules");
				while($rdata=$rsql->fetch_array()) {
					$rules[$rdata["serviceid"]."-".$rdata["alertcode"]]="";
				}
			$asql=$mysqli->query("SELECT id,serviceid,model,alertcode FROM activity WHERE checked='0'");
				while($adata=$asql->fetch_array()) {
					if(array_key_exists($adata["serviceid"]."-".$adata["alertcode"],$rules)) {
						$rdsql=$mysqli->query("SELECT id,email,message,resetdays,reportsent FROM rules WHERE serviceid='".$adata["serviceid"]."' AND alertcode='".$adata["alertcode"]."'");
						$rddata=$rdsql->fetch_array();
							if(checkreport($rddata["resetdays"],$rddata["reportsent"])) {
								consolewrite("Matchande regel, avtal: ".$adata["serviceid"]." / varningskod: ".$adata["alertcode"]);
									if($rddata["message"]<>"") {
										$rmsg="\n\n".$rddata["message"];
									} else {
										$rmsg="";
									}
									$msg="Avtal: ".$adata["serviceid"]."\nModell: ".$adata["model"]."\nFörbrukning: ".$codes[$adata["alertcode"]].$rmsg;
								if(sendmail($rddata["email"],"Beställning",$msg)) {
									$mysqli->query("UPDATE activity SET checked='1' WHERE id='".$adata["id"]."'");
									$mysqli->query("UPDATE rules SET reportsent='".date("Y-m-d H:i:s")."' WHERE id='".$rddata["id"]."'");
									addlog($adata["serviceid"],$adata["alertcode"],$codes[$adata["alertcode"]]);
								}
							} else {
								$mysqli->query("UPDATE activity SET checked='1' WHERE id='".$adata["id"]."'");
							}
						$rdsql=NULL;
						$rddata=NULL;
					} else {
						$mysqli->query("UPDATE activity SET checked='1' WHERE id='".$adata["id"]."'");
					}
				}
	mysqli_close($mysqli);