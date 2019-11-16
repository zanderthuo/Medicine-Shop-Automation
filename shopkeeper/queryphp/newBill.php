<?php
require('../../connect.php');
session_start();


$bill_id = $_SESSION['bill_id'];
unset($_SESSION['bill_id']);



$qry = "delete from bill where bill_id='$bill_id'";
$r = mysqli_query($conn, $qry);

$qry = "delete from bill_medicine where bill_id='$bill_id'";
$r = mysqli_query($conn, $qry);

header("Location:../index.php");

?>

