<?php 
require('../../connect.php');
@session_start();
if(!isset($_SESSION['email'])){
header('Location:../../index.php');
}

$email=$_SESSION['email'];

?>



<table style="padding: 5px margin:5px" class="table table-stripped table-bordered" id="bill">
    <thead class="table-dark">
      <tr>

        <th>Sl No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Date</th>
        <th></th>
        
        
        
      </tr>
    </thead>

    <tbody id="bdy">

      <?php

      $qry="SELECT u.name ,u.user_id, u.address, u.contact_no ,o.date ,o.order_id from users u , orders o where o.shop_id=u.user_id and o.supplier_id='$email' and o.processed='0'";

      $r=mysqli_query($conn,$qry);
      $var=1;

      if ($r->num_rows > 0) 
      {
   
      
      while($p = mysqli_fetch_assoc($r)) {
    
      ?>

     

         <tr>

        <td><?php echo $var;?></td>
        <td><b><?php echo $p['name']; ?> </b></td>
        
        <td><?php echo $p['user_id']; ?> </td>
        <td><?php echo $p['address']; ?> </td>
        <td><?php echo $p['contact_no']; ?> </td>
        <td><?php echo $p['date']; ?> </td>
        
        <td><button class="btn btn-sm btn-primary text-center indigo" id="<?php echo($p['order_id']); ?>" onclick="showItems(this)" >Details</button></td>

      </tr>


     <?php    
        $var=$var+1;
      }
    }
  ?>



   


      

  </tbody>


</table>  


