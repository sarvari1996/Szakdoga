<?php 

class Permission{
	
	public $permission = "none";
	
	public function getperm() {
        return $this->permission;
    }
	
    public function setperm($x) {
        $_SESSION['permission'] = $x;
		$this->permission = $x;
    }	
	
	function __construct() {
		if(isset($_SESSION['permission']) && $_SESSION['permission'] != 'none'){
			$database = new database();
			$database->select("users", "permission", "id = '".$_SESSION["userid"]."'", "");
			$this->setperm($database->getRow()['permission']);	
		}
		else{
			$_SESSION['permission'] = "none";
		}
	}
	
	function permecho($perm, $echo){
		if( $this->getperm() == "admin" && $perm == "admin"){
			echo $echo;
		}
		else if ($this->getperm() == "user" && $perm == "login" || $this->getperm() == "admin" && $perm == "login"){
			echo $echo;
		}
		else if($this->getperm() == "user" && $perm == "user"){
			echo $echo;
		}
		else if ($this->getperm() == "none" && $perm == "none"){
			echo $echo;
		}
		else if ($this->getperm() != "admin" && $perm == "noadmin"){
			echo $echo;
		}
	}
}	
?>