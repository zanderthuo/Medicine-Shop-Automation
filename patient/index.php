<?php
include('../head.html');
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:../Index.php');

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
            <a class="navbar-brand" href="#"><b>MSA</b></a>
          </div>
    				<ul class="navbar-nav mr-auto">
      					<li class=" nav-item active" ><a class="nav-link" href="#">Purchases</a></li>
      					<li class="nav-item"><a class="nav-link" href="doctors.php">Doctors</a></li>
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
<br>

<input class="form-control mx-auto w-50 text-center" id="myInput" type="text" placeholder="Search..">
  <br>
  
  <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<table class="table table-stripped table-bordered" id="myTable">
    <thead class="table-dark">
      <tr>

        <th>Name</th>
        <th>Contact No</th>
        <th>Address</th>
        <th>Date</th>
		<th>Total</th>
		<th>Paid</th>
        <th></th>
        
        
      </tr>
    </thead>
    <tbody>
<?php

$qry="SELECT b.bill_id,u.name,u.contact_no,u.address ,b.date,b.total,b.paid from bill b , users u where b.patient_id= '$email' and u.user_id=b.shop_id";


$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($p = mysqli_fetch_assoc($r)) {
    
    ?>
          <tr class="active">
        <td><?php echo $p['name'] ?></td>    
      
        <td><?php echo $p['contact_no'] ?></td>
        <td><?php echo $p['address'] ?></td>
          <td><?php echo $p['date'] ?></td>
		    <td><?php echo $p['total'] ?></td>
			  <td><?php echo $p['paid'] ?></td>
          <td><button type="button" id="<?php echo $p['bill_id']; ?>" class="btn btn-sm btn-primary pull-right" value="View"onclick="showBillModal(this)">View</button>
          </td>
      

      </tr>




    <?php
    $var=$var+1;
  }

} 


?>



    </tbody>
  </table>

  <div id="bill_contain"></div>


</body>

<script type="text/javascript">
  

function showBillModal(obj) {

          var id=obj.id;
        
            jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/patientBillDetailsModal.php",
                data: {'bill_id':id},
               
                success: function(response)
                {
                 //alert(response);
                 document.getElementById("bill_contain").innerHTML=response;
                 //jQuery('#bill_contain').html(response);
                 
                 jQuery('#bill_contain > #ab').modal();
                     
                }
            });

          }



</script>
