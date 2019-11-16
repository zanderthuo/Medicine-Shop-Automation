<?php

require_once("../../connect.php");
session_start();

/*if(!isset($_SESSION['email'])){
  header("Location:../../index.php")
}*/

$shop_id=$_SESSION['email'];
$bill_id=$_POST['bill_id'];

echo $bill_id;


$qry="select m.name, b.mfd, b.expd,b.mrp, bm.qty from bill_medicine bm, medicine m,batch b where bm.bill_id='$bill_id' and bm.product_id=m.product_id and b.product_id=bm.product_id and bm.batch_no = b.batch_no";

$r=mysqli_query($conn,$qry);


?>
<div id="ab" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <table class="table table-stripped table-bordered" id="myTable">
        <thead class="table-dark">
            <tr>
              <th>Sl.No</th>
              <th>Name</th>
              <th>Mfd</th>
              <th>Exp</th>
              <th>MRP</th>
              <th>Qty</th>

              <th>Rate</th>
              


              
            </tr>
        </thead>
        <tbody id="tbody">

<?php



$var=1;
$total=0;
if(mysqli_num_rows($r) > 0)
{
 while($row = mysqli_fetch_assoc($r))
 {
    ?>
        <tr>
        <td><?php echo $var;?></td> 
        <td><?php echo $row['name']; ?></td>    
        <td><?php echo $row['mfd']; ?></td>

        <td><?php echo $row['expd'] ;?></td>
    
        <td><?php echo $row['mrp'] ;?></td>
    
        <td><?php echo $row['qty'] ;?></td>
    
        <td><?php echo $row['qty'] *$row['mrp']; $total=$total+$row['qty'] *$row['mrp']; ?></td>



      </tr>
    <?php
    $var=$var+1;
 }

}
?>

  <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>Total</th>

              <th><?php echo $total; ?></th>
              


              
            </tr>

      </tbody>
        </table>
     

    </div>
      
    </div>

  </div>
</div>

</body>

