<?php

require_once("../../connect.php");
session_start();

/*if(!isset($_SESSION['email'])){
	header("Location:../../index.php")
}*/

$shop_id=$_SESSION['email'];
$pres_id=$_POST['pres_id'];





?>
<div id="ab" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"><?php echo "Test"; ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

      	<table class="table table-stripped table-bordered" id="myTable">
    		<thead class="table-dark">
      			<tr>
       				<th>Sl.No</th>
        			<th>Name</th>
        			<th>Quantity</th>
        			
       			</tr>
    		</thead>
   			<tbody id="tbody">

<?php


$qry="SELECT m.name,p.quantity FROM pres_meds p,medicine m WHERE p.pres_id='$pres_id' and p.product_id=m.product_id ";

$r=mysqli_query($conn,$qry);
$var=1;
if(mysqli_num_rows($r) > 0)
{
 while($row = mysqli_fetch_assoc($r))
 {
 	  ?>
        <tr>
        <td><?php echo $var;?></td> 
        <td><?php echo $row['name'] ?></td>    
        <td><?php echo $row['quantity'] ?></td>
      </tr>
    <?php
    $var=$var+1;
 }

}
?>


		  </tbody>
  		  </table>
<a href="ajaxphp/generateBillFromPres.php?pres_id=<?php echo $pres_id; ?>"><button class="btn btn-primary text-center" onclick="processpres()">Forward</button>
    </div>
      
    </div>

  </div>
</div>



