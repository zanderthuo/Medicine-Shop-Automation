<?php
require('../../connect.php');
session_start();
$date = $_POST['date'];
$pres_id=$_SESSION['pres_id'];


$qry = "update  prescriptions set date='$date' where pres_id='$pres_id'";

$r = mysqli_query($conn, $qry);

?>

