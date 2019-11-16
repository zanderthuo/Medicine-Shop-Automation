<?php
require('../../connect.php');
session_start();
$user_id = $_POST['user_id'];
$pres_id=$_SESSION['pres_id'];


$qry = "update  prescriptions set patient_id='$user_id' where pres_id='$pres_id'";

$r = mysqli_query($conn, $qry);

?>

