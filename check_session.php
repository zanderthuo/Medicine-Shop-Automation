<?php
session_start();

if(isset($_SESSION['email'])){

$email=$_SESSION['email'];
$t=$_SESSION['usertype'];

$page=null;
			if ($t==1)
			$page="shopkeeper/index.php";
			else if ($t==2)
				$page="patient/index.php";
			else if ($t==3)
				$page="doctor/index.php";
			else if($t==4)
				$page="supplier/index.php";
			
			header("Location: ".$page); 
		
}
else {
	header("Location:index.php");

}




?>
