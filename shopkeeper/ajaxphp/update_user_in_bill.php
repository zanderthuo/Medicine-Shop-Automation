<?php
require('../../connect.php');
session_start();
$user_id = $_POST['user_id'];
$bill_id=$_SESSION['bill_id'];


$qry = "update  bill set patient_id='$user_id' where bill_id='$bill_id'";

$r = mysqli_query($conn, $qry);

?>

