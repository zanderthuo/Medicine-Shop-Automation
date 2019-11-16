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
                <li class=" nav-item " ><a class="nav-link" href="index.php">Purchases</a></li>
                <li class="nav-item"><a class="nav-link" href="doctors.php">Doctors</a></li>
                <li class="nav-item active"><a class="nav-link" href="#">Credits</a></li>
          
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
        <th>Credit</th>
        
        
        
      </tr>
    </thead>
    <tbody>
<?php

$qry="SELECT u.name,b.shop_id,u.contact_no,u.address ,( SUM(b.total)-SUM(b.paid) )as credit from bill b, users u where b.patient_id= '$email'  and u.user_id=b.shop_id group by b.shop_id";



$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($z = mysqli_fetch_assoc($r)) {
    
    ?>
          <tr class="active">
        <td><?php echo $z['name'] ?></td>    
        <td><?php echo $z['shop_id'] ?></td>
        <td><?php echo $z['contact_no'] ?></td>
        <td><?php echo $z['address'] ?></td>
          <td><?php echo $z['credit'] ?></td>
      
          </td>
      

      </tr>




    <?php
    $var=$var+1;
  }

} 


?>



    </tbody>
  </table>


</body>
