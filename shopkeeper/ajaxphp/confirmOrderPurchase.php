<?php
require('../../connect.php');
session_start();

$email=$_SESSION['email'];
$order_id=$_GET['order_id'];

//chack if order_id matches
$qry="select *  from orders where order_id='$order_id' and shop_id='$email'";
$t=mysqli_query($conn,$qry);
if(mysqli_num_rows($t)==0){
	header("Location:../purchases.php");
}

$qry="select * from ordered_medicine where order_id='$order_id' ";
$t=mysqli_query($conn,$qry);

while ($p=mysqli_fetch_assoc($t)) {
	$product_id=$p['product_id'];
	$qty=$p['qty'];


	$qry="select batch_no from batch where product_id='$product_id' order by batch_no desc limit 1 ";
	$s=mysqli_query($conn,$qry);
	$batch_no=mysqli_fetch_assoc($s)['batch_no'];

	$qry="select quantity from stock where product_id='$product_id' and shop_id='$email' and batch_no='$batch_no' ";


	$r = mysqli_query($conn, $qry);
	if(mysqli_num_rows($r)>0){

	  $p=mysqli_fetch_assoc($r);
	  $qty=(int)$qty+(int)$p['quantity'];

	$qry="update stock set quantity='$qty' where product_id='$product_id' and shop_id='$email' and batch_no='$batch_no' ";
	$r = mysqli_query($conn, $qry);
	}
	else{

	$qry = "INSERT INTO `stock` (`shop_id`, `product_id`, `batch_no`, `quantity`) VALUES ('$email', '$product_id', '$batch_no', '$qty');";


	$r = mysqli_query($conn, $qry);
	
	}


}
	$qry = "update orders set confirmed='1' where order_id='$order_id'";


	$r = mysqli_query($conn, $qry);
header("Location:../stock.php");

?>

