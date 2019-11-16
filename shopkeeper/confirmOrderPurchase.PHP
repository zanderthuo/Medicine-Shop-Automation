<?php

require_once("../../connect.php");
session_start();

/*if(!isset($_SESSION['email'])){
	header("Location:../../index.php")
}*/

$Shop_id=$_SESSION['email'];
$order_id=$_POST['order_id'];


?>
