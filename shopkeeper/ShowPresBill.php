

<?php
include('../head.html');
require_once("../connect.php");
session_start();

if(!isset($_SESSION['email'])){
  header("Location:../../index.php");
}

$shop_id=$_SESSION['email'];
$email=$_SESSION['email'];
$pres_id=$_GET['pres_id'];

$qry = "select * from prescriptions where shop_id='$shop_id' and pres_id='$pres_id' and processed='1' and bought='0'";

$t=mysqli_query($conn,$qry);

if ($t->num_rows == 0) 
{
  ?>
  <div style="margin: 50px" class="alert alert-danger">
  <strong>Wrong Prescription ID</strong> 
</div>
  <?php
  die("");

}

$bill_id=mysqli_fetch_assoc($t)['bill_id'];


$qry="select b.date,u.user_id,u.name,u.contact_no,b.date as date,u.address  from bill b,users u where b.bill_id='$bill_id' and u.user_id=b.patient_id";
$r=mysqli_query($conn, $qry);
if(mysqli_num_rows($r))
  $user_info=mysqli_fetch_assoc($r); 
?>



<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Shop Name</a>
          </div>
            <ul class="navbar-nav mr-auto">
                <li  class="nav-item active"><a class="nav-link"  href="#">Home</a></li>
                <li  class="nav-item"><a class="nav-link"  href="stock.php">Stock</a></li>
                <li class="nav-item"><a class="nav-link"  href="customers.php">Customer</a></li>
               
                <li class="nav-item"><a class="nav-link" href="Prescriptions.php">Prescriptions<span id="notif" class="badge"></span></a></li>

            <li class=" nav-item "><a class="nav-link"  href="order.php">Order</a></li>
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


 


<div class="col-md-12 form-inline" style="padding: 5px">
  
  <input  type="text" style="margin: 10px" class="form-control input-sm " id="name" tabindex="1" class=" form-control input-sm" placeholder="Patient Name" autocomplete="off" value="<?php echo $user_info['name']; ?>" disabled>


  <input type="text" style="margin: 10px"
   class="col-md-3 form-control input-sm"  id="email" tabindex="1"  placeholder="Email" autocomplete="off" value="<?php echo $user_info['user_id']; ?>" disabled>


  <input type="text" style="margin: 10px"
   class="col-md-3 form-control input-sm"  id="address" tabindex="1"  placeholder="Address" autocomplete="off" value="<?php echo $user_info['address']; ?>" disabled>


  <input type="date" style="margin: 10px" class="col-md-3 form-control input-sm" id="date" tabindex="1" placeholder="Date" autocomplete="off" value="<?php echo $user_info['date']; ?>" disabled>

</div>




<div id="table_div">

</div>


</body>



<script type="text/javascript">

$(document).ready(function(){

updateTable();

 $("#table_div").on('click','.remove',function(){
    $.ajax({
    url:"ajaxphp/remove_meds_in_bill.php",
    method:"POST",
    data: {'id':this.id},
    success:function(data)
    {
      updateTable();
    }
    });
});

});

function updateTable(){
 $.ajax({
    url:"bill_show.php?bill_id=<?php echo $bill_id; ?>",
    success:function(data)
    {
      $("#table_div").html(data);
    }
   });
}

function billPay(){


total=$("#total").html();
paid=$("#paid").val();

if(paid=="")
{
  return false;
}

window.location = "ajaxphp/update_total_in_bill.php?bill_id=<?php echo $bill_id; ?>&pres_id=<?php echo $pres_id  ?>&total="+total+"&paid="+paid;

}

setInterval(function() {
 

  $.ajax({
    url:"ajaxphp/prescription_notification.php",
     method:"POST",
    data: {'product_id':"1"},
   
    success:function(data)
    {
      /*if(data.localeCompare("0")){
      document.getElementById("notif").innerHTML='';
        }
        else{*/
      document.getElementById("notif").innerHTML=data;
          
        //}
    }
    });

}, 3000);


</script>

