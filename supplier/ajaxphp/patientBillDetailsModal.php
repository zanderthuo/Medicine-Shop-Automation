<?php

require_once("../../connect.php");
session_start();

/*if(!isset($_SESSION['email'])){
	header("Location:../../index.php")
}*/

$shop_id=$_SESSION['email'];
$patient_id=$_POST['patient_id'];

$patient_name=$_POST['patient_name'];




?>
<div id="ab" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"><?php echo $patient_name; ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

      	<table class="table table-stripped table-bordered" id="myTable">
    		<thead class="table-dark">
      			<tr>
       				<th>Date</th>
        			<th>Total</th>
        			<th>Paid</th>
        			<th></th>
        			
       			</tr>
    		</thead>
   			<tbody id="tbody">

<?php


$qry="SELECT * FROM `bill` WHERE shop_id='$shop_id' AND patient_id='$patient_id' order by date desc";

$r=mysqli_query($conn,$qry);

if(mysqli_num_rows($r) > 0)
{
 while($row = mysqli_fetch_assoc($r))
 {
 	  ?>
        <tr>
        <td><?php echo $row['date'] ?></td>    
        <td><?php echo $row['total'] ?></td>
        <td><?php echo $row['paid'] ?></td>
        <td>
            <a href="viewBill.php?bill_id=<?php echo $row['bill_id'] ?>"><button type="button" class="btn btn-primary navbar-btn pull-right" >View Bill</button> 
          </td>

      </tr>
    <?php
 }
}
?>


		  </tbody>
  		  </table>

    </div>
      
    </div>

  </div>
</div>


