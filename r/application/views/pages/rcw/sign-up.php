<!DOCTYPE html>
<?php
if($this->session->userdata('LoggedIn')=="1")
	header('Location: ./index');
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<!-- Fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700%7CRaleway:400,700" rel="stylesheet">
	<!-- Favicon -->
	<link rel="icon" type="image/ico" href="assets/img/favicon.ico">
	<!-- Bootstrap -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
	<!-- Custom Style -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/default_theme.css" rel="stylesheet">
	<!-- Responsive Style -->
	<link href="assets/css/responsive.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

		<div class="layout-width">
		<?php $this->load->view("sub-page/$web/header"); ?>
		
		<div class="clearfix"></div>

		<!-- Login Form -->
		<form class="login-f" id="registerForm">
			<!-- Title -->
			<div class="title-from">Create An Account</div>
			<!-- First  Name -->
			<input type="text" name="first_name" placeholder="First Name" class="user-l custom">
			<!-- Last Name -->
			<input type="text" name="last_name" placeholder="Last Name" class="user-l custom">
			<!-- Account Type -->
			<select name="type" style="text-align-last:center;" class="user-l custom">
			  <option value="5">Researcher</option>
			  <option value="4">Secretariat</option>
			</select>
			<!-- Email -->
			<input type="email" name="email" placeholder="Email" class="user-l custom">
			<!-- Password -->
			<input type="password" name="pass" placeholder="Password" class="user-l custom">
			<input type="button" onclick="onConfirm()" class="login-btn custom" value="Sign up">
		</form>
			<!-- Register -->
			
		
		<div class="line-op">
			<!-- Sign in -->
			<div class="reg-p">
				<span class="fa fa-user-plus form-p"></span>
				<a class="reset-p" href="login">Already Have Account ?</a>
			</div>
		</div>

		<div class="clearfix"></div>

		<?php $this->load->view("sub-page/$web/footer"); ?>
	</div>
	
	
	<!-- The Modal -->
	<div class="modal" id="onConfirmModal">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Confirmation Code</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			<form id="ask-help">
				<input class="form-control" type="text"  id="code"  name="code"  placeholder="Enter Code">
									
			<form>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			<button type="button" onclick="onCheck()" class="btn btn-primary">Confirm</button>
			<button type="button" id="confirm-cancel" class="btn btn-danger" data-dismiss="modal">Close</button>
		  </div>

		</div>
	  </div>
	</div>
	
	<script>
		var code = "";
		var baseURL="<?php echo base_url();?>";
			function onSubmit(){
				$.ajax({
					 url:baseURL+'index.php/Rcw_controller/createAccount',
					 method: 'post',
					 data: $("#registerForm").serialize(),
					 success: function(output, status, xhr){
						 if(output=='1')
							 sAlert("Account Registered!", './login');
						 else
							fAlert(output);
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Error: " + errorThrown); 
					}   
				  });
			}
			
			function onConfirm(){
				code = Math.floor(100000 + Math.random() * 900000);
				$.ajax({
					 url:baseURL+'index.php/Rcw_controller/sendConfirm',
					 method: 'post',
					 data: $("#registerForm").serialize()+ '&code=' + code,
					 success: function(output, status, xhr){
						if(output=="1")
							$('#onConfirmModal').modal('show');
						else
							fAlert(output);
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Error: " + errorThrown); 
					}   
				  });
			}
			
			function onCheck(){
				var codeVal = document.getElementById("code").value;
				if(codeVal==code){
					document.getElementById('confirm-cancel').click();
					onSubmit();
				}
				else
					fAlert("Wrong Code"); 
			}
	</script>
		
		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="assets/js/jquery-2.2.4.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Owl Carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- Plugins -->
	<script src="assets/js/plugins.js"></script>
	<script src="assets/js/customs.js"></script>

</body>

</html>
