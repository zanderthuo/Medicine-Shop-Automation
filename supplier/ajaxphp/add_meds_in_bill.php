<?php
require('../../connect.php');
session_start();
$product_id = $_POST['product_id'];
$batch_no=$_POST['batch_no'];

$qty=$_POST['qty'];

$bill_id=$_SESSION['bill_id'];

$qry = "INSERT INTO `bill_medicine` (`id`, `bill_id`, `product_id`, `batch_no`, `qty`) VALUES (NULL, '$bill_id', '$product_id', '$batch_no', '$qty');";

$r = mysqli_query($conn, $qry);

?>

