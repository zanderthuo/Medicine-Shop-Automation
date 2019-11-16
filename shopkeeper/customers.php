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
                <li class="nav-item active"><a class="nav-link"  href="#">Customer</a></li>
                <li class="nav-item"><a class="nav-link" href="Prescriptions.php">Prescriptions</a></li>
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
 

  <div id="password_confirm" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" >Enter Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <label id="msg"></label>

        <input class="form-control" type="Password" id="password" >
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default"  id="clearc">Clear Credits</button>
      </div>
    </div>

  </div>
</div> 


<br>

<input class="form-control mx-auto w-50 text-center" id="myInput" type="text" placeholder="Search..">
  <br>


<table class="table table-stripped table-bordered" id="myTable">
    <thead class="table-dark">
      <tr>

        <th>Name</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>Address</th>
        <th>Credit</th>
        <th></th>
        <th></th>
        
        
      </tr>
    </thead>
    <tbody id="tbody">
<?php

$qry="SELECT u.name,b.patient_id,u.contact_no,u.address ,( SUM(b.total)-SUM(b.paid) )as credit from bill b  , users u where b.shop_id= '$email' and u.user_id=b.patient_id and b.processed='1' group by b.patient_id";



$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($p = mysqli_fetch_assoc($r)) {
    
    ?>
        <tr>
        <td><?php echo $p['name'] ?></td>    
        <td><?php echo $p['patient_id'] ?></td>
        <td><?php echo $p['contact_no'] ?></td>
        <td><?php echo $p['address'] ?></td>
          <td><?php echo $p['credit'] ?></td>
          <td>
            <button id="<?php echo $var; ?>"  type="button" class="btn btn-sm btn-primary navbar-btn pull-right" onClick="showBillModal(this)" >Details</button> 
          </td>
          <td>
            <button id="<?php echo "b".$var; ?>"  type="button" class="btn btn-sm btn-primary navbar-btn pull-right" onClick="clearCredits(this)" >Clear Credits</button> 
          </td>
      </tr>




    <?php
    $var=$var+1;
    }

 
  } 


?>


    </tbody>
  </table>




  
<div id="bill_contain">


  
</div>  




</body>


  <script>
    var id='';
$(document).ready(function(){
  


  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });



});


function showBillModal(obj) {

          var id=obj.id;
        
            jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/patientBillDetailsModal.php",
                data: {'patient_id':document.getElementById("myTable").rows[id].cells[1].innerHTML, 
                'patient_name':document.getElementById("myTable").rows[id].cells[0].innerHTML,

                        },
               
                success: function(response)
                {
                 //alert(response);
                 document.getElementById("bill_contain").innerHTML=response;
                 //jQuery('#bill_contain').html(response);
                 jQuery('#bill_contain > #ab').modal();
                     
                }
            });




}

function clearCredits(obj) {

          id=obj.id;
          id=id.replace('b','');

          jQuery('#password_confirm').modal();

           

}







  $("#clearc").on("click", function() {
    var value = $('#password').val();
    jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/password.php",
                data: {'password':value
                        },
               
                success: function(response)
                {
                  console.log(response.length);
                  if(response.length >3)
                    {



                         jQuery.ajax({
                             type: 'POST',
                                 url: "ajaxphp/clear_credits.php",
                      data: {'patient_id':document.getElementById("myTable").rows[id].cells[1].innerHTML
                              },
               
                          success: function(response)
                          {
                  console.log('h'+response);

                            document.getElementById("myTable").rows[id].cells[4].innerHTML='0';

                            $('#password_confirm').modal('toggle');
                 
                            }
                        });


                    }
                    else
                    {
                        document.getElementById("msg").innerHTML="Wrong Password";

                    }
                 
                }
            });



   
  });




</script>