<?php 
session_start(); 
ob_start();
include '../php/database.php'; 
?><script src="js/game.js"></script><?php

$database1 = new database();
$database2 = new database();

$database1->select("startedgame", "*", "userid = '".$_SESSION['userid']."'", "");

$qnow = $database1->getRow()['qnow'];
$pnow = $database1->getRow()['points'];
$gametype = $database1->getRow()['difficult'];
$q = $_GET['q'];
$point = $_GET['point']+1000;
$muv = "";

$database2->select("records", "points", "userid = '".$_SESSION['userid']."' AND gametype = '".$gametype."'", "");
$record = $database2->getRow()['points'];

$database2->select("questions", "*", "id = '".$database1->getRow()['q'.$database1->getRow()['qnow'].'id']."'", "");

if($q == $database2->getRow()['correct']){
	$muv = "correct";
	
	if($qnow == "15"){
		$database2->select("users", "record, points", "id = '".$_SESSION['userid']."'", "");
		$pnow = ($pnow+$point)*(($database1->getRow()['help1']+$database1->getRow()['help2']+$database1->getRow()['help3']+$database1->getRow()['help4'])/10+1);
		$muv = "win";
		
		$database2->update("users", "points = '".($database2->getRow()['points']+round($pnow/100))."'", "id = '".$_SESSION['userid']."'", $etc = "");		
		if ($database2->getConn()->query($database2->getSql()) === TRUE) {
		} 
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";		
		}
		
		if($pnow >= $record){			
			$database2->update("records", "points = '".$pnow."'", "userid = '".$_SESSION['userid']."' AND gametype = '".$gametype."'", $etc = "");

			if ($database2->getConn()->query($database2->getSql()) === TRUE) {
			} 
			else {
				echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
			}			
		}
		
		$database2->del("startedgame", "userid = '".$_SESSION['userid']."'", $etc = "");		
		if ($database2->getConn()->query($database2->getSql()) === TRUE) { 
		} 
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
		}
	}
	else{
		$database2->update("startedgame", "qnow = '".($qnow+1)."', points = '".($pnow+$point)."', round = 0", "userid = '".$_SESSION['userid']."'", $etc = "");
		
		if ($database2->getConn()->query($database2->getSql()) === TRUE) {	
		} 
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
		}
	}

	$qnow = $database1->getRow()['qnow'];
}
else if($q == "0"){
	$muv = "next";
}
else{	
	$database2->select("users", "points", "id = '".$_SESSION['userid']."'", "");
	
	$database2->update("users", "points = '".($database2->getRow()['points']+round($pnow/100))."'", "id = '".$_SESSION['userid']."'", $etc = "");
	
	if ($database2->getConn()->query($database2->getSql()) === TRUE) {
	} 
	else {
		echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
	}
	
	if($pnow >= $record){
		$database2->update("records", "points = '".($pnow)."'", "userid = '".$_SESSION['userid']."' AND gametype = '".$gametype."'", $etc = "");		
		if ($database2->getConn()->query($database2->getSql()) === TRUE) {
		} 
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
		}		
	}
	
	$database2->del("startedgame", "userid = '".$_SESSION['userid']."'", $etc = "");
	
	if ($database2->getConn()->query($database2->getSql()) === TRUE) {
	} 
	else {
		echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
	}
}	

