<?php
function addquestions(){
	$database = new database();
?>	
	
	<div class="container" align="center">
		<div style="padding-left:15px;padding-right:15px;" class="modal-content">
			<form method="POST" enctype="multipart/form-data">
				<div class="row">				
					<div class="col-xs-6 col-sm-4" style="padding:0px 0px;">	
						<h3 class="col-sm-12 hidden-xs">Tipus</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Tipus</h5>
						<select name="type" class="form-control" style="font-size:120%">
							<?php
							$database->select('questiontypes', 'name', 'name IS NOT NULL', '');
							
							$result = mysqli_query($database->getConn(),$database->getSql());
							
							while($row = $result->fetch_assoc()){
							   echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
							}							
							?>
						</select> 
					</div>
					<div class="col-xs-6 col-sm-4" style="padding:0px 0px;">
						<h3 class="col-sm-12 hidden-xs">Quiz Nehézség</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Quiz Nehézség</h5>
						<select class="form-control" style="font-size:120%" name="difficulty" >
							<option value="1">Könnyű</option>
							<option value="2">Közepes</option>
							<option value="3">Nehéz</option>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4" style="padding:0px 0px;">
						<h3 class="col-sm-12 hidden-xs">Kérdés</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Kérdés</h5>
						<input type="text" name="question" class="form-control" placeholder="Kérdés" value="">
					</div>
						<input type="hidden" name="correct" value="1">
					<div class="col-xs-6 col-sm-3" style="padding:0px 0px;">
						<h3 class="col-sm-12 hidden-xs">Helyes válasz</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Helyes válasz</h5>
						<input type="text" name="answer1" class="form-control" placeholder="Helyes válasz">
					</div>
					<div class="col-xs-6 col-sm-3" style="padding:0px 0px;">
						<h3 class="col-sm-12 hidden-xs">Válasz 2</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Válasz 2</h5>
						<input type="text" name="answer2" class="form-control" placeholder="Válasz 2">
					</div>
					
					<div class="col-xs-6 col-sm-3" style="padding:0px 0px;">
						<h3 class="col-sm-12 hidden-xs">Válasz 3</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Válasz 3</h5>
						<input type="text" name="answer3" class="form-control" placeholder="Válasz 3">
					</div>
					<div class="col-xs-6 col-sm-3" style="padding:0px 0px;">
						<h3 class="col-sm-12 hidden-xs">Válasz 4</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Válasz 4</h5>
						<input type="text" name="answer4" class="form-control" placeholder="Válasz 4">
					</div>				
				</div>
				<div class="row ">				
					<div class="col-xs-1 col-sm-3" style="padding:5px 5px;">
					</div>
					<div class="col-xs-10 col-sm-6" >
						<h3 class="col-sm-12 hidden-xs">Kép (nem kötelező)</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Kép (nem kötelező)</h5>
						<input style="font-size:90%" type="file" name="fileToUpload" id="fileToUpload">
					</div>
				</div>										
				<div class="row">
					<div class="col-sm-4 col-xs-3" style="padding:5px 5px;">
					</div>
					<div class="col-sm-4 col-xs-6" align="center">
						<label style="padding:5px 5px;text-align:center;margin-top:15px;" class="element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg">
							<input style='position:absolute;clip:rect(0,0,0,0);' type="submit" name="formop" value="Add Question">Megerősít
						</label>
					</div>
				</div>
			</form>
		</div>
		<div style="padding-left:15px;padding-right:15px;" class="modal-content">
			<form method="POST">	
				<div class="row">
					<div class="col-xs-1 col-sm-3" style="padding:5px 5px;">
					</div>
					<div class="col-xs-10 col-sm-6" align="center">
						<h3 class="col-sm-12 hidden-xs">Kérdés tipus hozzáadása</h3>
						<h5 class="col-xs-12 hidden-sm hidden-md hidden-lg">Kérdés tipus hozzáadása</h5>
						<input type="text" name="qtype" class="form-control" placeholder="Kérdés Tipus">
					</div>					
				</div>
				<div class="row">
					<div class="col-sm-4 col-xs-3" style="padding:5px 5px;">
					</div>
					<div class="col-sm-4 col-xs-6" align="center">
						<label style="padding:5px 5px;text-align:center;margin-top:15px;" class="element-animation1 btn btn-lg btn-block btn3d btn btn-default btn-lg">
							<input style='position:absolute;clip:rect(0,0,0,0);' type="submit" name="formop" value="Add Question Type">Megerősít
						</label>
					</div>
				</div>
			</form>
		</div>
	</div>
	
<?php
}
?>