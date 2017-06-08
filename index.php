<!DOCTYPE html>
<?php 
session_start(); 
ob_start();
?>
<html>
<head>
	<title>Impossible Quiz</title>
	
	<?php include 'php/database.php'; ?>
	<?php include 'php/page.php'; ?>
	<?php include 'php/permission.php'; ?>	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<!-- <link rel="stylesheet" href="css/bootstrap.css" type="text/css"> -->
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">	
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/modal.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	<script src="js/bootstrap.js"></script>
	<script src="js/game.js"></script>
	<script src="js/modal.js"></script>	
	<script>
	var myVar;

	myVar = setTimeout(showPage, 0000);

	function showPage() {
	  document.getElementById("loader").style.display = "none";
	  document.getElementById("page").style.display = "block";
	}
	</script>	
</head>

<body>
	<div style="left:0;right:0;margin:auto;" id="loader"></div>
	<div id="muvelet"></div>
	<div id="page">
	<?php
		$permission = new Permission;
		$page = new Page;
	?>
	</div>
</body>