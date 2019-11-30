<?php
include('../head.html');
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:../index.php');
}

$email=$_SESSION['email'];
if(!isset($_SESSION['bill_id'])){

  $qry="INSERT INTO `bill` (`bill_id`, `shop_id`, `patient_id`, `date`, `total`, `paid`, `processed`) VALUES (NULL, '".$email."', '', '".date("Y-m-d")."', '', '', '0');";

  if (mysqli_query($conn, $qry)) {
    $bill_id = mysqli_insert_id($conn);
    $_SESSION['bill_id']=$bill_id;
  } 
}
else{
  $bill_id=$_SESSION['bill_id'];
}



 $user_info['name']="";
 $user_info['user_id']="";
 $user_info['address']="";  
 $user_info['date']="";  
 
 // recommended solution for recent PHP versions
$bill_id = $_SESSION['bill_id'] ?? '';

// pre-7 PHP versions
$bill_id = '';
if (!empty($_SESSION['bill_id'])) {
     $bill_id = $_SESSION['bill_id'];
}



// $qry=
$r=mysqli_query($conn,"select u.user_id,u.name,u.contact_no,b.date as date,u.address  from bill b,users u where b.bill_id='$bill_id' and u.user_id=b.patient_id");
if(mysqli_num_rows($r))
  $user_info=mysqli_fetch_assoc($r);

// recommended solution for recent PHP versions
$bill_id = $_SESSION['bill_id'] ?? '';

// pre-7 PHP versions
$bill_id = '';
if (!empty($_SESSION['bill_id'])) {
     $bill_id = $_SESSION['bill_id'];
}


$qry="select date from bill p where p.bill_id='$bill_id' " ;
$r=mysqli_query($conn, $qry);
if(mysqli_num_rows($r)){
$user_info['date']=mysqli_fetch_assoc($r)['date']; 

}
?>



<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <div class="navbar-header">
            <a class="navbar-brand" href="#"><?php echo $_SESSION['name']; ?></a>
          </div>
            <ul class="navbar-nav mr-auto">
                <li  class="nav-item active"><a class="nav-link"  href="#">Home</a></li>
                <li  class="nav-item"><a class="nav-link"  href="stock.php">Stock</a></li>
                <li class="nav-item"><a class="nav-link"  href="customers.php">Customer</a></li>
                <li class="nav-item"><a class="nav-link" href="Prescriptions.php">Prescriptions<span id="notif" class="badge"></span></a></li>
            <li class=" nav-item "><a class="nav-link"  href="order.php">Order</a></li>
             <li class=" nav-item "><a class="nav-link"  href="purchases.php">Purchases</a></li>
           
            </ul>

            <a href="queryphp/newBill.php"><button  type="button" class="btn btn-primary navbar-btn pull-right"  >New Bill</button> </a>

          
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
  
  <input  type="text" style="margin: 10px" class="form-control input-sm " id="name" tabindex="1" class=" form-control input-sm" placeholder="Patient Name" autocomplete="off" value="<?php echo $user_info['name']; ?>">


  <input type="text" style="margin: 10px"
   class="col-md-3 form-control input-sm"  id="email" tabindex="1"  placeholder="Email" autocomplete="off" value="<?php echo $user_info['user_id']; ?>">


  <input type="text" style="margin: 10px"
   class="col-md-3 form-control input-sm"  id="address" tabindex="1"  placeholder="Address" autocomplete="off" value="<?php echo $user_info['address']; ?>">


  <input type="date" style="margin: 10px" class="col-md-3 form-control input-sm" id="date" tabindex="1" placeholder="Date" autocomplete="off" value="<?php echo $user_info['date']; ?>">

</div>

  

<form method="POST" class="form-inline" style="padding: 5px" onsubmit=" return addMeds()" id="new_med">

        <div class="form-group">
  <input type="text" style="margin: 10px"   id="meds_name" tabindex="1" class="form-control input-sm" placeholder="Enter medicine name" autocomplete="off">


  <input type="number"  min="0" style="margin: 10px"  name="qty" id="qty" tabindex="1" class="form-control input-sm" placeholder="Quantity" autocomplete="off">
  

  <button  class="btn btn-primary" id="add">Add</button>
</div>
</form>



<div id="table_div">
 
 <?php
include('bill_show.php');
 ?>
 
</div>

</body>

<script type="text/javascript">

$(document).ready(function(){

 notifUpdate();
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

$('#name').change(function() {
    var current = $('#name').typeahead("getActive");
    $('#email').val(current['user_id']);
    $('#address').val(current['address']);

    
    $.ajax({
    url:"ajaxphp/update_user_in_bill.php",
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

 $('#add').click(function() {
  $.ajax({
    url:"ajaxphp/add_meds_in_bill.php",
    method:"POST",
    data: {
      'meds_name' :this.meds_name,
      'qty' : this.qty,
      'product_id' : this.product_id,
      'batch_no' : this.batch_no
    }
  });
    


});

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


$('#date').change(function() {
  
  var date = new Date($('#date').val());
  day = date.getDate();
  month = date.getMonth() + 1;
  year = date.getFullYear();
  date=[year, month, day].join('-');
  date=document.getElementById("date").value;

    $.ajax({
    url:"ajaxphp/update_date_in_bill.php",
    method:"POST",
    data: {'date':date}
    });

});


 
});

function updateTable(){
 $.ajax({
    url:"bill_show.php",
    success:function(data)
    {
      $("#table_div").html(data);
    }
   });
}


function addMeds(){
var current = $('#meds_name').typeahead("getActive");
var qty=$("#qty").val();
var stock=current['quantity'];


if(qty=="0" || qty==""){
  return false;
}
if(parseInt(qty)>parseInt(stock)){
  alert("Out of stock \n Available "+stock);
  return false;
}
    var id=current['product_id'];
    var batch_no=current['batch_no'];

     $.ajax({
    url:"ajaxphp/add_meds_in_bill.php",
    method:"POST",
    data: {'product_id':id,'batch_no':batch_no, 'qty':qty },
    success:function(data)
    {
      updateTable();
      document.getElementById("new_med").reset();

      $("#meds_name").focus();

    }
    });

     return false;
}

function billPay(){


total=$("#total").html();
paid=$("#paid").val();

if(paid.length==0)
{
  return false;
}
if($("#name").val().length<=0){
  return false;
}


window.location = "ajaxphp/update_total_in_bill.php?total="+total+"&paid="+paid;

}

setInterval(function() {
 

 notifUpdate();
  
}, 3000);

function notifUpdate(){
   $.ajax({
    url:"ajaxphp/prescription_notification.php",
     method:"POST",
    data: {'product_id':"1"},
   
    success:function(data)
    {
      if(data.length==0){
      document.getElementById("notif").innerHTML='';
        }
        else{
      document.getElementById("notif").innerHTML=data;
          
        }
    }
    });
}

</script>