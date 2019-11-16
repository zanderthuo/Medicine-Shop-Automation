<?php
require_once 'connect.php';
session_start();
$password=$_POST["password"];
$email=$_POST["email"];


//$qry="insert into users values('','".$email."','".$password."','".$name."',".$usertype.",'".$address."','".$contact."','".$date."')";


$qry="SELECT * from `users` where `user_id`= '".$email."' and `password`= '".$password."'";
//echo $qry;
$r=mysqli_query($conn,$qry);

if ($r->num_rows > 0) 
{
    while($row = $r->fetch_assoc())
		{

			$t=$row["type"];
			$_SESSION['email']=$row["user_id"];
			$_SESSION['usertype']=$t;
			$_SESSION['name']=$row["name"];

			header("Location:check_session.php");
			exit;


		}
} 
else 
{
		$_SESSION['error'] = 'Your username or password was incorrect.';
		header("Location: Index.php"); 
		exit;
}

?>