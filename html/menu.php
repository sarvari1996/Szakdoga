<?php
function menu() {
	$permission = new Permission;		
	$database = new database();	
	?>	
	<style>
		a {
			color: #3498db; 
		}
	</style>
	<nav class="navbar navbar-default" style="top:0;margin-bottom:0px;">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- Szedvics ikon md méret alatt -->			
				
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">					
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<button type="button" onclick="posting(0);" class="chatb navbar-toggle collapsed" style="background-image:url('src/chaticon.png');background-size: 100% 100%; background-repeat: no-repeat;">					
					<input onclick="posting(0);" style='position:absolute;clip:rect(0,0,0,0);' type="submit" id="chatb">
					<span style="opacity: 0;" class="icon-bar"></span>
					<span style="opacity: 0;" class="icon-bar"></span>
					<span style="opacity: 0;" class="icon-bar"></span>
				</button>
				
				<a class="navbar-brand" href="index.php?page=home">Impossible quiz</a>
			</div>

			<!-- Fejléc menüpontjai, md alatt lenyílómenüként -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href='index.php?page=gameopt'>JÁTÉK</a></li>		
					<li><a href="index.php?page=toplist">Toplista</a></li>					
				</ul>
				<!-- Láthatóság-kiíratni való -->
				<ul class="nav navbar-nav navbar-right">				
					<li><a class="chatb">	
						<input onclick="posting(0);" style='position:absolute;clip:rect(0,0,0,0);' type="submit">Chat
					</a></li>
					<?php $permission->permecho("admin","<li><a href='index.php?page=addquestions'>Kérdés hozzáadás</a></li>"); ?>
					<?php $permission->permecho("none","<li><a data-toggle='modal' data-target='#modal'>Bejelentkezés / Regisztráció</a></li>"); ?>
					<?php $permission->permecho("login","<li><a href='index.php?page=profil'>Profil</a></li>"); ?>
					<?php $permission->permecho("login","<li><a href='index.php?page=logout'>Kijelentkezés</a></li>"); ?>
				</ul>
			</div>
		</div>
	</nav>	
	<div style="padding-top:70px" id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-login">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form id="login-form" method="POST" style="display: block;">
										<h2>Bejelentkezés</h2>
										<div class="form-group">
											<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
										</div>
										<div class="form-group">
											<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
										</div>
										<div class="col-xs-6 form-group pull-right">     
											<label style="padding:5px 5px;text-align:center;margin-top:15px;" class="element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg">
												<input style='position:absolute;clip:rect(0,0,0,0);' type="submit" name="formop" id="login-submit" tabindex="5" class="form-control btn btn-login" value="Log In">Belép
											</label>
										</div>
									</form>
									<form id="register-form" method="POST" style="display: none;">
										<h2>Regisztráció</h2>
										<div class="form-group">
											<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Felhasználónév" value="">
										</div>
										<div class="form-group">
											<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email cím" value="">
										</div>
										<div class="form-group">
											<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Jelszó">
										</div>
										<div class="form-group">
											<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Jelszó megerősítés">
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-6">					
													<label style="padding:5px 5px;text-align:center;margin-top:15px;" class="element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg">
														<input style='position:absolute;clip:rect(0,0,0,0);' type="submit" name="formop" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrate">Megerősít
													</label>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-6 tabs" >
									<a href="#" class="active" id="login-form-link"><div style="border-radius:0px 0px 0px 10px;background-color:#E8E9EC;color:black;border-right:1px solid black;" class="login">Bejelentkezés</div></a>
								</div>
								<div class="col-xs-6 tabs">
									<a href="#" id="register-form-link"><div style="background-color:#E8E9EC;color:black;" class="register">Regisztráció</div></a>
								</div>
							</div>
						</div>
					</div>  
				</div>
			</div>
		</div>
	</div>
		<div class="container">
			<div  id="chat" style="display:none;left:15px;right:15px;position:absolute;z-index: 1;max-width:1140px;margin:auto;border:0px;border-radius:0px 0px 20px 20px" class="modal-content">	
				<div class="row">
					<div class="col-xs-1" style="padding:0px 0px;">
					</div>				
					<div class='col-xs-10' style='padding:0px 0px;text-align:left;'>		
						<div id='chatref' style='padding:0px'>
						</div>
							
						<?php $permission->permecho("login","
									<div class='row'>
										<div class='col-sm-1' style='padding:0px 0px;'>
										</div>
										<div class='col-xs-8 col-sm-7' style='text-align:center;'>	
											<input style='margin-top:8px;' class='col-xs-8 element-animation1 btn btn-default btn-block type='text' id='chattext'>
										</div>
										<div class='col-xs-4 col-sm-3' style='text-align:center;'>	
											<label style='padding:5px 5px;text-align:center;' id='posting' class='element-animation1 btn btn-lg btn-default btn-block btn3d'>	
												<input style='right:0px;left:0px;position:absolute;clip:rect(0,0,0,0);' type='submit' onclick='posting(1)'><h6 class='hidden-sm hidden-md hidden-lg'>Küld</h6> <h4 class='hidden-xs'>Küld</h4>
											</label>
										</div>
									</div>");?>									
					</div>
					<div class="col-xs-1" style="padding:0px 0px;">
					</div>						
				</div>					
			</div>						
		</div>
	<?php
}