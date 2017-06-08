<?php 
session_start(); 
ob_start();
include '../php/database.php'; 


$database = new database();

$database->select("startedgame", "*", "userid = '".$_SESSION['userid']."'", "");

$hnum = $_GET['hnum'];

$database->update("startedgame", "help".$hnum." = '0'", "userid = '".$_SESSION['userid']."'", $etc = "");

if ($database->getConn()->query($database->getSql()) === TRUE) {
} 
else {
	echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
}
