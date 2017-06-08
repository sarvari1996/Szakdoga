<?php 
class Page{
	function __construct() {			 
		?>
		<?php
		include 'html/menu.php'; 
		menu();
		
		if(isset($_POST['formop'])){
			include 'php/formop.php'; 
			formop();
		}
		
		if(isset($_GET['page'])){
			if($_GET['page']=='home'){				
				include 'html/home.php';
				home();				
			} 
			else if($_GET['page']=='toplist'){				
				include 'html/toplist.php';
				toplist();			
			} 
			else if($_GET['page']=='game'){				
				include 'html/game.php';
				game();			
			}
			else if($_GET['page']=='gameopt'){				
				include 'html/gameopt.php';
				gameopt();			
			}
			else if($_GET['page']=='profil'){				
				if($_SESSION['permission'] == 'admin' || $_SESSION['permission'] == 'user'){
					include 'html/profil.php';
					profil();		
				}
				else{
					session_destroy();
					header('Location: index.php?page=home');
					echo "<p id='uezenet'>Nono !</p>";
				}
			}
			else if($_GET['page']=='addquestions'){				
				if($_SESSION['permission'] == 'admin'){
					include 'html/addquestions.php';
					addquestions();		
				}
				else{
					session_destroy();
					header('Location: index.php?page=home');
					echo "<p id='uezenet'>Nono !</p>";
				}
			}
			else if($_GET['page']=='logout'){				
				session_destroy();
				header('Location: index.php?page=home');			
			}  
			else{
				include 'html/home.php';
				header('Location: index.php?page=home');
				
			}
		}
		else{
			include '../html/home.php';
			header('Location: index.php?page=home');
		}
	}
}	
?>