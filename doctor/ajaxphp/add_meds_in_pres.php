<?php
require('../../connect.php');
session_start();

$product_id = $_POST['product_id'];
$qty=$_POST['qty'];
$pres_id=$_SESSION['pres_id'];


$qry="select quantity from pres_meds where product_id='$product_id' and pres_id='$pres_id' ";
$r = mysqli_query($conn, $qry);
if(mysqli_num_rows($r)>0){
  
  $p=mysqli_fetch_assoc($r);
  $qty=(int)$qty+(int)$p['quantity'];

$qry="update pres_meds set quantity='$qty' where product_id='$product_id' and pres_id='$pres_id'";
$r = mysqli_query($conn, $qry);
}
else{

$qry = "INSERT INTO `pres_meds` (`pres_id`, `product_id`, `quantity`) VALUES ('$pres_id', '$product_id', '$qty');";

$r = mysqli_query($conn, $qry);

}




?>

