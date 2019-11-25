<?php 
require_once 'connect.php';
session_start();
$name=$_POST["name"];
$password=$_POST["password"];
$email=$_POST["email"];
$address=$_POST["address"];
$contact=$_POST["contact"];
$usertype=(int)$_POST["usertype"];
$date=date("Y/m/d");
echo $usertype;

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'Med');

//$qry="insert into users values('','".$email."','".$password."','".$name."',".$usertype.",'".$address."','".$contact."','".$date."')";


$qry="INSERT INTO `users` VALUES (NULL, '".$email."', '".$password."', '".$name."', '".$usertype."', '".$address."', '".$contact."', '".$date."')";
//echo $qry;

if (mysqli_query($conn,$qry))
{
	//echo "data  inserted successfully";
	$t=$usertype;
	$_SESSION['email']=$email;
	$_SESSION['usertype']=$t;
	$_SESSION['name']=$name;
	$page=null;
	

	header("Location:check_session.php");
	exit;


	}

else
{
	echo "error occured";
}

?>