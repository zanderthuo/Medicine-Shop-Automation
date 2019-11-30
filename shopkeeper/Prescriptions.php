<?php
include('../head.html');
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:../index.php');
}
$email=$_SESSION["email"]; 


$qry="update  Prescriptions set seen='1' where Shop_id='$email'";
$t=mysqli_query($conn,$qry);


if(isset($_GET['msg'])){
  ?>
  <script type="text/javascript">
    alert("Product Does not exist");
  </script>

  <?php
}

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
                <li  class="nav-item"><a class="nav-link"  href="index.php">Home</a></li>
                <li  class="nav-item"><a class="nav-link"  href="stock.php">Stock</a></li>
                <li class="nav-item"><a class="nav-link"  href="customers.php">Customer</a></li>
                <li class="nav-item active"><a class="nav-link" href="#">Prescriptions</a></li>
            <li class=" nav-item "><a class="nav-link"  href="order.php">Order</a></li>
             <li class=" nav-item "><a class="nav-link"  href="purchases.php">Purchases</a></li>
           
            </ul>

            <button  type="button" class="btn btn-danger navbar-btn pull-right" data-toggle="modal" data-target="#myModal">Logout</button> 
          </div>
  </nav>
	
	
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
     <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <h4 class="modal-title">Logout Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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


<table class="table table-stripped table-bordered" id="myTable">
    <thead class="table-dark">
      <tr>

		<th>SL.NO</th>
        
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Doctors name</th>
        <th>Date</th>
        <th></th>
        
      </tr>
    </thead>
    <tbody id="tbody">
<?php

$qry="SELECT  p.pres_id, u.name as p_name ,u.user_id,u.address,v.name as d_name,p.date from Prescriptions p,users u,users v where p.Shop_id='$email' and p.processed='1'  and p.patient_id=u.user_id and p.doctor_id=v.user_id and p.bought='0'";





$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($p = mysqli_fetch_assoc($r)) {
    
    ?>
        <tr>
        <td><?php echo $var; ?></td>    
        
        <td><?php echo $p['p_name']; ?></td>    
        <td><?php echo $p['user_id'] ?></td>
        <td><?php echo $p['address'] ?></td>
        <td><?php echo $p['d_name'] ?></td>
          <td><?php echo $p['date'] ?></td>
          
          <td>
            <button id="<?php echo $p['pres_id']; ?>"  type="button" class="btn btn-sm btn-primary navbar-btn pull-right"  onClick="showPresModal(this)">Details</button>
          </td>
      </tr>




    <?php
    $var=$var+1;
    }

 
  } 


?>


    </tbody>
  </table>

<div id="pres_contain">


  
</div>  
</body>


<script type="text/javascript">
  

function showPresModal(obj) {

          var id=obj.id;
        
            jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/showprescriptionmodal.php",
                data: {'pres_id':id

                        },
               
                success: function(response)
                {
                 //alert(response);
                 document.getElementById("pres_contain").innerHTML=response;
                 //jQuery('#bill_contain').html(response);
                 jQuery('#pres_contain > #ab').modal();
                     
                }
            });




}

</script>