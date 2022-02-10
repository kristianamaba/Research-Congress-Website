<!DOCTYPE html>
<?php
if($this->session->userdata('LoggedIn')!="1")
	header('Location: ./index');
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>History</title>
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
		<?php $this->load->view("sub-page/$web/header");?>
		
		<div class="clearfix"></div>

		<div class="container">
			<!-- Faq & Testimonial -->
			<section class="faq-testi-page">
				<h2 class="valid">Validation Purposes</h2>
				<div class="row">
					<!-- Faq -->
					<div class="l-faq-block-up">
						<div class="panel-group custom" id="accordion" style="width:700px">
							<?php
								$stat = array("Not Assigned","Being Reviewed","Evaluated","Rejected");


								function history($arr){
									$string = "";
									for($i = 0; $i < count($arr); $i++){
										$words = explode(": ", $arr[$i]);
										$string .= "<tr>
														<td>".date ("F d, Y G:i A",  strtotime($words[0]))."</td>
														<td>".$words[1]."</td>
													</tr>";
									}
									return rtrim($string, "<br>");;
								}
								
								
								for($i = 0; $i < count($data); $i++){
									$history = (array) json_decode($data[$i]['Array_String']);
									$s_history = history($history['Description']);
									echo "<!-- Faq #1 -->
										<div class=\"panel custom\" >
											<div class=\"panel-heading custom\" role=\"tab\" id=\"heading".$i."\" >
												<h4 class=\"panel-title custom\">
													<a role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse".$i."\" aria-expanded=\"true\" aria-controls=\"collapse".$i."\">
														Tracking ID: RCS-".($data[$i]['ConferenceID']+2049).'-'.($data[$i]['SubmissionID']+3630)."
														<span class=\"fa fa-plus-circle coll-a\"></span>
													</a>
												</h4>
											</div>
											<div id=\"collapse".$i."\" class=\"panel-collapse collapse ".($i==0? "show": "")." custom\" aria-labelledby=\"heading".$i."\" data-parent=\"#accordion\">
												<div class=\"panel-body custom\">
													Conference : ".$data[$i]['Name']."<br>
													Status: ".$stat[$data[$i]['Status']-1]."<br>
													<table class=\"table\">
													  <thead>
														<tr>
														  <th scope=\"col\">Date</th>
														  <th scope=\"col\">Description</th>
														</tr>
													  </thead>
													  <tbody>
														".$s_history."
														
													  </tbody>
													</table>
												</div>
											</div>
										</div>";
								}
							?>
							
							
							
						</div>
					</div>
				</div>
			</section>
		</div>

		<div class="clearfix"></div>

		<?php $this->load->view("sub-page/$web/footer"); ?>
	</div>
	
	<script>
		var baseURL="<?php echo base_url();?>";
			function onSubmit(){
				$.ajax({
					 url:baseURL+'index.php/Rcw_controller/changeSettings',
					 method: 'post',
					 data: $("#profileForm").serialize(),
					 success: function(output, status, xhr){
						 if(output=='1')
							 sAlert("Changed Settings Successfully!", './profile');
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
