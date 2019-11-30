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
            <a class="navbar-brand" href="index.php"><b>MSA</b></a>
          </div>
            <ul class="navbar-nav mr-auto">
                <li class=" nav-item" ><a class="nav-link" href="index.php">Purchases</a></li>
                <li class="nav-item"><a class="nav-link" href="presDetails.php">Prescription</a></li>
                <li class="nav-item active"><a class="nav-link" href="#">Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="credits.php">Credits</a></li>
          
            </ul>

             <button  type="button" class="btn btn-danger navbar-btn pull-right" data-toggle="modal" data-target="#myModal">Logout</button> 
          </div>
  </nav>
  
	
<div id="myModal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog" role="document">

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

        <th>Name</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>Address</th>
        <th>Date</th>

		<th></th>
        
        
        
      </tr>
    </thead>
    <tbody>
<?php

$qry="SELECT u.name,p.doctor_id,p.pres_id,u.contact_no,u.address ,p.date from prescriptions p , users u where p.patient_id= '$email' and u.user_id=p.doctor_id";


$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($p = mysqli_fetch_assoc($r)) {
    
    ?>
          <tr class="active">
        <td><?php echo $p['name'] ?></td>    
        <td><?php echo $p['doctor_id'] ?></td>
        <td><?php echo $p['contact_no'] ?></td>
        <td><?php echo $p['address'] ?></td>
          <td><?php echo $p['date'] ?></td>
          <td><button type="button" id="<?php echo $p['pres_id']; ?>" class="btn btn-sm btn-primary pull-right" value="View"onclick="showPresModal(this)">View</button>
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


<div id="bill_contain">


  
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
function showBillModal(obj) {

          var id=obj.id;
        
            jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/patientBillDetailsModal.php",
                data: {'bill_id':id

                        },
               
                success: function(response)
                {
                 //alert(response);
                 document.getElementById("bill_contain").innerHTML=response;
                 //jQuery('#bill_contain').html(response);
                 
                 jQuery('#pres_contain > #ab').modal('toggle');
                 jQuery('#bill_contain > #ab').modal();
                     
                }
            });




}


</script>