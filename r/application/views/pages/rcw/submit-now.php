<!DOCTYPE html>
<?php
if(!isset($_GET['id'])||count($data)<1)
	header('Location: ./conferences');
else if($this->session->userdata('LoggedIn')!="1")
	header('Location: ./login');
else if($data[0]['DeadlineSubmission']<date('Y-m-d')){
	header('Location: ./conferences');
}
else if($confirm>=1){
	header('Location: ./conference?id='.$_GET['id']);
}
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Submit Now</title>
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

		

		

		<!-- Contact Form -->
		<div class="c-form">
			<div class="offset-lg-3 col-lg-6">
				<div class="sec-title">
					<h2 id="form-title">New Submission for <?php if(count($data)>=1) echo $data[0]['Name']; ?></h2>
					<p>Follow the instructions, step by step, and then use the "Submit" button at the bottom of the form. The required fields are marked by *.</p>
					<p>Please note that there can only be one submission per day as a limit to prevent spamming.</p>
				</div>
				<!-- Form -->
				<form class="contact-us" id="submitForm" enctype="multipart/form-data">
				
					<div id="authors-input">
						<div class="card" style="margin:20px">
							<div class="card-header text-justify"> <p class="font-weight-bold card-title">Author 1</p></div>
							
						  <div class="row">
							<div class="col">
							  <div class="field-form">
									<!-- UserName -->
									<input type="text" placeholder="First Name*" name="first_name[]" value="" class="user-n half">
								</div>
								<div class="field-form">
									<!-- UserName -->
									<input type="text" placeholder="Last Name*" name="last_name[]" value="" class="user-n half">
								</div>
								<div class="field-form">
									<!-- Mail -->
									<input type="email" placeholder="Email*" name="email[]" value="" class="user-n half">
								</div>
								<div class="field-form">
									<!-- Phone -->
									<select name="country[]" class="user-n half">
										<option value="CA"> Canada </option>
										<option value="CN"> China </option>
										<option value="FR"> France </option>
										<option value="DE"> Germany </option>
										<option value="JP"> Japan </option>
										<option value="PH"> Philippines </option>
										<option value="CH"> Switzerland </option>
										<option value="UK"> United Kingdom </option>
										<option value="US"> United States </option>	
									</select>
								</div>
								<div class="field-form">
									<!-- Subject -->
									<input type="text" placeholder="Organization*" name="institution[]" value="" class="user-n half">
								</div>
								<div class="field-form">
									<!-- Subject -->
									<a href="#" onclick="addAuth(this);"><p class="user-n half text-primary">Click here to add more authors<p></a>
								</div>
							</div>
						  </div>
						</div>
					</div>
					
					
						<div class="card" style="margin:20px">
							<div class="card-header text-justify"> <p class="font-weight-bold card-title">Title and Abstract</p>
							<p>The title and the abstract should be entered as plain text, they should not contain HTML elements.</p></div>
							
							
						  <div class="row">
							<div class="col">
							  <div class="field-form">
								<!-- Subject -->
								<input type="text" placeholder="Title*" name="title" class="user-n half" style="width:95%">
							</div>
							</div>
						  </div>
						   <div class="row">
							<div class="col">
							  <div class="field-form">
								<!-- Subject -->
								<textarea placeholder="Abstract*" rows="10" name="abstract" class="user-n half" style="width:95%"></textarea>
							</div>
							</div>
						  </div>
						</div>
						
						
						
						
						<div class="card" style="margin:20px">
							<div class="card-header text-justify"> <p class="font-weight-bold card-title">Keywords</p>
							<p>Type a list of keywords (also known as key phrases or key terms), seperated by comma ( , ) to characterize your submission. You should specify at least three keywords.</p>
							
							</div>
							
						  <div class="row">
							<div class="col">
							  <div class="field-form">
								<!-- Subject -->
								<input type="text" placeholder="Keywords*" name="keys"class="user-n half" style="width:95%">
							</div>
							</div>
						  </div>
						</div>
						
						
						<div class="card" style="margin:20px">
							<div class="card-header text-justify"> <p class="font-weight-bold card-title">Files</p>
							<p>Upload your Full Paper. The paper must be in PDF format (file extension .pdf)</p>
							
							</div>
							
						  <div class="row">
							<div class="col">
							  <div class="field-form">
								<!-- Subject -->
								<input type="file" id="userfile" name="doc" class="user-n half" style="width:95%">
							</div>
							</div>
						  </div>
						</div>
				
				
				
				  
				  
					<input type="hidden" id="idname" name="id" value="<?php if(count($data)>=1) echo $data[0]['ConferenceID'];  ?>">
					<!-- Send Btn -->
					<input type="button" onclick="onSubmit()" class="user-sub" value="Submit Research">
				</form>
			</div>
		</div>

		<div class="clearfix"></div>
		<?php $this->load->view("sub-page/$web/footer"); ?>
	</div>

	<script>
		var AuthNum = 1;
		var baseURL="<?php echo base_url();?>";
			function onSubmit(){
				var data = new FormData($('#submitForm')[0]);
				$.ajax({
					url:baseURL+'index.php/Rcw_controller/submitResearch',
					method: 'post',
					data: data,
					mimeType:"multipart/form-data",
					contentType: false,
					processData: false,
					success: function(output, status, xhr){
						if(output=='1')
							sAlert("Research Submitted!", './history');
						else
							fAlert(output);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Error: " + errorThrown); 
					}					
				  });
			}
			
			function addAuth(id){
				AuthNum++;
				id.style.display = 'none';
				var str = "<div class=\"card\" style=\"margin:20px\"> <div class=\"card-header text-justify\"> <p class=\"font-weight-bold card-title\">Author "+AuthNum+"</p></div> <div class=\"row\"> <div class=\"col\"> <div class=\"field-form\"> <input type=\"text\" placeholder=\"First Name*\" name=\"first_name[]\" class=\"user-n half\"> </div> <div class=\"field-form\">  <input type=\"text\" placeholder=\"Last Name*\" name=\"last_name[]\"  class=\"user-n half\"> </div> <div class=\"field-form\">  <input type=\"email\" placeholder=\"Email*\" name=\"email[]\" class=\"user-n half\"> </div> <div class=\"field-form\"> <select name=\"country[]\" class=\"user-n half\"> <option value=\"CA\"> Canada </option> <option value=\"CN\"> China </option> <option value=\"FR\"> France </option> <option value=\"DE\"> Germany </option> <option value=\"JP\"> Japan </option> <option value=\"PH\"> Philippines </option> <option value=\"CH\"> Switzerland </option> <option value=\"UK\"> United Kingdom </option> <option value=\"US\"> United States </option></select> </div> <div class=\"field-form\">  <input type=\"text\" placeholder=\"Organization*\" name=\"institution[]\" class=\"user-n half\"> </div> <div class=\"field-form\">  <a href=\"#\" onclick=\"addAuth(this)\"><p class=\"user-n half text-primary\">Click here to add more authors<p></a> </div> </div> </div> </div>";
				document.getElementById("authors-input").innerHTML += str;
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
