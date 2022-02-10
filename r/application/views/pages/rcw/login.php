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
	<title>Login</title>
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
		<form class="login-f" id="loginForm">
			<!-- Title -->
			<div class="title-from">Log In to Your Account</div>
			<!-- Username -->
			<input type="email" placeholder="Email" name="email" value="<?php echo $this->session->userdata('Email');?>" class="user-l">
			<!-- Password -->
			<input type="password" placeholder="password" name="pass" value="<?php echo (null !==$this->session->userdata('Pass')? $this->session->userdata('Pass'):"");?>" class="user-l">
			<!-- Remember -->
			<div class="remember-line">
				<a href="policy">Read Privacy Policy</a><br><br>
				<input type="checkbox" name="remember" <?php echo (null !==$this->session->userdata('remember')? "checked":"");?> class="check-f">
				<span>Remember me ?</span>
			</div>
			<!-- Login -->
			<input type="button" onclick="onSubmit()" class="login-btn" value="Sign in">
		</form>
		<div class="line-op">
			<!-- Reset Password -->
			<div class="re-p">
				<span class="fa fa-question form-p"></span>
				<a class="reset-p" href="forgot-pass">Reset Password</a>
			</div>
			<!-- Register -->
			<div class="reg-p">
				<span class="fa fa-user-plus form-p"></span>
				<a class="reset-p" href="sign-up">Register</a>
			</div>
		</div>

		<div class="clearfix"></div>

		<?php $this->load->view("sub-page/$web/footer"); ?>
	</div>

	<script>
		var baseURL="<?php echo base_url();?>";
			function onSubmit(){
				$.ajax({
					 url:baseURL+'index.php/Rcw_controller/checkAccount',
					 method: 'post',
					 data: $("#loginForm").serialize(),
					 success: function(output, status, xhr){
						 if(output=='1')
							 sAlert("Account Logged In!", './index');
						 else
							fAlert(output);
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Error: " + errorThrown); 
					}   
				  });
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
