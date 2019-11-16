
<?php
require('../../connect.php');
session_start();

$email=$_SESSION['email'];
$req = mysqli_real_escape_string($conn, $_POST["query"]);

//	$req = "m";

#$qry = "SELECT * FROM medicine WHERE name LIKE '%".$req."%'";
$qry = "SELECT distinct m.name  FROM medicine m";


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



