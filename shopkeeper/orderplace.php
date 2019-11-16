<?php
require('../connect.php');
session_start();
$email=$_SESSION['email'];
$data =$_POST["query"];

$dt=json_decode($data);

$su=$dt->sup;
$st=$dt->status;
$t=-1;
$qry="INSERT INTO `orders` (`order_id`, `shop_id`, `supplier_id`, `seen`, `processed`, `confirmed`, `date`) VALUES (NULL, '$email', '$su', '0', '0', '0', '".date("Y-m-d")."');";


if(mysqli_query($conn,$qry))
{
	$last_id=mysqli_insert_id($conn);
	$med=$dt->meds;
	$md=json_decode($med);
	for($i=0;$i<sizeof($md);$i++)
	{
		$pi=$md[$i]->pid;
		$qt=$md[$i]->qty;
		$qr2="INSERT INTO `ordered_medicine` VALUES (NULL, '".$last_id."', '".$pi."', '".$qt."')";
		
		mysqli_query($conn,$qr2);
	}
	echo "success"; 
}
else
{
	echo  "failed";
}



?>

