<?php
require('../../connect.php');
session_start();
$pres_id=$_SESSION['pres_id'];


$qry="update prescriptions set processed='1' where pres_id='$pres_id'";

$r = mysqli_query($conn, $qry);



unset($_SESSION['pres_id']);
header("Location:../index.php");

?>

