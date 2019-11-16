<?php
require('../../connect.php');
session_start();


$pres_id = $_SESSION['pres_id'];
unset($_SESSION['pres_id']);


$qry = "delete from prescriptions where pres_id='$pres_id'";
$r = mysqli_query($conn, $qry);

$qry = "delete from pres_meds where pres_id='$prs_id'";
$r = mysqli_query($conn, $qry);

header("Location:../index.php");

?>

