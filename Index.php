<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<!------ Include the above in your HEAD tag ---------->
 <?php 

session_start(); 

if(isset($_SESSION['email']))
	header('Location:check_session.php');


 If(isset($_SESSION['error'])){ 
 ?>
 <div class="alert alert-danger" role="alert" 	>
  <center><strong><?php echo $_SESSION['error'] ?></strong></center>
</div>

  <?php 
	    unset($_SESSION['error']);
  } ?> 
<body>

<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="registration.php" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="login.php" method="post" role="form" style="display: block;" onsubmit="return logincheck()">
									<div class="form-group">
										<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email ID" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
								
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									
								</form>
								
								<form  id="register-form" action="registration.php" method="post" role="form" style="display: none;" onsubmit="return validateForm()">
									<div class="form-group">
										<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="" required>
									</div>
								
									<div class="form-group">
										
										<input type="email" name="email" id="reg_email" tabindex="1" class="form-control" placeholder="Email Address" value="" onkeyup="checkUsername(); return false;" required/>
									</div>
									
									<span id="info"></span>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
							
                                    <div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
									</div>
                              
                                    <div class="form-group">
										<input type="text" name="address" id="address" tabindex="2" class="form-control" placeholder="Address" required>
									</div>
					
                                    <div class="form-group">
										<input type="number" name="contact" id="contact" tabindex="2" class="form-control" placeholder="Contact Number" required>
									</div>
								
									<div class="form-group">
										<div class="radio-inline">
											<label><input type="radio" name="usertype" value="1">Shop Owner</label>
										</div>
										<div class="radio-inline">
											<label><input type="radio" name="usertype" value="2">Customer</label>
										</div>
										<div class="radio-inline">
											<label><input type="radio" name="usertype" value="3">Doctor</label>
										</div>

										<div class="radio-inline">
											<label><input type="radio" name="usertype" value="4">Supplier<label>
										</div>
										
									</div>
									
                                    
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now" >
											</div>
										</div>
									</div>
									
									
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
        </body>



<script type="text/javascript">


function logincheck()
{
	var email = document.forms["login-form"]["email"].value;
	var psd = document.forms["login-form"]["password"].value;
	if (email!="" && psd!="")
		return true;
	else
		return false;
	
}



function validateForm() {
		var name = document.forms["register-form"]["name"].value;
		var email = document.forms["register-form"]["reg_email"].value;
		var psd = document.forms["register-form"]["password"].value;
		var cnf = document.forms["register-form"]["confirm-password"].value;
		var contact = document.forms["register-form"]["contact"].value;
		var address = document.forms["register-form"]["address"].value;
		var usertype= document.forms["register-form"]["usertype"].value;
		if(name=="" || email=="" || psd=="" || contact=="" || address=="")
		{
			alert("One or more fields empty");
			return false;
		}
		
		
		if (cnf!=psd)
		{
			alert("Passwords don't match");
			return false;
		}
		
        return true;
    
}
$(function() {
	
    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	
	
	
	
	
	
	

});
function checkUsername()
{
  var eml = document.getElementById('reg_email');

    var dt =eml.value;
    $.ajax({
                type: 'POST',
                url: 'check.php',
                data: {'email':dt},
                dataType: 'json',
                success: function(r)
                {
                    if(r=="1")
                    {
                        //Exists
						//$("#info").css('display','block')
                        $("#info").html("Username already exists");
                    }else{
                        //Doesn't exist
						//$("#info").css('display','block')
                        $("#info").html("Username available!");   
                    }
                }
				
            });
}

</script>



<style>
	
	/* .container {
		filter: blur(8px);
  -webkit-filter: blur(8px);
	} */

    body {
    padding-top: 90px;
	/* background-color:silver; */
	background-image: url("images/cardiac.jpg");
	background-repeat: no-repeat;
	background-size: cover; 
	
}
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}

.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}

#register-form .has-error .control-label,
#register-form.has-error .help-block,
#register-form .has-error .form-control-feedback {
    color: #f39c12;
}

#register-form.has-success .control-label,
#register-form .has-success .help-block,
#register-form .has-success .form-control-feedback {
    color: #18bc9c;
}
.table td {
   text-align: center;   
}

</style>


