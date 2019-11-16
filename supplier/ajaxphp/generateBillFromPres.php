<?php
include('../../head.html');
require_once("../../connect.php");
session_start();

if(!isset($_SESSION['email'])){
	header("Location:../../index.php");
}

$shop_id=$_SESSION['email'];
$pres_id=$_GET['pres_id'];

$qry = "select * from prescriptions where shop_id='$shop_id' and pres_id='$pres_id' and processed='1' ";
$t=mysqli_query($conn,$qry);

if ($t->num_rows == 0) 
{
 
  header("Location:../../index.php");	
  die("");
}

$r=mysqli_fetch_assoc($t);




	//insert a bill
 	$qry="INSERT INTO `bill` (`bill_id`, `shop_id`, `patient_id`, `date`, `total`, `paid`, `processed`) VALUES (NULL, '".$shop_id."', '".$r['patient_id']."', '".date("Y-m-d")."', '', '', '0');";

  	if (mysqli_query($conn, $qry)) {
    	$bill_id = mysqli_insert_id($conn);
    	
  	} 
  	
  	//insert into bill each product from pres

  	$qry="Select p.product_id,p.quantity, SUM(s.quantity) as available from pres_meds p,stock s where pres_id='$pres_id' and s.shop_id='$shop_id' and s.product_id=p.product_id";


  	$t=mysqli_query($conn,$qry);

	while ($p=mysqli_fetch_assoc($t)) 
	{
		if($p['quantity']<=$p['available'])
		{

			$qry="select batch_no , quantity from stock  where shop_id='$shop_id' and product_id='".$p['product_id']."' order by batch_no";


			$x=mysqli_query($conn,$qry);

			while ($y=mysqli_fetch_assoc($x)) {
				if($p['quantity']<=0)
					break;

				 if($p['quantity']>$y['quantity']){

				 	$q="INSERT INTO `bill_medicine` (`id`, `bill_id`, `product_id`, `batch_no`, `qty`) VALUES (NULL, '$bill_id', '".$p['product_id']."', '".$y['batch_no']."', '".$y['quantity']."');";

				 	$f=mysqli_query($conn,$q);

				 	$p['quantity']=$p['quantity']-$y['quantity'];
				 }
				 else{
				 	$q="INSERT INTO `bill_medicine` (`id`, `bill_id`, `product_id`, `batch_no`, `qty`) VALUES (NULL, '$bill_id', '".$p['product_id']."', '".$y['batch_no']."', '".$p['quantity']."');";

				 	$f=mysqli_query($conn,$q);

				 	$p['quantity']=0;
				 	
				 }		

			}

		}
	}

	$qry="update  prescriptions set bill_id='$bill_id' where pres_id='$pres_id'";
	$t=mysqli_query($conn,$qry);


	header("Location:../ShowPresBill.php?pres_id=".$pres_id);

?>