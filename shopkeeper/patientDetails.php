<?php
include('../head.html');
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:/msa/index.php');

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
            <a class="navbar-brand" href="shopowner.php">Shop Name</a>
          </div>
            <ul class="navbar-nav mr-auto">
                <li  class="nav-item"><a class="nav-link"  href="index.php">Home</a></li>
                <li  class="nav-item"><a class="nav-link"  href="stock.php">Stock</a></li>
                <li class="nav-item"><a class="nav-link"  href="customers.php">Customer</a></li>
                <li class="nav-item"><a class="nav-link" href="doctors.php">Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="bills.php">Bills</a></li>
                <li class="nav-item"><a class="nav-link" href="Prescriptions.php">Prescriptions</a></li>
            <li class=" nav-item "><a class="nav-link"  href="order.php">Order</a></li>
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
       <a href="/msa/logout.php"> <button type="button" class="btn btn-default" >Confirm</button></a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>	

  


<table class="table" id="myTable">
    <thead>
      <tr>

        <th>Name</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>Address</th>
        <th>Credit</th>
        <th></th>
        
        
      </tr>
    </thead>
    <tbody>
<?php

$qry="SELECT u.name,p.patient_id,u.contact_no,u.address ,( SUM(p.total)-SUM(p.paid) )as credit from patient p , users u where p.shop_id= '$email' and u.user_id=p.patient_id group by p.patient_id";


$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($p = mysqli_fetch_assoc($r)) {
    
    ?>
          <tr class="active">
        <td><?php echo $p['name'] ?></td>    
        <td><?php echo $p['patient_id'] ?></td>
        <td><?php echo $p['contact_no'] ?></td>
        <td><?php echo $p['address'] ?></td>
          <td><?php echo $p['credit'] ?></td>
          <td><input type="button" id=<?php echo $var;?> class="btn btn-primary pull-right" value="View" >
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
<script type="text/javascript">
  

  function clear_cre(elem) {

    var table=document.getElementById("myTable");
    var rowno=elem.id;

    var email=table.rows[rowno].cells[1].innerHTML;
   

    $.ajax({
                type: 'POST',
                url: 'ajaxphp/clear_credits.php',
                data: {'patient_id':email},
                dataType: 'json',
                success: function(r)
                {
                    if(r=="1")
                    {
                       table.rows[rowno].cells[4].innerHTML=0;
                    }
                }
        
            });
  }


</script>