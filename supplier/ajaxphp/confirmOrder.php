<?php
require('../../connect.php');
session_start();
$email = $_SESSION['email'];


$order_id = $_POST['order_id'];


$qry="update orders set processed='1' where supplier_id='$email' and order_id='$order_id'";
mysqli_query($conn,$qry);

?>

