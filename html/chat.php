<?php
session_start(); 
ob_start();
?>
<style>
	h6, h4{
		margin-top: 1px;
		margin-bottom: 1px;
	}
</style>
<?php
include '../php/database.php'; 
$database = new database();
if(isset($_GET['posttext'])){
	if(!empty($_GET['posttext'])){
		$text = ($_GET['posttext']);
		
		$database->select("users", "*", "username = '".$_SESSION['username']."'", "");
		
		$timestamp = strtotime(date('H:i'), 60*60);
		
		$database->insert("chat", "user, text, date, color, rank", 
							"'".htmlspecialchars($_SESSION['username'])."', 
							'".htmlspecialchars($text)."', 
							'".date('H:i', $timestamp)."',
							'".$database->getRow()['chatcolor']."',
							'1'
							", "");
							
		if ($database->getConn()->query($database->getSql()) === TRUE) {		
		} 
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
		}
	}
}
	
$database->select('chat', '*', 'id IS NOT NULL', 'ORDER BY Id DESC LIMIT 10');

$result = mysqli_query($database->getConn(),$database->getSql());

echo "<div class='container' style='width:90%'>";
while($row = $result->fetch_assoc()){
	
	
	echo '<div style="padding-bottom:3px;" class="row hidden-sm hidden-md hidden-lg">
			<div class="col-xs-3" style="padding:0px 0px;color:'.$row["color"].'"><h6>'.$row["user"].'</h6><h6>'.$row["date"].'</h6></div>
			<div class="col-xs-8" style="padding:0px 0px;color:'.$row["color"].'"><h6>'.$row["text"].'</h6></div>
		</div>
		<div style="padding-bottom:3px;" class="row hidden-xs">
			<div class="col-sm-1" style="padding:0px 0px;color:'.$row["color"].'"><h4>'.$row["date"].'</h4></div>
			<div class="col-sm-2" style="padding:0px 0px;color:'.$row["color"].'"><h4>'.$row["user"].'</h4></div>
			<div class="col-sm-9" style="padding:0px 0px;color:'.$row["color"].'"><h4>'.$row["text"].'</h4></div>
		</div>';
}
echo "</div>";


