<?php
function gameopt(){
	if(isset($_SESSION['userid'])){
		$database = new database();
		$database->select("startedgame", "*", "userid = '".$_SESSION['userid']."'", "");
		?>
		<body>
			<div style="max-width:1300px;margin-left:auto;margin-right:auto;" class="modal-dialog modal-content" id="modal-size">
				<div id="csere">	
					<?php
					if ($database->getResult()->num_rows == 1) {
						if ($database->getRow()['round'] == 1) {
							?><script>valasz(5);</script><?php
						}
						else{
							?><script>valasz(0);</script><?php
						}
					}
					else {	
						?>
						<div class="modal-header">
							<h3>Válassz nehézséget</h3>
						</div>
						<div class="modal-body">
							<div style="margin:auto;" class="quiz" id="quiz" data-toggle="buttons">
								<label class="element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg">
									<span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> 
									<input type="radio" onchange="diff(1)" value="1">Könnyű
								</label>
								<label style="margin-top:20px;margin-bottom:20px;" class="element-animation2 btn btn-lg btn-block btn3d btn btn-default btn-lg">
									<span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> 
									<input type="radio" onchange="diff(2)" value="2">Közepes
								</label>
								<label class="element-animation3 btn btn-lg btn-block btn3d btn btn-default btn-lg">
									<span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> 
									<input type="radio" onchange="diff(3)" value="3">Nehéz
								</label>
							</div>
						</div>
						<div class="modal-footer text-muted">
							<span id="answer"></span>
						</div>
					<?php
					}
					?>
				</div>		
			</div>
		</body>
	<?php
	}
	else{
		?>
		<body>
			<div style="max-width:1300px;margin-left:auto;margin-right:auto;" class="modal-dialog modal-content" id="modal-size">
				<div class="modal-header">
					<h3>A játékhoz regisztrálj vagy jelentkezz be!</h3>
				</div>
				<div class="modal-body">					
					<label data-toggle='modal' data-target='#modal' class="element-animation3 btn btn-lg btn-block btn3d btn btn-default btn-lg">
						<span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> 
						Bejelentkezés / Regsztráció
					</label>					
				</div>
				<div class="modal-footer text-muted">
					<span id="answer"></span>
				</div>	
			</div>
		</body>
		<?php
	}

}
?>