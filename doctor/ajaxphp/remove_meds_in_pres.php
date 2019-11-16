<?php
require('../../connect.php');
session_start();
$id = $_POST['id'];


$qry = "delete from pres_meds where id='$id'";

$r = mysqli_query($conn, $qry);
?>

