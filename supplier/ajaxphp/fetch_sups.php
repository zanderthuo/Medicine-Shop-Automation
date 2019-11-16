<?php
require('../../connect.php');
$req = mysqli_real_escape_string($conn, $_POST["query"]);

$qry = "SELECT * FROM users WHERE name LIKE '%".$req."%' and type=4";

$r = mysqli_query($conn, $qry);

$data = array();

if(mysqli_num_rows($r) > 0)
{
 while($row = mysqli_fetch_assoc($r))
 {
  $data[] = $row["name"];
 }
 echo json_encode($data);
}

?>

