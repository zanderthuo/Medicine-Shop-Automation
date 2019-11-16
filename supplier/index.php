

<?php
include('../head.html');
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:../index.php');
}

$email=$_SESSION['email'];

$qry="update orders set seen='1' where supplier_id='$email'";
mysqli_query($conn,$qry);

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
                <li  class="nav-item active"><a class="nav-link"  href="#">Home<span id="notif" class="badge"></span></a></li>
                <li  class="nav-item"><a class="nav-link"  href="history.php">History</a></li>
            </ul>

        <button  type="button" class="btn btn-primary navbar-btn pull-right" data-toggle="modal" data-target='#addModal' >New Medicine</button>

          
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
  
<div id="addModal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <h4 class="modal-title">Add Medicine</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <form class="form" style="padding: 5px" onsubmit=" return addMeds()" id="new_med">

  <input type="text" style="margin: 10px"   id="meds_name" tabindex="1" class=" form-control input-sm" placeholder="Enter medicine name" autocomplete="off">
   <input type="date" style="margin: 10px" class=" form-control input-sm" id="mfd" tabindex="1" placeholder="MFD." autocomplete="off">
   <input type="date" style="margin: 10px" class=" form-control input-sm" id="expd" tabindex="1" placeholder="EXPD." autocomplete="off">

  <input type="number"  min="0" style="margin: 10px"  name="mrp" id="mrp" tabindex="1" class="form-control input-sm" placeholder="MRP" autocomplete="off">
  
    </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" onclick="supMeds()" data-dismiss="modal" >Confirm</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>  



<div id="orders">
  
</div>


<div id="items_modal">
  
</div>

</body>


<script>
  updateTable();
  fetchNotifs();

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



$('#mfd').change(function() {
  
  var date = new Date($('#mfd').val());
  day = date.getDate();
  month = date.getMonth() + 1;
  year = date.getFullYear();
  date=[year, month, day].join('-');
  date=document.getElementById("mfd").value;
});

$('#expd').change(function() {
  
  var date = new Date($('#expd').val());
  day = date.getDate();
  month = date.getMonth() + 1;
  year = date.getFullYear();
  date=[year, month, day].join('-');
  date=document.getElementById("expd").value;
});


function supMeds()
{
  var name=$('#meds_name').val();
  var mfd=$('#mfd').val();
  var expd=$('#expd').val();
  var mrp=$('#mrp').val();

  if(name=='' || mfd=='' || expd=='' || mrp==''){
    return false;
  }


   $.ajax({
    url:"ajaxphp/add_new_meds.php",
    method:"POST",
    data:{'name':name,
          'mfd':mfd,
          'expd':expd,
           'mrp':mrp },
    dataType:"json",
    success:function(data)
    {
      $("#addModal").modal('toggle');
     }

     });
}


setInterval(function() {
 
updateTable();
fetchNotifs();
  
}, 3000);


function updateTable(){
$.ajax({
    url:"ajaxphp/fetch_orders.php",
     method:"POST",
    data: {'product_id':"1"},
   
    success:function(data)
    {
      document.getElementById("orders").innerHTML=data;      
    }
    });
}

function fetchNotifs(){
$.ajax({
    url:"ajaxphp/fetch_notifs.php",
    success:function(data)
    {
      if(data.length>0){
      document.getElementById("notif").innerHTML=data;      
        
      }
      else{
      document.getElementById("notif").innerHTML='';      
        
      }
    }
    });
}

function showItems(obj){
 var id=obj.id;

   jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/showItemsModal.php",
                data: {'order_id':id,
                        'flag':'1'
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

function confirm(obj){
 var id=obj.id;

   jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/confirmOrder.php",
                data: {'order_id':id

                        },
               
                success: function(response)
                {
                updateTable(); 
                 jQuery('#items_modal > #ab').modal('toggle');       
                }
            });

}

</script>


