<?php
include('../head.html');
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:../index.php');

}

$email=$_SESSION["email"];

?>


<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><?php echo $_SESSION['name']; ?></a>
          </div>
            <ul class="navbar-nav mr-auto">
                <li  class="nav-item "><a class="nav-link"  href="index.php">Home</a></li>
                <li  class="nav-item"><a class="nav-link"  href="stock.php">Stock</a></li>
                <li class="nav-item "><a class="nav-link"  href="Customers.php">Customer</a></li>
                <li class="nav-item "><a class="nav-link" href="Prescriptions.php">Prescriptions</a></li>
            <li class=" nav-item "><a class="nav-link"  href="order.php">Order</a></li>
             <li class=" nav-item active "><a class="nav-link"  href="#">Purchases</a></li>
           
            </ul>

            <button  type="button" class="btn btn-danger navbar-btn pull-right" data-toggle="modal" data-target="#myModal">Logout</button> 
          </div>
  </nav>
  
  
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Logout Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you surely want to logout?.</p>
      </div>
      <div class="modal-footer">
       <a href="../logout.php"> <button type="button" class="btn btn-default" >Confirm</button></a>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>  


<div id="orders">
	<table style="padding: 5px margin:5px" class="table table-stripped table-bordered" id="bill">
    <thead class="table-dark">
      <tr>

        <th>Sl No</th>
        <th>Supplier Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Date</th>
        <th></th>
        <th></th>
        
        
        
        
      </tr>
    </thead>

    <tbody id="bdy">

      <?php

      $qry="SELECT u.name ,u.user_id, u.address, u.contact_no ,o.date ,o.order_id,o.confirmed , o.processed from users u , orders o where u.user_id=o.supplier_id and o.shop_id='$email'";



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

       <td><?php  
      if($p['processed']=='1')
       	{
    	   if($p['confirmed']=='0')
	     	  {
	     	  	?>
	     	  	<a href="ajaxphp/confirmOrderPurchase.php?order_id=<?php echo($p['order_id']); ?>">

              <button class="btn btn-sm btn-primary text-center indigo" id="<?php echo($p['order_id']); ?>" onclick="confirmOrderPurchase(this)" >Confirm Order</button>

            </a>
	     	  	<?php

       		} 
       		else { 

       		 echo "Completed" ;
       		}       	} 
       	else { 
       		echo "Pending";
       		 } ?>


	</td>

      </tr>





     <?php    
        $var=$var+1;
      }
    }
  ?>



   


      

  </tbody>


</table>  

  
</div>

 <div id="items_modal">
  
</div>


 </body>

 <script type="text/javascript">
 	
function showItems(obj){
 var id=obj.id;

   jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/showItemsModal.php",
                data: {'order_id':id,
                'flag':'0'

                        },
               
                success: function(response)
                {
                 //alert(response);
                 document.getElementById("items_modal").innerHTML=response;
                 //jQuery('#bill_contain').html(response);
                 jQuery('#items_modal > #ab').modal();
                     
                }
            });

}

	
/*function confirmOrderPurchase(obj){
 var id=obj.id;

   jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/confirmOrderPurchase.php",
                data: {'order_id':id

                        },
               
                success: function(response)
                {

                }
            });

}*/
 </script>