<?php
require('../../connect.php');
session_start();
$id = $_POST['id'];
if(!isset($_GET['bill_id'])){

$bill_id=$_SESSION['bill_id'];

}
else{

$bill_id=$_GET['bill_id'];

}

$qry = "delete from bill_medicine where id='$id'";

$r = mysqli_query($conn, $qry);
?>

