<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['usertype']);
// recommended solution for recent PHP versions
// $bill_id = $_SESSION['bill_id'] ?? '';

// pre-7 PHP versions
$bill_id = '';
if (!empty($_SESSION['bill_id'])) {
     $bill_id = $_SESSION['bill_id'];
}

// recommended solution for recent PHP versions
// $bill_id = $_SESSION['bill_id'] ?? '';

// pre-7 PHP versions
$pres_id = '';
if (!empty($_SESSION['pres_id'])) {
     $pres_id = $_SESSION['pres_id'];
}

// if(isset($_SESSION['pres_id'])){
// 	unset($_SESSION['pres_id']);
// }

header('location:Index.php');
exit;


?>