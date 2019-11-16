<?php
require('../../connect.php');
session_start();
$product_id = $_POST['product_id'];
$batch_no=$_POST['batch_no'];

$qty=$_POST['qty'];

$bill_id=$_SESSION['bill_id'];


$qry="select qty from bill_medicine where product_id='$product_id' and bill_id='$bill_id' and batch_no='$batch_no'";

$r = mysqli_query($conn, $qry);
if(mysqli_num_rows($r)>0){
  
  $p=mysqli_fetch_assoc($r);
  $qty=(int)$qty+(int)$p['qty'];

$qry="update bill_medicine set qty='$qty' where product_id='$product_id' and bill_id='$bill_id' and batch_no='$batch_no'";
$r = mysqli_query($conn, $qry);
}
else{

$qry = "INSERT INTO `bill_medicine` (`id`, `bill_id`, `product_id`, `batch_no`, `qty`) VALUES (NULL, '$bill_id', '$product_id', '$batch_no', '$qty');";

$r = mysqli_query($conn, $qry);

}


?>

