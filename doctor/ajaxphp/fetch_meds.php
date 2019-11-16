
<?php
require('../../connect.php');
session_start();

$email=$_SESSION['email'];
$req = mysqli_real_escape_string($conn, $_POST["query"]);

//	$req = "m";

$qry = "SELECT * FROM medicine WHERE name LIKE '%".$req."%'";
#$qry = "SELECT s.product_id,m.name,s.quantity,b.mfd,b.expd,b.mrp,b.batch_no  FROM medicine m,stock s,batch b  WHERE m.name LIKE '%".$req."%' and s.shop_id='$email' and  m.product_id = s.product_id  and  s.product_id=b.product_id and  s.batch_no = b.batch_no ";


$r = mysqli_query($conn, $qry);

$data = array();

if(mysqli_num_rows($r) > 0)
{
 while($row = mysqli_fetch_assoc($r))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}

?>



