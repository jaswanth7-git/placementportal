<?php
session_start();
$but=filter_input(INPUT_POST, "dropmen");

if($but=="changepsw"){
	header("Location:changepassword.php");
	exit();
}
if($but=="getout"){
	session_destroy();
	header("location:../index.html");
	exit();

}

?>