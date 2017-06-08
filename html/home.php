<?php
function home(){
	$permission = new Permission;
	$database = new database();
	
	?>
	<body>	
		<div class="container" >			
			<div class="row" align="center">				
				<div class="col-xs-12 col-sm-6">	
					
					<?php 
					$database->select('bugs', '*', 'text IS NOT NULL', 'ORDER BY id DESC'); 
				
					if ($database->getResult()->num_rows == 0) {	
					} 			
					else {
						$permission->permecho("admin", "<h1 class='hidden-xs'>Üzenetek</h1>
						<h3 class='hidden-sm hidden-md hidden-lg'>Üzenetek</h3>");								
					}					
					
					$database->result = mysqli_query($database->getConn(),$database->getSql());
					
					while($row = $database->result->fetch_assoc()){

					$permission->permecho("admin", "<div class='row modal-content' align='center' style='border-bottom:1px solid black;'>
														<form method='POST'>
															<div class='col-xs-4 col-sm-3'>	
																<label style='padding:1px 1px;text-align:center;margin-top:7px;margin-bottom:3px;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
																	<input style='position:absolute;clip:rect(0,0,0,0);' type='submit' name='formop' value='Delete Bug'>Törlés
																	<input type='hidden' name='delid' value='".$row['id']."'>
																</label>
															</div>
															<div class='col-xs-8 col-sm-9'>	
																<h5 class='hidden-xs'>".$row['text']."</h5>
																<h5 class='hidden-sm hidden-md hidden-lg'>".$row['text']."</h5>
															</div>																
															
														</form>
													</div>");					
					}							

					$permission->permecho("user", "<div class='row modal-content' align='center' style='border-bottom:1px solid black;'>
														<h5>Üzenet adminnak</h5>
														<form method='POST'>
															<input type='text' name='bugtext' class='form-control' placeholder='Üzenet'>
															<label style='padding:5px 5px;text-align:center;margin-bottom:2px;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
																<input style='position:absolute;clip:rect(0,0,0,0);' type='submit' name='formop' value='Send Bug'>Megerősít
															</label>
														</form>
													</div>"); ?>
			
				</div>
			</div>
			<div class="row" align="center" style='margin:0px;'>					
				<?php 
				$database->select('news', '*', 'text IS NOT NULL', 'ORDER BY id DESC'); 
			
				if ($database->getResult()->num_rows == 0) {	
				} 			
				else {
					$permission->permecho("admin", "<h1 class='hidden-xs'>Hírek</h1>
					<h3 class='hidden-sm hidden-md hidden-lg'>Hírek</h3>");								
				}					
				
				$permission->permecho("admin", "<div class='row modal-content' align='center' style='margin:0px;margin-bottom:10px;'>
					<h5>Hír hozzáadás</h5>
					<form method='POST'>
						<input type='text' name='newtitle' class='form-control' placeholder='Cím'>
						<input type='text' name='newtext' class='form-control' placeholder='Hír'>							
						<label style='padding:5px 5px;text-align:center;margin-bottom:2px;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
							<input style='position:absolute;clip:rect(0,0,0,0);' type='submit' name='formop' value='Post New'>Megerősít
						</label>
					</form>
				</div>");
				
				$database->result = mysqli_query($database->getConn(),$database->getSql());
				
				while($row = $database->result->fetch_assoc()){							
				
					?>
					<div class='row modal-content' style='margin:0px;'>
						<form method='POST' style='margin-top:10px;'>							
							<?php								
							$permission->permecho("admin", "
									<div class='row'>	
										<div class='col-xs-2 col-sm-3 col-md-3' style='padding:0px'>	
										</div>
										<input style='text' name='newtitle' class='col-xs-8 col-sm-6 col-md-6' style='padding-bottom:20px;' value='".$row['title']."'>		
									</div>
									<div class='row'>
										<div class='col-xs-0 col-sm-2' style='padding:0px'>	
										</div>										
										<div class='col-xs-12 col-sm-8' style='padding:10px'>	
											<textarea style='width:90%;' name='newtext'>".$row['text']."</textarea>
										</div>
									</div>");								
							?>						
										
							<?php
							$permission->permecho("noadmin", "
									<div class='col-xs-12 hidden-xs' style='padding-bottom:20px;'>	
										<h3>".$row['title']."</h3>
									</div>
									<div class='col-xs-12 hidden-sm hidden-md hidden-lg' style='padding-bottom:20px;'>	
										<h4>".$row['title']."</h4>
									</div>
									
									<div class='col-xs-12 hidden-xs'>	
										<h4>".$row['text']."</h4>
									</div>
									<div class='col-xs-12 hidden-sm hidden-md hidden-lg'>	
										<h5>".$row['text']."</h5>
									</div>");										
							?>									
						<div class='col-xs-7 col-sm-8' style="padding:0px">	
						</div>
						<div class='col-xs-5 col-sm-4' style="text-align:right;">	
							<h5 class='hidden-xs'> <?php echo $row['date']; ?></h5>
							<h6 class='hidden-sm hidden-md hidden-lg'> <?php echo $row['date']; ?></h6>
						</div>						
							<?php
							$permission->permecho("admin", "<div class='row'  style='margin-top:10px;'> <div class='col-xs-6 col-sm-6'>	
										<label style='padding:1px 1px;text-align:center;margin-top:7px;margin-bottom:3px;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
											<input style='position:absolute;clip:rect(0,0,0,0);' type='submit' name='formop' value='Delete New'>Törlés
											<input type='hidden' name='delid' value=".$row['id'].">
										</label></div>");
							
							$permission->permecho("admin", "<div class='col-xs-6 col-sm-6'>	
										<label style='padding:1px 1px;text-align:center;margin-top:7px;margin-bottom:3px;' class='element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg'>
											<input style='position:absolute;clip:rect(0,0,0,0);' type='submit' name='formop' value='Ref New'>Módosítás
										</label></div></div>");?>
					</form>
					</div>		
					<?php
				}
				
				?>
				
			</div>						
		</div>
	</body>
	
	
<?php
}