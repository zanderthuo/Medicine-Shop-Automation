<?php 
require('../connect.php');
@session_start();
if(!isset($_SESSION['email'])){
header('Location:/msa/index.php');
}

// recommended solution for recent PHP versions
$bill_id = $_SESSION['bill_id'] ?? '';

// pre-7 PHP versions
$bill_id = '';
if (!empty($_SESSION['bill_id'])) {
     $bill_id = $_SESSION['bill_id'];
}


// $email=$_SESSION['email'];

// if(!isset($_GET['bill_id'])){

// $bill_id=$_SESSION['bill_id'];

// }
// else{

// $bill_id=$_GET['bill_id'];

// }

?>



<table style="padding: 5px margin:10px" class="table  table-bordered table-stripped" id="bill">
    <thead class="table-dark">
      <tr>

        <th>Sl No</th>
        <th>Name</th>
        <th>Batch</th>
        <th>MFD</th>
        <th>Expd</th>
        <th>MRP</th>
        <th>Quantity</th>
        <th>Rate</th>
        <th></th>
        
        
        
      </tr>
    </thead>

    <tbody id="bdy">

      <?php

      $qry="select B.id,M.name,BA.* , B.qty from bill_medicine B, batch BA, medicine M where B.bill_id='$bill_id' and B.product_id=M.product_id and B.product_id=BA.product_id and B.batch_no=BA.batch_no";

      $r=mysqli_query($conn,$qry);
      $var=1;
      $total=0;

      if ($r->num_rows > 0) 
      {
   
      
      while($p = mysqli_fetch_assoc($r)) {
    
      ?>

     

         <tr>

        <td><?php echo $var;?></td>
        <td><b><?php echo $p['name']; ?> </b></td>
        
        <td><?php echo $p['batch_no']; ?> </td>
        <td><?php echo $p['mfd']; ?> </td>
        <td><?php echo $p['expd']; ?> </td>
        <td><?php echo $p['mrp']; ?> </td>
        <td><?php echo $p['qty']; ?> </td>

        <td><?php echo $p['qty']*$p['mrp']; $total=$total+$p['qty']*$p['mrp'] ;?> </td>
        
        
        <td><button  id="<?php echo($p['id']); ?>" class="remove btn btn-danger btn-sm">X</button></td>

      </tr>


     <?php    
        $var=$var+1;
      }
    }
  ?>



         <tr>

        
        <td></td>
        <td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>Total</td>
<td id="total"><?php echo $total; ?></td>
<td></td>




      </tr>

        <tr>

        
        <td></td>
        <td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>Pay</td>
<td><input id="paid" type="" name="" class="col-md-3" value="" placeholder=""></td>
<td><button class="btn btn-sm btn-primary" onclick="billPay()"> GO </button></td>




      </tr>


      

  </tbody>


</table>  


