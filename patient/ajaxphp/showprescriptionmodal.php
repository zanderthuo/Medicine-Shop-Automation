<?php

require_once("../../connect.php");
session_start();

/*if(!isset($_SESSION['email'])){
	header("Location:../../index.php")
}*/

$shop_id=$_SESSION['email'];
$pres_id=$_POST['pres_id'];
$qry="select u.name,p.processed,p.bill_id from users u , prescriptions p where p.patient_id=u.user_id and p.pres_id='$pres_id'";
$t=mysqli_query($conn,$qry);
$rt=mysqli_fetch_assoc($t);


?>
<div id="ab" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"><?php echo $rt['name']; ?></h4>
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


$qry="SELECT * FROM pres_meds p,medicine m WHERE p.pres_id='$pres_id' and p.product_id=m.product_id ";

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
      <?php
        $processed=$rt['processed'];
        if ($processed=='1')
       {?>
     <button id="<?php echo $rt['bill_id']; ?>" class="btn btn-primary" onclick="showBillModal(this)" >View Bill</button>

       <?php }   


      ?>

    </div>
      
    </div>

  </div>
</div>

</body>

