<?php
function profil(){
	
	$database = new database();
	
	if(isset($_GET["username"])){
		$database->select("users", "*", "username = '".$_GET["username"]."'", "");
	}
	else{
	$database->select("users", "*", "id = '".$_SESSION['userid']."'", "");
	}	
	?>

	<div class="container">
		<div class="modal-content">
			<div id="csere">	
				<div class="modal-header">
					<h1 class="hidden-xs"><?php echo $database->getRow()['username']; ?> Profilja</h1>
					<h3 class="hidden-sm hidden-md hidden-lg"><?php echo $database->getRow()['username']; ?> Profilja </h3>
					<h6>(csak azt írd át amit változtatsz)</h6>
				</div>
				<div class="modal-body">
					<form method="POST" enctype="multipart/form-data">
						<div class="row" align="center">				
							<div class="col-xs-6 col-sm-3 ">	
								<h3 class="hidden-xs">Felhasználónév</h3>
								<h4 class="hidden-sm hidden-md hidden-lg">Felhasználónév</h4>
								<input type="text" name="username" class="form-control" value="<?php echo $database->getRow()['username']; ?>">
							</div>
							<div class="col-xs-6 col-sm-1 ">	
								<h3 class="hidden-xs">Pontok</h3>
								<h4 class="hidden-sm hidden-md hidden-lg">Pontok</h4>
								<h4 class="col-sm-12 hidden-xs"><?php echo $database->getRow()['points']; ?></h4> 
								<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg"><?php echo $database->getRow()['points']; ?></h5>
							</div>	
							<div class="col-xs-12 col-sm-4 ">	
								<h3 class="hidden-xs">Email</h3>
								<h4 class="hidden-sm hidden-md hidden-lg">Email</h4>
								<input type="email" id="color" name="email" class="form-control" value="<?php echo $database->getRow()['email']; ?>">
							</div>						
							<div class="col-xs-12 col-sm-4 ">	
								<h3 class="hidden-xs">Chat szine</h3>
								<h4 class="hidden-sm hidden-md hidden-lg">Chat szine</h4>
								<div class="colorPicker" style="margin-top: 0px;">
								  <input class="brown" type="radio" name="chatcolor" value="brown" id="chatcolor-brown" <?php if($database->getRow()['chatcolor'] == 'brown'){echo 'checked';}?>/>
								  <label class="brown" for="chatcolor-brown">brown</label>
								  <input class="orange" type="radio" name="chatcolor" value="orange" id="chatcolor-orange" <?php if($database->getRow()['chatcolor'] == 'orange'){echo 'checked';}?>/>
								  <label class="orange" for="chatcolor-orange">orange</label>
								  <input class="green" type="radio" name="chatcolor" value="green" id="chatcolor-green" <?php if($database->getRow()['chatcolor'] == 'green'){echo 'checked';}?>/>
								  <label class="green" for="chatcolor-green">green</label>
								  <input class="blue" type="radio" name="chatcolor" value="blue" id="chatcolor-blue" <?php if($database->getRow()['chatcolor'] == 'blue'){echo 'checked';}?>/>
								  <label class="blue" for="chatcolor-blue">blue</label>
								  <input class="indigo" type="radio" name="chatcolor" value="indigo" id="chatcolor-indigo" <?php if($database->getRow()['chatcolor'] == 'indigo'){echo 'checked';}?>/>
								  <label class="indigo" for="chatcolor-indigo">indigo</label>
								  <input class="black" type="radio" name="chatcolor" value="black" id="chatcolor-black" <?php if($database->getRow()['chatcolor'] == 'black'){echo 'checked';}?>/>
								  <label class="black" for="chatcolor-black">black</label>
								</div>
							</div>
						</div>
						<div class="row" align="center" align="center">
							<div class="col-xs-12 col-sm-6">	
								<h3 class="hidden-xs" >Jelszó</h3> 
								<h4 class="hidden-sm hidden-md hidden-lg">Jelszó</h4> 
								<input style="margin-bottom:10px;" type="password" placeholder="Jelszó" name="password" class="form-control" value="<?php echo $database->getRow()['password']; ?>">
								<input type="password" placeholder="Mégegyszer" name="passwordsec" class="form-control" value="<?php echo $database->getRow()['password']; ?>">
							</div>
							<div class="col-xs-12 col-sm-6" style="margin-bottom: 15px;">
								<h3 class="col-sm-12 hidden-xs">Kép</h3>
								<h4 class="col-xs-12 hidden-sm hidden-md hidden-lg">Kép</h4>
								<input type="file" name="fileToUpload" id="fileToUpload">																			
								<div class="jumbview" style="background-color:#E8E9EC;background-image: url('<?php echo $database->getRow()['icon']; ?>');height:100px;width:100px;background-repeat:no-repeat;background-size:100% 100%;background-position:center;">
								</div>
							</div>	
						</div>	
						<div class="row" align="center">
							<div class="col-xs-6 col-sm-6" >	
								<h2 class="hidden-xs">Toplista:</h2>
								<h4 class="hidden-sm hidden-md hidden-lg" style="margin-bottom:30px;">Toplista:</h4>
								<?php
								$database->select('users INNER JOIN records ON users.id = records.userid', 
									'users.username, users.points, records.points AS recpoint', 
									'gametype = 1', 
									'ORDER BY recpoint DESC, userid DESC');?>
								<h3 class="hidden-xs">Könyű: <?php echo $database->getRowNum($_SESSION["username"], "username"); ?>.</h3>
								<h5 class="hidden-sm hidden-md hidden-lg">Könyű: <?php echo $database->getRowNum($_SESSION["username"], "username"); ?>.</h5>
								<?php
								$database->select('users INNER JOIN records ON users.id = records.userid', 
									'users.username, users.points, records.points AS recpoint', 
									'gametype = 2', 
									'ORDER BY recpoint DESC, userid DESC');?>
								<h3 class="hidden-xs">Közepes: <?php echo $database->getRowNum($_SESSION["username"], "username"); ?>.</h3>
								<h5 class="hidden-sm hidden-md hidden-lg">Közepes: <?php echo $database->getRowNum($_SESSION["username"], "username"); ?>.</h5>
								<?php
								$database->select('users INNER JOIN records ON users.id = records.userid', 
									'users.username, users.points, records.points AS recpoint', 
									'gametype = 3', 
									'ORDER BY recpoint DESC, userid DESC');?>
								<h3 class="hidden-xs">Nehéz: <?php echo $database->getRowNum($_SESSION["username"], "username"); ?>.</h3>
								<h5 class="hidden-sm hidden-md hidden-lg">Nehéz: <?php echo $database->getRowNum($_SESSION["username"], "username"); ?>.</h5>
							</div>
							<?php
								$database->select("records", "*", "userid = '".$_SESSION['userid']."'", "ORDER BY gametype");
							?>
							<div class="col-xs-6 col-sm-6" align="center">	
								<h2 class="hidden-xs">Rekordok:</h2>
								<h3 class="hidden-xs">Könyű: <?php echo $database->getNRow(1)['points']; ?></h3>
								<h3 class="hidden-xs">Közepes: <?php echo $database->getNRow(2)['points']; ?></h3>
								<h3 class="hidden-xs">Nehéz: <?php echo $database->getNRow(3)['points']; ?></h3>
								<h4 class="hidden-sm hidden-md hidden-lg" style="margin-bottom:30px;">Rekordok:</h4>
								<h5 class="hidden-sm hidden-md hidden-lg">Könyű: <?php echo $database->getNRow(1)['points']; ?></h5>
								<h5 class="hidden-sm hidden-md hidden-lg">Közepes: <?php echo $database->getNRow(2)['points']; ?></h5>
								<h5 class="hidden-sm hidden-md hidden-lg">Nehéz: <?php echo $database->getNRow(3)['points']; ?></h5>
							</div>
						</div>											
						<div class="row">
							<div class="col-sm-4 col-xs-3" style="padding:0px 0px;">
							</div>
							<div class="col-sm-4 col-xs-6" style="text-align:center;">
								<label style="padding:10px 10px;text-align:center;margin-top:15px;" class="element-animation1 btn btn-lg btn3d btn btn-default btn-lg">
									<input style='position:absolute;clip:rect(0,0,0,0);' type="submit" name="formop" value="Update user">Megerősít
								</label>
							</div>
							<div class="col-xs-3" style="padding:0px 0px;">
							</div>	
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>	
<?php
}