<?php
session_start(); 
ob_start();
?>
<style>
	h5, h4{
		margin-top: 5px;
		margin-bottom: 5px;
	}
</style>
<?php
include '../php/database.php'; 
$database = new database();
$pagenum = $_GET['pagenum'];
$recnum = 5;

$database->select('users INNER JOIN records ON users.id = records.userid', 
					'users.username, users.points, records.points AS recpoint', 
					'gametype = "'.$_GET['gamedif'].'"', 
					'ORDER BY recpoint DESC');	



$database->select('users INNER JOIN records ON users.id = records.userid', 
					'users.username, users.points, records.points AS recpoint', 
					'gametype = "'.$_GET['gamedif'].'"', 
					'ORDER BY recpoint DESC LIMIT '.$recnum.' OFFSET '.(($pagenum*$recnum)-$recnum).'');							
				
$result = mysqli_query($database->getConn(),$database->getSql());

echo '<div class="container element-animation1" style="text-align:center">
		<div class="row">
			<div class="col-xs-2" style="padding:0px 0px;"></div>
			<div class="col-xs-5"><h3 class="row hidden-xs">Felhasználónév</h3><h4 class="row hidden-sm hidden-md hidden-lg">Felhasználónév</h4></div>
			<div class="col-xs-5"><h3 class="row hidden-xs">Rekord</h3><h4 class="row hidden-sm hidden-md hidden-lg">Rekord</h4></div>			
		</div>';

$rownum = ($pagenum*$recnum)-$recnum+1;

		
while($row = $result->fetch_assoc()){
   echo '<div class="row" ';if(isset($_SESSION['username'])){ if($row["username"] == $_SESSION["username"]){ echo 'style=color:red;';}} 
	echo '>
			<div class="col-xs-1" style="padding:0px 0px;"></div>
			<div class="col-xs-1" style="padding:0px 0px;"><h5 class="hidden-sm hidden-md hidden-lg">'.$rownum.'</h5><h4 class="hidden-xs">'.$rownum.'</h4></div>
			<div class="col-xs-5"><h5 class="hidden-sm hidden-md hidden-lg">'.$row["username"].'</h5><h4 class="hidden-xs">'.$row["username"].'</h4></div>
			<div class="col-xs-5"><h5 class="hidden-sm hidden-md hidden-lg">'.$row["recpoint"].'</h5><h4 class="hidden-xs">'.$row["recpoint"].'</h4></div>			
		</div>';
	$rownum++;
}
?>
		<div style="margin-top:10px;" class="row">
			<div class="col-xs-4">
				<?php if($pagenum > 1){ ?>
					<label style='padding:10px 0px;text-align:center;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
						<input type='radio' style='position:absolute;clip:rect(0,0,0,0);' onchange='records(<?php echo $pagenum-1 ?>)'>						
						<h4 class='hidden-xs'>Vissza</h4>
						<h6 class='hidden-sm hidden-md hidden-lg'>Vissza</h6>
					</label>
				<?php } ?>
			</div>
			<div class="col-xs-1" style="padding:0px 0px;"></div>
			<div class="col-xs-2" style="padding:0px 0px;">
				<label style='padding:10px 0px;text-align:center;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
					<h4 class='hidden-xs'><?php echo $pagenum ?></h4>
					<h6 class='hidden-sm hidden-md hidden-lg'><?php echo $pagenum ?></h6>
				</label>
			</div>
						<div class="col-xs-1" style="padding:0px 0px;"></div>
			<div class="col-xs-4">
				<?php if(($pagenum*$recnum) < $rownum){ ?>
					<label style='padding:10px 0px;text-align:center;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
						<input type='radio' style='position:absolute;clip:rect(0,0,0,0);' onchange='records(<?php echo $pagenum+1 ?>)'>						
						<h4 class='hidden-xs'>Előre</h4>
						<h6 class='hidden-sm hidden-md hidden-lg'>Előre</h6>
					</label>
				<?php } ?>
			</div>
		</div>
	</div>