?>
<div class="row top-buffer">
</div>
<div class="container">
	<div class="row top-buffer">
	</div>
	<div class="row">
		<?php
		if($muv == "correct"){
		?>	
		<div class="col-xs-1">
		</div>
		<div align="center" style="border: 1px solid #BEBEBE;" class="jumbotron col-xs-10">
			<?php echo "Pontok: ".($pnow+$point); ?></p> 
			<h1>Talált !</h1> 
		</div>
		<?php
		}
		else if($muv == "next"){
		?>
		<div class="col-xs-1">
		</div>
		<div align="center" style="border: 1px solid #BEBEBE;" class="jumbotron col-xs-10">
			<h1 class="hidden-xs">Felkészültél?</h1>
			<h3 class="hidden-sm hidden-md hidden-lg">Felkészültél?</h3>
			<?php echo "Pontok: ".($pnow); ?></p> 
		</div>
		<div class="col-xs-1">
		</div>
		<?php
		}
		else if($muv == "win"){
		?>
		<div class="col-xs-1">
		</div>
		<div align="center" class="jumbotron col-xs-10">
			<h1>Győzelem</h1> 
		</div>
		<?php
		}
		else if($q == "5"){
		?>
		<div class="col-xs-1">
		</div>
		<div align="center" style="border: 1px solid #BEBEBE;" class="jumbotron col-xs-10">
			<h1>Kiléptél !</h1> 
		</div>
		<?php
		}
		else{
		?>
		<div class="col-xs-1">
		</div>
		<div align="center" style="border: 1px solid #BEBEBE;" class="jumbotron col-xs-10">
			<h1>Elrontottad !</h1> 
		</div>
		<?php
		}
		?>
		<div class="col-xs-1">
		</div>
	</div>		
	<div class="row top-buffer">
	</div>
	<div class="row top-buffer hidden-xs">
	</div>
	<div class="row">
		<div class="col-xs-3">
		</div>
		<?php
		if($muv == "correct"){
		?>
		<div class="col-xs-6">
			<label style='padding:5px 0px;text-align:center;' class="element-animation1 btn btn-lg btn3d btn-default btn-lg btn-block">	
				<input type="radio" style='position:absolute;clip:rect(0,0,0,0);' onchange="diff(0)">
				<h1 class="hidden-xs">Következő</h1>
				<h4 class="hidden-sm hidden-md hidden-lg">Következő</h4>
			</label>
		</div>
		<?php
		}
		else if($muv == "next"){
		?>
		<div class="col-xs-6">
			<label style='padding:5px 0px;text-align:center;' class="element-animation1 btn btn-lg btn3d btn btn-default btn-lg btn-block">	
				<input type="radio" style='position:absolute;clip:rect(0,0,0,0);' onchange="diff(0)">
				<h1 class="hidden-xs">Következő</h1>
				<h4 class="hidden-sm hidden-md hidden-lg">Következő</h4>
			</label>
		</div>
		<?php
		}
		else{
		?>
		<div class="col-xs-6">
			<a class="element-animation1 btn-lg btn3d btn btn-default btn-lg btn-block" href="index.php?page=gameopt">
				<h1 class="hidden-xs">Új játék</h1>
				<h4 class="hidden-sm hidden-md hidden-lg">Új játék</h4>
			</a>
		</div>
		<?php
		}
		?>
		<div class="col-xs-3">
		</div>
	</div>
	<div class="row top-buffer">
	</div>
	<div class="row top-buffer hidden-xs">
	</div>
	<div class="row">
		<label id="help1" style="padding:5px 0px;" class="col-xs-2 element-animation1 btn btn-lg btn3d btn-default btn-lg <?php if($database1->getRow()["help1"] != 1){ echo "disabledbutton";}?>">				
			<input type="radio" style="position:absolute;clip:rect(0,0,0,0);"><h6>100%</h6>
		</label>
		<div class="col-xs-1" style="padding:0px 0px;">
		</div>			
		<label id="help2" style="padding:5px 0px;" class="col-xs-2 element-animation2 btn btn-lg btn3d btn-default btn-lg <?php if($database1->getRow()["help2"] != 1){ echo "disabledbutton";}?>">				
			<input type="radio" style="position:absolute;clip:rect(0,0,0,0);"><h6>50%</h6>
		</label>			
		<div class="col-xs-2" style="padding:0px 0px;">
		</div>
		<label id="help3" style="padding:5px 0px;" class="col-xs-2 element-animation3 btn btn-lg btn3d btn-default btn-lg <?php if($database1->getRow()["help3"] != 1){ echo "disabledbutton";}?>">				
			<input type="radio" style="position:absolute;clip:rect(0,0,0,0);"><h6>25%</h6>
		</label>
		<div class="col-xs-1" style="padding:0px 0px;">
		</div>
		<label id="help4" style="padding:5px 0px;" class="col-xs-2 element-animation4 btn btn-lg btn3d btn-default btn-lg <?php if($database1->getRow()["help4"] != 1){ echo "disabledbutton";}?>">				
			<input type="radio" style="position:absolute;clip:rect(0,0,0,0);"><h6>+10mp</h6>
		</label>
	</div>
	<div class="row top-buffer">
	</div>
	<div class="row top-buffer hidden-xs">
	</div>
	<div class="row">

		<div style="padding:0px;height:30px;" class="hidden-xs progress">
			<div class="progress-bar progress-bar-striped active" role="progressbar" style="width:<?php echo 100/15*$qnow;?>%"><h5><?php echo $qnow."/15";?></h5>
			</div>			
		</div>
		<div style="padding:0px;height:20px;" class="hidden-sm hidden-md hidden-lg progress">
			<div class="progress-bar progress-bar-striped active" role="progressbar" style="width:<?php echo 100/15*$qnow;?>%"><h6><?php echo $qnow;?></h6>
			</div>
		</div>
	</div>
</div>
<?php



