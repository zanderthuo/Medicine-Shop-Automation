<?php
require('../../connect.php');
session_start();

$name=$_POST['name'];
$mfd=$_POST['mfd'];
$expd=$_POST['expd'];
$mrp=$_POST['mrp'];

$qry="select b.batch_no,m.product_id from batch b,medicine m where b.product_id=m.product_id  and m.name='$name' order by b.batch_no desc limit 1";

$t=mysqli_query($conn,$qry);

if(mysqli_num_rows($t)>0){
$p=mysqli_fetch_assoc($t);
	$batch=$p['batch_no']+1;
	$product_id=$p['product_id'];


}
else{
$batch=1;	

  $qry="INSERT INTO medicine VALUES('','$name')";

  if (mysqli_query($conn, $qry)) {
    $product_id = mysqli_insert_id($conn);
  }
}


	$q="INSERT INTO `batch` (`product_id`, `batch_no`, `mfd`, `expd`, `mrp`) VALUES ('$product_id', '$batch', '$mfd', '$expd', '$mrp');";

	$p=mysqli_query($conn,$q);

?>

