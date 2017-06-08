<?php
function toplist(){
	
	$database = new database();
	
	?>
	<body onload="records(1)">
		<div class="modal-content" style="max-width:1200px;margin-left:auto;margin-right:auto;padding-bottom:15px;">	
			<div class="container">						
				<div class="modal-header">
					<h1 class="hidden-xs">Toplista</h1>
					<h3 class="hidden-sm hidden-md hidden-lg">Toplista</h3>
				</div>
				<div class="row" align="center">				
					<div class="col-xs-1 col-sm-2" style="padding:0px 0px;">	
					</div>
					<div class="col-xs-10 col-sm-8" style="padding-bottom:15px;">	
						<h2 class="hidden-xs">Nehézség</h2>
						<h3 class="hidden-sm hidden-md hidden-lg">Nehézség</h3>
						<select onchange="records(1)" id="topdif" class="form-control" style="font-size:120%">
							<option value="1">Könnyű</option>
							<option value="2">Közepes</option>
							<option value="3">Nehéz</option>
						</select>
					</div>							
				</div>
			</div>
			<div id="recref">	
			</div>
		</div>
	</body>
	
	
<?php
}