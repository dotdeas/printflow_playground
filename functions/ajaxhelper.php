<?php
// Function list
// 1 = check code
// 2 = add code
// 3 = codelist
// 4 = get code data
// 5 = edit code
// 6 = delete code
// 7 = activitylist
// 8 = check rule
// 9 = add rule
// 10 = rulelist
// 11 = get rule data
// 12 = edit rule
// 13 = delete rule

if(file_exists("config.php")) {
	require("config.php");
} else {
	require("../config.php");
}
require("printflow.php");

@session_start();
if($_SESSION["sessid"]<>session_id() || $_SESSION["sesspass"]<>$password) {
	exit;
}

if(isset($_POST["function"]) && $_POST["function"]=="1" && $_POST["code"]<>"") {
	$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
		$sql=$mysqli->query("SELECT code FROM codes WHERE code='".$mysqli->real_escape_string(trim($_POST["code"]))."' LIMIT 1");
		$rowcheck=$sql->num_rows;
	mysqli_close($mysqli);
echo $rowcheck;
}

if(isset($_POST["function"]) && $_POST["function"]=="2" && $_POST["code"]<>"" && $_POST["type"]<>"") {
	$data=addcode($_POST["code"],$_POST["type"],$_POST["msg"]);
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="3") {
	$data=codelist();
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="4" && $_POST["codeid"]<>"") {
	$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
		$sql=$mysqli->query("SELECT code,type,msgsupplie FROM codes WHERE id='".$mysqli->real_escape_string(trim($_POST["codeid"]))."' LIMIT 1");
		$sqldata=$sql->fetch_array();
		$data=$sqldata["code"].";".$sqldata["type"].";".$sqldata["msgsupplie"];
	mysqli_close($mysqli);
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="5" && $_POST["codeid"]<>"" && $_POST["type"]<>"") {
	$data=editcode($_POST["codeid"],$_POST["type"],$_POST["msg"]);
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="6" && $_POST["codeid"]<>"") {
	$data=deletecode($_POST["codeid"]);
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="7") {
	$data=activitylist();
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="8" && $_POST["serviceid"]<>"" && $_POST["alertcode"]<>"") {
	$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
		$sql=$mysqli->query("SELECT id FROM rules WHERE serviceid='".$mysqli->real_escape_string(trim($_POST["serviceid"]))."' AND alertcode='".$mysqli->real_escape_string(trim($_POST["alertcode"]))."' LIMIT 1");
		$rowcheck=$sql->num_rows;
	mysqli_close($mysqli);
echo $rowcheck;
}

if(isset($_POST["function"]) && $_POST["function"]=="9" && $_POST["serviceid"]<>"" && $_POST["alertcode"]<>"") {
	$data=addrule($_POST["serviceid"],$_POST["alertcode"],$_POST["resetdays"],$_POST["email"],$_POST["msg"]);
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="10") {
	$data=rulelist();
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="11" && $_POST["ruleid"]<>"") {
	$mysqli=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
		$sql=$mysqli->query("SELECT serviceid,alertcode,email,message,resetdays FROM rules WHERE id='".$mysqli->real_escape_string(trim($_POST["ruleid"]))."' LIMIT 1");
		$sqldata=$sql->fetch_array();
		$data=$sqldata["serviceid"].";".$sqldata["alertcode"].";".$sqldata["resetdays"].";".$sqldata["email"].";".$sqldata["message"];
	mysqli_close($mysqli);
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="12" && $_POST["ruleid"]<>"" && $_POST["email"]<>"") {
	$data=editrule($_POST["ruleid"],$_POST["resetdays"],$_POST["email"],$_POST["msg"]);
echo $data;
}

if(isset($_POST["function"]) && $_POST["function"]=="13" && $_POST["ruleid"]<>"") {
	$data=deleterule($_POST["ruleid"]);
echo $data;
}