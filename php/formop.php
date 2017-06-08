<?php
function formop(){
	
	$database = new database();
	
	if($_POST["formop"] == "Log In"){
		if(!empty($_POST["username"]) && !empty($_POST["password"])){
			
			$jelsz = $database->encription($_POST["password"]); 
			
			$database->select('users', '*', 'username="'.$_POST["username"].'" AND password="'.$jelsz.'"', '');
		
			if ($database->getResult()->num_rows == 1) {
				$_SESSION['permission'] = $database->getRow()['permission'];
				$_SESSION['userid'] = $database->getRow()['id'];
				$_SESSION['username'] = $_POST['username'];				
				header('Location: index.php?page='.$_GET["page"].''); 
			} 			
			else {
				echo "<p id='uezenet' class='alert alert-danger'>Rossz felhasználónév vagy jelszó páros !</p>";
			}
		}
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Töltsd ki a mezőket !</p>";
		}
	}
	
	else if($_POST["formop"] == "Registrate"){
		if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["confirm-password"])){
			if($_POST["password"] == $_POST["confirm-password"]){
				
				$jelsz = $database->encription($_POST["password"]);
				
				$database->select("users", "username", "username = '".$_POST['username']."'", "");
				
				if($database->getResult()->num_rows == 1){
					echo "<p id='uezenet' class='alert alert-danger'>Felhasználónév foglalt !</p>";	
				}
				else{
					$database->insert("users", "username, email, password, permission, points, icon, chatcolor", 
										"'".htmlspecialchars($_POST['username'])."', 
										'".htmlspecialchars($_POST['email'])."', 
										'".$jelsz."',
										'user',
										'0',
										'kép',
										'black'
										", "");					
							
					if ($database->getConn()->query($database->getSql()) === TRUE) {
						
						$database->select('users', '*', 'username="'.htmlspecialchars($_POST["username"]).'"', '');
						
						$database->insert("records", "userid, gametype, points", "'".$database->getRow()['id']."', '1', '0'", "");									
						mysqli_query($database->getConn(), $database->getSql());
						
						$database->insert("records", "userid, gametype, points", "'".$database->getRow()['id']."', '2', '0'", "");									
						mysqli_query($database->getConn(), $database->getSql());
					
						$database->insert("records", "userid, gametype, points", "'".$database->getRow()['id']."', '3', '0'", "");									
						mysqli_query($database->getConn(), $database->getSql());
						
						//header('Location: index.php?page='.$_GET["page"].'');
						echo "<p id='uezenet' class='alert alert-success'>Siker, lépjen be!</p>";
					} 
					else {
						echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
					}	
				}					
			}
			else {
				echo "<p id='uezenet' class='alert alert-danger'>Jelszavak nem egyeznek !</p>";
			}
		}
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Töltsd ki a mezőket !</p>";
		}
	}

	if($_POST["formop"] == "Delete Bug"){
			
		$database->del("bugs", "id = '".$_POST['delid']."'", $etc = "");
		
		if ($database->getConn()->query($database->getSql()) === TRUE) { 
			header('Location: index.php?page='.$_GET["page"].'');
		} 
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
		}
	}
	
		if($_POST["formop"] == "Send Bug"){
		if(!empty($_POST["bugtext"])){
			
			$database->select('bugs', 'id', 'userid="'.$_SESSION["userid"].'"', '');

			if ($database->getResult()->num_rows == 0) {
				
				$database->insert("bugs", "userid, text", 
										"'".$_SESSION['userid']."', 
										'".$_POST['bugtext']."'
										", "");					
							
				if ($database->getConn()->query($database->getSql()) === TRUE) {
					header('Location: index.php?page='.$_GET["page"].'');
				} 
				else {
					echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
				}
			} 			
			else {
				echo "<p id='uezenet' class='alert alert-danger'>Maximum egy poszt !</p>";
			}
		}
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Töltsd ki a mezőket !</p>";
		}
	}
	
	if($_POST["formop"] == "Delete New"){
			
		$database->del("news", "id = '".$_POST['delid']."'", $etc = "");
		
		if ($database->getConn()->query($database->getSql()) === TRUE) { 
			header('Location: index.php?page='.$_GET["page"].'');
		} 
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
		}
	}
	
	if($_POST["formop"] == "Post New"){
		if(!empty($_POST["newtext"]) || !empty($_POST["newtitle"])){
				
			$database->insert("news", "userid, title, text, date", 
									"'".$_SESSION['userid']."', 
									'".($_POST['newtitle'])."',
									'".($_POST['newtext'])."',
									'".date('Y/m/d')."'
									", "");					
						
			if ($database->getConn()->query($database->getSql()) === TRUE) {
				header('Location: index.php?page='.$_GET["page"].'');
			} 
			else {
				echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
			}
		}
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Töltsd ki a mezőket !</p>";
		}
	}
	
	if($_POST["formop"] == "Ref New"){
		if(!empty($_POST["newtext"]) || !empty($_POST["newtitle"])){
				
			//$database->update("users", "username = '".$_POST['username']."', email = '".$_POST['email']."', password = '".$jelsz."', icon = '".$target_file."', chatcolor = '".$_POST['chatcolor']."'", "id = '".$_SESSION['userid']."'", "");	
				
			$database->update("news", "title = '".$_POST['newtitle']."', text = '".$_POST['newtext']."'", "id = '".$_POST['delid']."'", "");				
			echo $database->getSql();
			if ($database->getConn()->query($database->getSql()) === TRUE) {
				header('Location: index.php?page='.$_GET["page"].'');
			} 
			else {
				echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
			}
		}
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Töltsd ki a mezőket !</p>";
		}
	}
	
	else if($_POST["formop"] == "Add Question"){
		if(!empty($_POST["question"]) && !empty($_POST["type"]) && !empty($_POST["difficulty"]) && !empty($_POST["answer1"]) && !empty($_POST["answer2"]) && !empty($_POST["answer3"]) && !empty($_POST["answer4"]) && !empty($_POST["correct"])){
			if($_POST["answer1"] != $_POST["answer2"] && $_POST["answer1"] != $_POST["answer3"] && $_POST["answer1"] != $_POST["answer4"] && 
				$_POST["answer2"] != $_POST["answer3"] && $_POST["answer2"] != $_POST["answer4"] && 
				$_POST["answer3"] != $_POST["answer4"]){
							
				$database->select("questions", "question", "question = '".$_POST['question']."'", "");

				if($database->getResult()->num_rows == 1){
					echo "<p id='uezenet' class='alert alert-danger'>A kérdés foglalt.</p>";	
				}
				else{
					
					$database->select("questions", "id", "id IS NOT NULL", "");
					
					if(basename($_FILES["fileToUpload"]["name"]) != ''){
						$num_rows = mysqli_num_rows($database->getResult());
						$target_name = $num_rows."". substr(basename($_FILES["fileToUpload"]["name"]), -4);
						$target_file = "uploadsq/".$target_name ;
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						// Check if image file is a actual image or fake image
						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check !== false) {
							$uploadOk = 1;
						} 
						else {
							echo "<p id='uezenet' class='alert alert-danger'>Ez nem egy kép.</p>";
							$uploadOk = 0;
						}
						//}
						// Check if file already exists
						if (file_exists($target_file)) {
								
							if ( glob($target_file)) {
								array_map( "unlink" , glob($target_file) ); // it's deleting  with the same name, it doesnt care with its extension
							}
						}
						// Check file size
						if ($_FILES["fileToUpload"]["size"] > 500000) {
							echo "<p id='uezenet' class='alert alert-danger'>Túl nagy a kép.</p>";
							$uploadOk = 0;
						}
						// Allow certain file formats
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ) {
							echo "<p id='uezenet' class='alert alert-danger'>Csak JPG, JPEG, PNG & GIF engedélyezett.</p>";
							$uploadOk = 0;
						}
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
							echo "<p id='uezenet' class='alert alert-danger'>Hiba</p>";
						// if everything is ok, try to upload file
						} 
						else {
							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
								echo "<p id='uezenet' class='alert alert-succes'> ". basename( $_FILES["fileToUpload"]['name']). " feltöltve.</p>";
								$database->insert("questions", "question, type, difficulty, background, answer1, answer2, answer3, answer4, correct ", 
											"'".htmlspecialchars($_POST['question'])."', 
											'".htmlspecialchars($_POST['type'])."', 
											'".htmlspecialchars($_POST['difficulty'])."',
											'".htmlspecialchars($target_file)."',
											'".htmlspecialchars($_POST['answer1'])."',
											'".htmlspecialchars($_POST['answer2'])."',
											'".htmlspecialchars($_POST['answer3'])."',
											'".htmlspecialchars($_POST['answer4'])."',
											'".htmlspecialchars($_POST['correct'])."'
											", "");						
											
								if ($database->getConn()->query($database->getSql()) === TRUE) {	
									//header('Location: index.php?page='.$_GET["page"].'');
								} 
								else {
									echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
								}
							} 
							else {
								echo "<p id='uezenet' class='alert alert-danger'>Hiba a feltöltésnél!</p>";
							}
						}						
					}
					else{
						//$database->select("users", "password", "id = '".$_SESSION['userid']."'", "");
						$database->insert("questions", "question, type, difficulty, background, answer1, answer2, answer3, answer4, correct ", 
											"'".htmlspecialchars($_POST['question'])."', 
											'".htmlspecialchars($_POST['type'])."', 
											'".htmlspecialchars($_POST['difficulty'])."',
											'".htmlspecialchars($target_file)."',
											'".htmlspecialchars($_POST['answer1'])."',
											'".htmlspecialchars($_POST['answer2'])."',
											'".htmlspecialchars($_POST['answer3'])."',
											'".htmlspecialchars($_POST['answer4'])."',
											'".htmlspecialchars($_POST['correct'])."'
											", "");						
											
						if ($database->getConn()->query($database->getSql()) === TRUE) {	
							header('Location: index.php?page='.$_GET["page"].'');
						} 
						else {
							echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
						}
					}					
				}
			}
			else {
				echo "<p id='uezenet' class='alert alert-danger'>Nem lehet 2 azonos válasz !</p>";
			}
		}
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Töltsd ki a mezőket !</p>";
		}
	}
	
	else if($_POST["formop"] == "Add Question Type"){
		if(!empty($_POST["qtype"])){
			
			$database->select("questiontypes", "name", "name = '".$_POST['qtype']."'", "");
					
			if($database->getResult()->num_rows == 1){
				echo "<p id='uezenet' class='alert alert-danger'>Question Type taken.</p>";	
			}
			else{
				$database->insert("questiontypes", "name", "'".$_POST['qtype']."'", "");						
				echo $database->getSql();
				if ($database->getConn()->query($database->getSql()) === TRUE) {	
					header('Location: index.php?page='.$_GET["page"].'');
				} 
				else {
					echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
				}
			}	
		}
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Töltsd ki a mezőket !</p>";
		}
	}
	
	else if($_POST["formop"] == "Update user"){		
		if($_POST["password"] == $_POST["passwordsec"]){
			if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["chatcolor"])){
		
				$database->select("users", "*", "id = '".$_SESSION['userid']."'", "");
				
				
				if(basename($_FILES["fileToUpload"]["name"]) != ''){
					$target_name = $_SESSION['userid']."". substr(basename($_FILES["fileToUpload"]["name"]), -4);
					$target_file = "uploadsi/".$target_name ;
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						$uploadOk = 1;
					} 
					else {
						echo "<p id='uezenet' class='alert alert-danger'>Ez nem egy kép.</p>";
						$uploadOk = 0;
					}
					//}
					// Check if file already exists
					if (file_exists($target_file)) {
							
						if ( glob($target_file)) {
							array_map( "unlink" , glob($target_file) ); // it's deleting  with the same name, it doesnt care with its extension
						}
					}
					// Check file size
					if ($_FILES["fileToUpload"]["size"] > 500000) {
						echo "<p id='uezenet' class='alert alert-danger'>Túl nagy a kép.</p>";
						$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
						echo "<p id='uezenet' class='alert alert-danger'>Csak JPG, JPEG, PNG & GIF engedélyezett.</p>";
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "<p id='uezenet' class='alert alert-danger'>Hiba</p>";
					// if everything is ok, try to upload file
					} 
					else {
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							echo "<p id='uezenet' class='alert alert-succes'> ". basename( $_FILES["fileToUpload"]['name']). " feltöltve.</p>";
						} 
						else {
							echo "<p id='uezenet' class='alert alert-danger'>Hiba a feltöltésnél!</p>";
						}
					}	
				}
				else{
					$target_file = $database->getRow()['icon'];
				}
				
				if($database->getRow()["password"] == $_POST["password"]){
					$jelsz = $database->getRow()["password"];
				}
				else{
					$jelsz = $database->encription($_POST["password"]);
				}

				$database->update("users", "username = '".$_POST['username']."', email = '".$_POST['email']."', password = '".$jelsz."', icon = '".$target_file."', chatcolor = '".$_POST['chatcolor']."'", "id = '".$_SESSION['userid']."'", "");

				if ($database->getConn()->query($database->getSql()) === TRUE) {	
					$_SESSION["username"] = $_POST['username'];
					//header('Location: index.php?page='.$_GET["page"].'');
				} 
				else {
					echo "<p id='uezenet' class='alert alert-danger'>Sikertelen !</p>";
				}
			}
			else {
				echo "<p id='uezenet' class='alert alert-danger'>Töltsd ki a mezőket !</p>";
			}
		}	
		else {
			echo "<p id='uezenet' class='alert alert-danger'>Jelszavak nem egyeznek !</p>";
		}
	}

	
}	
?>