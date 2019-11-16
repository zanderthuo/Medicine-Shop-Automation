<?php
require('../connect.php');
$req = mysqli_real_escape_string($conn, $_POST["query"]);

$qry = "SELECT * FROM medicine WHERE name LIKE '%".$req."%'";

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

