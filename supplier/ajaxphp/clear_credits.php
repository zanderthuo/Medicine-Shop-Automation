<?php

require_once("../../connect.php");
session_start();

if(!isset($_SESSION['email'])){
	die("error");
}


$pid=$_POST['patient_id'];
$email=$_SESSION['email'];


$qry="update bill set paid=total where `patient_id`='$pid' and shop_id='$email' ";
$r=mysqli_query($conn,$qry);

?>