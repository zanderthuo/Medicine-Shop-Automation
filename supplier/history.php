

<?php
include('../head.html');
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:../index.php');
}

$email=$_SESSION['email'];

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
                <li  class="nav-item"><a class="nav-link"  href="index.php">Home<span id="notif" class="badge"></span></a></li>
                <li  class="nav-item active" ><a class="nav-link"  href="#">History</a></li>
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
  



<div id="orders">
	<table style="padding: 5px margin:5px" class="table table-stripped table-bordered" id="bill">
    <thead class="table-dark">
      <tr>

        <th>Sl No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Date</th>
        <th></th>
        <th></th>
        
        
        
        
      </tr>
    </thead>

    <tbody id="bdy">

      <?php

      $qry="SELECT u.name ,u.user_id, u.address, u.contact_no ,o.date ,o.order_id,o.confirmed from users u , orders o where o.shop_id=u.user_id and o.supplier_id='$email' and o.processed='1'";



      $r=mysqli_query($conn,$qry);
      $var=1;

      if ($r->num_rows > 0) 
      {
   
      
      while($p = mysqli_fetch_assoc($r)) {
    
      ?>

     

         <tr>

        <td><?php echo $var;?></td>
        <td><b><?php echo $p['name']; ?> </b></td>
        
        <td><?php echo $p['user_id']; ?> </td>
        <td><?php echo $p['address']; ?> </td>
        <td><?php echo $p['contact_no']; ?> </td>
        <td><?php echo $p['date']; ?> </td>
        
        <td><button class="btn btn-sm btn-primary text-center indigo" id="<?php echo($p['order_id']); ?>" onclick="showItems(this)" >Details</button></td>

       <td><?php  
       if($p['confirmed']=='1')
       	{
       	 echo "Confirmed" ;
       	} 
       	else{ 
       		echo "Pending";
       		 } ?></td>


      </tr>





     <?php    
        $var=$var+1;
      }
    }
  ?>



   


      

  </tbody>


</table>  

  
</div>


<div id="items_modal">
  
</div>

</body>


<script>

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



function showItems(obj){
 var id=obj.id;

   jQuery.ajax({
                type: 'POST',
                url: "ajaxphp/showItemsModal.php",
                data: {'order_id':id,
                'flag':'0'

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


