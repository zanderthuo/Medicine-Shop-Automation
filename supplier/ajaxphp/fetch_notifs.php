<?php
require('../../connect.php');
session_start();


$supplier_id=$_SESSION['email'];

$qry = "select count(order_id) as cnt from orders WHERE supplier_id='$supplier_id' and processed='0' and seen='0' ";

$cnt=0;
$r = mysqli_query($conn, $qry);
if(@mysqli_num_rows($r) > 0)
{

$p=mysqli_fetch_assoc($r);
$cnt=$p['cnt'];

}
if($cnt>0)
{
	echo $cnt;
}

?>

