<?php 
session_start(); 
ob_start();
include '../php/database.php'; 
?>
	<link rel="stylesheet" type="text/css" href="http://csshake.surge.sh/csshake.min.css">
	<script src="js/game.js"></script>
<?php
	


$database1 = new database();
$database2 = new database();

$database1->select("startedgame", "*", "userid = '".$_SESSION['userid']."'", "");
$qid = $database1->getRow()['q'.$database1->getRow()['qnow'].'id'];

             
if ($database1->getResult()->num_rows == 0) {	
	
	$q = $_GET['q'];

	$qids = array();

	$database2->select("questions", "*", "difficulty = '".$q."'", "ORDER BY RAND() LIMIT 15");
	
	$result = mysqli_query($database2->getConn(),$database2->getSql());
	
	$idcount = 1;
	
	while($row = mysqli_fetch_assoc($result)) {
		$qids[$idcount] = $row['id'];		
		$idcount++;
	}
	
	$database1->insert("startedgame", "userid, q1id, q2id, q3id, q4id, q5id, q6id, q7id, q8id, q9id, q10id, q11id, q12id, q13id, q14id, q15id, qnow, help1, help2, help3, help4, points, difficult, round ", 
						"'".$_SESSION['userid']."', 
						'".$qids[1]."', 
						'".$qids[2]."', 
						'".$qids[3]."', 
						'".$qids[4]."', 
						'".$qids[5]."', 
						'".$qids[6]."', 
						'".$qids[7]."', 
						'".$qids[8]."', 
						'".$qids[9]."', 
						'".$qids[10]."', 
						'".$qids[11]."', 
						'".$qids[12]."', 
						'".$qids[13]."', 
						'".$qids[14]."', 			
						'".$qids[15]."',
						'1',
						'1',
						'1',
						'1',
						'1',
						'0',
						'".$q."',
						'1'
						", "");	
	if ($database1->getConn()->query($database1->getSql()) === TRUE) {	
		header('Location: '.$_SERVER['REQUEST_URI']);
	} 
	else {
		echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
	}
} 	
else{
	$database1->update("startedgame", "round = 1", "userid = '".$_SESSION['userid']."'", $etc = "");
	if ($database1->getConn()->query($database1->getSql()) === TRUE) {
	} 
	else {
		echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
	}
	$database2->select("questions", "*", "id = '".$qid."'", "");
	
	$valaszok = array(
				"<div class='col-xs-5' id='valasz1'>
					<label style='padding:10px 10px;text-align:center;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
						<input type='radio' style='position:absolute;clip:rect(0,0,0,0);' onchange='valasz(1)'>
						<h4 class='hidden-xs'>".$database2->getRow()['answer1']."</h4>
						<h6 class='hidden-sm hidden-md hidden-lg'>".$database2->getRow()['answer1']."</h6>
					</label>
				</div>"
				,
				"<div class='col-xs-5' id='valasz2'>
					<label style='padding:10px 10px;text-align:center;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
						<input type='radio' style='position:absolute;clip:rect(0,0,0,0);' onchange='valasz(2)'>
						<h4 class='hidden-xs'>".$database2->getRow()['answer2']."</h4>
						<h6 class='hidden-sm hidden-md hidden-lg'>".$database2->getRow()['answer2']."</h5>
					</label>
				</div>"
				,
				"<div class='col-xs-5' id='valasz3'>
					<label style='padding:10px 10px;text-align:center;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
						<input type='radio' style='position:absolute;clip:rect(0,0,0,0);' onchange='valasz(3)'>
						<h4 class='hidden-xs'>".$database2->getRow()['answer3']."</h4>
						<h6 class='hidden-sm hidden-md hidden-lg'>".$database2->getRow()['answer3']."</h6>
					</label>
				</div>"
				,
				"<div class='col-xs-5' id='valasz4'>
					<label style='padding:10px 10px;text-align:center;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
						<input type='radio' style='position:absolute;clip:rect(0,0,0,0);' onchange='valasz(4)'>						
						<h4 class='hidden-xs'>".$database2->getRow()['answer4']."</h4>
						<h6 class='hidden-sm hidden-md hidden-lg'>".$database2->getRow()['answer4']."</h6>
					</label>
				</div>",
				);					
	shuffle($valaszok);	
	
	?>
	<div class="container">
		<div class="row">
			<div class="progress">
				<div id="countdown" class="progress-bar progress-bar-striped active" role="progressbar" style="width:100%">10</div>
			</div>
		</div>
		<div class="row">
			<div align="center" class="hidden-xs jumbotron" style="border: 1px solid #BEBEBE; padding-bottom: 20px;padding-top: 10px;border-top-width: 1px;border-bottom-width: 1px;margin-bottom:0px;">
				<p style="float:left;"><?php echo "Pontok: ".$database1->getRow()['points']; ?></p> 
				<p style="float:right;"><?php echo $database2->getRow()['type']; ?></p><br /> 
				<h2><?php echo $database2->getRow()['question']; ?></h2> 
			</div>
			<div align="center" style="border: 1px solid #BEBEBE; text-align:center;padding-top:0px;padding-bottom:5px;margin-bottom:0px;" class="jumbotron hidden-sm hidden-md hidden-lg">
				<p style="font-size:14px;float:left;"><?php echo "Pontok: ".$database1->getRow()['points']; ?></p> 
				<p style="font-size:14px;float:right;"><?php echo $database2->getRow()['type']; ?></p><br />
				<h4 style="text-align:center;"><?php echo $database2->getRow()['question']; ?></h4> 
			</div>
		</div>
		<?php
		if($database2->getRow()['background'] != ''){
		?>
			<div class="row hidden-xs">
				<div class="col-sm-2" style="padding:0px 0px;">
				</div>
				<div class="col-sm-8" style="background: url('<?php echo $database2->getRow()["background"]; ?>');height: 300px; background-size: 100% 100%;background-repeat: no-repeat;">
				</div>

			</div>
			<div class="row hidden-sm hidden-md hidden-lg">
				<div class="col-xs-0" style="padding:0px 0px;">
				</div>
				<div class="col-xs-12" style="background: url('<?php echo $database2->getRow()["background"]; ?>'); background-size: 100% 100%;height: 150px;background-repeat: no-repeat;">
				</div>
			</div>
		<?php
		}
		else{
		?>
			<div style="padding:150px;" class="row hidden-xs">
			</div>
			<div style="padding:75px;" class="row hidden-sm hidden-md hidden-lg">
			</div>
		<?php
		}
		?>		
		<div class="row">
			<?php echo $valaszok[0];?>
			<div class="col-xs-2" style="padding:0px 0px;">
			</div>
			<?php echo $valaszok[1];?>
		</div>
		<div class="row top-buffer">
		</div>
		<div class="row">
			<?php echo $valaszok[2];?>
			<div class="col-xs-2" style="padding:0px 0px;">
			</div>
			<?php echo $valaszok[3];?>
		</div>
		<div class="row top-buffer">
		</div>
		<div class="row">
			<label id="help1" style="padding:5px 0px;" class="col-xs-2 element-animation1 btn3d btn btn-default <?php if($database1->getRow()["help1"] != 1){ echo "disabledbutton";}?>">				
				<input type="radio" style="position:absolute;clip:rect(0,0,0,0);" onchange='help(1)'><h6>100%</h6>
			</label>
			<div class="col-xs-1" style="padding:0px 0px;">
			</div>			
			<label id="help2" style="padding:5px 0px;" class="col-xs-2 element-animation2 btn3d btn btn-default <?php if($database1->getRow()["help2"] != 1){ echo "disabledbutton";}?>">				
				<input type="radio" style="position:absolute;clip:rect(0,0,0,0);" onchange='help(2)'><h6>50%</h6>
			</label>			
			<div class="col-xs-2" style="padding:0px 0px;">
			</div>
			<label id="help3" style="padding:5px 0px;" class="col-xs-2 element-animation3 btn3d btn btn-default <?php if($database1->getRow()["help3"] != 1){ echo "disabledbutton";}?>">				
				<input type="radio" style="position:absolute;clip:rect(0,0,0,0);" onchange='help(3)'><h6>25%</h6>
			</label>
			<div class="col-xs-1" style="padding:0px 0px;">
			</div>
			<label id="help4" style="padding:5px 0px;" class="col-xs-2 element-animation4 btn3d btn btn-default <?php if($database1->getRow()["help4"] != 1){ echo "disabledbutton";}?>">				
				<input type="radio" style="position:absolute;clip:rect(0,0,0,0);" onchange='help(4)'><h6>+10mp</h6>
			</label>
		</div>
		<div class="row top-buffer hidden-xs">
		</div>
	</div>
	</body>
	<?php	
}
