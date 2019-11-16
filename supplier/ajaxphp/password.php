<?php

require_once("../../connect.php");
session_start();

if(!isset($_SESSION['email'])){
	die("error");
}


$pass=$_POST['password'];
$email=$_SESSION['email'];


$qry="SELECT * from `users` where `user_id`= '".$email."' and `password`= '".$pass."'";
//echo $qry;
$r=mysqli_query($conn,$qry);

if ($r->num_rows > 0) 
{
   echo "1";
} 
else 
{
		echo "0";
}

?>