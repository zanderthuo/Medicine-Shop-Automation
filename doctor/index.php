<?php
include('../head.html');
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:../index.php');

}
$email=$_SESSION["email"];

if(!isset($_SESSION['pres_id'])){

  $qry="INSERT INTO `prescriptions` (`pres_id`, `doctor_id`, `patient_id`,`shop_id` ,`bill_id`,`date`) VALUES (NULL, '".$email."', '',  '', '','".date("Y-m-d")."');";

  if (mysqli_query($conn, $qry)) {
    $pres_id = mysqli_insert_id($conn);
    $_SESSION['pres_id']=$pres_id;
  } 
}
else{
  $pres_id=$_SESSION['pres_id'];
}


 $user_info['name']="";
 $user_info['user_id']="";
 $user_info['address']="";  
 $user_info['date']="";  
 $user_info['shop_id']="";  

// recommended solution for recent PHP versions
$pres_id = $_SESSION['pres_id'] ?? '';

// pre-7 PHP versions
$bill_id = '';
if (!empty($_SESSION['pres_id'])) {
     $pres_id = $_SESSION['pres_id'];
}

$qry="select u.name,u.user_id,u.address,u.contact_no  from prescriptions p,users u where p.pres_id='$pres_id' and p.patient_id=u.user_id " ;
$r=mysqli_query($conn, $qry);
if(mysqli_num_rows($r)>0){
  $user_info=mysqli_fetch_assoc($r);
}

// recommended solution for recent PHP versions
$pres_id = $_SESSION['pres_id'] ?? '';

// pre-7 PHP versions
$bill_id = '';
if (!empty($_SESSION['pres_id'])) {
     $pres_id = $_SESSION['pres_id'];
}

$qry="select date from prescriptions p where p.pres_id='$pres_id' " ;
$r=mysqli_query($conn, $qry);
if(mysqli_num_rows($r)>0){
$user_info['date']=mysqli_fetch_assoc($r)['date']; 
}
else{
$user_info['date']="";  
}

$qry="select u.name from users u , prescriptions p  where p.pres_id='$pres_id' and p.shop_id=u.user_id " ;
$r=mysqli_query($conn, $qry);
if(mysqli_num_rows($r)>0){
$user_info['shop_id']=mysqli_fetch_assoc($r)['name']; 
}
else{
$user_info['shop_id']="";  
}




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
                <li  class="nav-item active"><a class="nav-link" >Home</a></li>
                <li  class="nav-item "><a class="nav-link"  href="viewpres.php">Prescriptions</a></li>
            </ul>

          <a href="ajaxphp/newpres.php"><button  type="button" class="btn btn-primary navbar-btn pull-right"  >New</button> </a>

          
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


  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Logout Confirmation</h4>
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
  
  <input  type="text" style="margin: 10px" class="form-control input-sm " id="name" tabindex="1" class=" form-control input-sm" placeholder="Patient Name" autocomplete="off" value="<?php echo $user_info['name']; ?>">


  <input type="text" style="margin: 10px"
   class="col-md-3 form-control input-sm"  id="email" tabindex="1"  placeholder="Email" autocomplete="off" value="<?php echo $user_info['user_id']; ?>">


  <input type="text" style="margin: 10px"
   class="col-md-3 form-control input-sm"  id="address" tabindex="1"  placeholder="Address" autocomplete="off" value="<?php echo $user_info['address']; ?>">


  <input type="date" style="margin: 10px" class="col-md-3 form-control input-sm" id="date" tabindex="1" placeholder="Date" autocomplete="off" value="<?php echo $user_info['date']; ?>">

</div>

  









<form class="form-inline" style="padding: 5px" onsubmit=" return addMeds()" id="new_med">

  <input type="text" style="margin: 10px"   id="meds_name" tabindex="1" class=" form-control input-sm" placeholder="Enter medicine name" autocomplete="off">


  <input type="number"  min="0" style="margin: 10px"  name="qty" id="qty" tabindex="1" class="form-control input-sm" placeholder="Quantity" autocomplete="off">
  

  <button  class="btn btn-primary" id="add">Add</button>

</form>

<div id="table_div">


<?php include('pres_show.php'); ?> 


</div>

<input type="text" class="form-control col-md-2" autocomplete="off" name="shopk_id" id="shop_id" placeholder="shop" value="<?php echo $user_info['shop_id']; ?> " style="margin: 10px">
<button class="btn btn-sm btn-primary"  onclick="sendBill()" style="margin: 10px"> GO </button>


</body>

<script type="text/javascript">

$(document).ready(function(){

  $("#name").focus();


 $('#name').typeahead({

  source: function(query, result)
  {
   $.ajax({
    url:"ajaxphp/fetch_customer_details.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }

 });

  $('#shop_id').typeahead({

  source: function(query, result)
  {
   $.ajax({
    url:"ajaxphp/fetch_shopkeeper_names.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {

     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }

 });

  $('#shop_id').change(function() {

    var current = $('#shop_id').typeahead("getActive");
    
    $.ajax({
    url:"ajaxphp/update_shop_id_in_pres.php",
    method:"POST",
    data: {'shop_id':current['user_id']},

    complete:function(data)
    {
      //console.log(data);

     }
    



    });

});



$('#name').change(function() {
  $("#meds_name").focus();
    var current = $('#name').typeahead("getActive");
    $('#email').val(current['user_id']);
    $('#address').val(current['address']);

    
    $.ajax({
    url:"ajaxphp/update_user_in_pres.php",
    method:"POST",
    data: {'user_id':current['user_id']}
    });
});

 $('#meds_name').typeahead({

  source: function(query, result)
  {
   $.ajax({
    url:"ajaxphp/fetch_meds.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
     return item;
     }));
    }
   })
  }

 });

 $('#meds_name').change(function() {
  $("#qty").focus();
    
});

 /*$('#add').click(function() {

    


});
*/
 $("#table_div").on('click','.remove',function(){


    $.ajax({
    url:"ajaxphp/remove_meds_in_pres.php",
    method:"POST",
    data: {'id':this.id},
    success:function(data)
    {
      updateTable();
    }
    });
});


$('#date').change(function() {
  
  var date = new Date($('#date').val());
  day = date.getDate();
  month = date.getMonth() + 1;
  year = date.getFullYear();
  date=[year, month, day].join('-');
  date=document.getElementById("date").value;

    $.ajax({
    url:"ajaxphp/update_date_in_pres.php",
    method:"POST",
    data: {'date':date}
    });

});


 
});

function updateTable(){
 $.ajax({
    url:"pres_show.php",
    success:function(data)
    {
      $("#table_div").html(data);
    }
   });
}


function addMeds(){

var current = $('#meds_name').typeahead("getActive");
var qty=$("#qty").val();


if(qty=="0" || qty==""){
  return false;
}
    var id=current['product_id'];

     $.ajax({
    url:"ajaxphp/add_meds_in_pres.php",
    method:"POST",
    data: {'product_id':id, 'qty':qty },
    success:function(data)
    {
      updateTable();
      document.getElementById("new_med").reset();

      $("#meds_name").focus();

    }
    });

     return false;
}

function sendBill(){

  name=document.getElementById('name').value;
  shop_id=document.getElementById('shop_id').value;


  if(name==" " || shop_id==" ")
  {
    return;
  }
  
  window.location = "ajaxphp/sendPrescription.php";

}



</script>


<style type="text/css">
  .table td {
   text-align: center;   
}

</style>