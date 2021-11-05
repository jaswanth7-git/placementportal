<?php
session_start();
$user=$_SESSION['username'];
$new_psw=sanitisePassword(filter_input(INPUT_POST, "oldpassword"));
$dbhost="localhost";
$dbusername="root";
$dbpassword="";
$dbname="srm-project";


$dsn = 'mysql:host='. $dbhost .';dbname='. $dbname;

  // Create a PDO instance
  $pdo = new PDO($dsn, $dbusername, $dbpassword);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

function sanitisePassword($string){

$string=md5($string);
return $string;
}

$query=$pdo->prepare("update login_details set password=:new_psw where username='$user' limit 1");

	$query->bindParam("new_psw",$new_psw);
	$query->execute();
	
	header("Location:home");


?>
