<?php
require('../../connect.php');
$req = mysqli_real_escape_string($conn, $_POST["query"]);

$qry = "SELECT user_id,name,address,contact_no FROM users WHERE name LIKE '%".$req."%' and type='2'";

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

