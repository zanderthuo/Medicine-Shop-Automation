<?php
require('../../connect.php');
session_start();
$shop_id = $_POST['shop_id'];
$pres_id=$_SESSION['pres_id'];


$qry = "update  prescriptions set shop_id='$shop_id' where pres_id='$pres_id'";

$r = mysqli_query($conn, $qry);
//echo $shop_id;

?>

