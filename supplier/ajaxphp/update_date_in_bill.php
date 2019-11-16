<?php
require('../../connect.php');
session_start();
$date = $_POST['date'];
$bill_id=$_SESSION['bill_id'];


$qry = "update  bill set date='$date' where bill_id='$bill_id'";

$r = mysqli_query($conn, $qry);

?>

