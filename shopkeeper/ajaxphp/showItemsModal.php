<?php

require_once("../../connect.php");
session_start();

/*if(!isset($_SESSION['email'])){
	header("Location:../../index.php")
}*/

$supplier_id=$_SESSION['email'];
$order_id=$_POST['order_id'];
$flag=$_POST['flag'];


$qry="select name from users u, orders o where o.order_id='$order_id' and o.supplier_id=u.user_id";
$t=mysqli_query($conn,$qry);
$sups=mysqli_fetch_assoc($t);


?>
<div id="ab" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"><?php echo $sups['name']; ?></h4>
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


$qry="SELECT m.name,o.qty FROM ordered_medicine o,medicine m WHERE o.order_id='$order_id' and o.product_id=m.product_id ";


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
        <td><?php echo $row['qty'] ?></td>
      </tr>
    <?php
    $var=$var+1;
 }

}
?>


		  </tbody>

      <?php 

      if($flag=='1'){
        ?>
            </table><button class="btn btn-primary text-center" onclick="confirm(this)" id="<?php echo $order_id; ?>">Confirm</button>
 
 
        <?php

      }

        

      ?>
    </div>
      
    </div>

  </div>
</div>



