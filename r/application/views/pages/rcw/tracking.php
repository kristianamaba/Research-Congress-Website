<!DOCTYPE html>
<?php
//if($this->session->userdata('LoggedIn')!="1")
	//header('Location: ./index');
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
	<style>
	@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css");
	.track_tbl td.track_dot {
		width: 50px;
		position: relative;
		padding: 0;
		text-align: center;
	}
	.track_tbl td.track_dot:after {
		content: "\f111";
		font-family: FontAwesome;
		position: absolute;
		margin-left: -5px;
		top: 11px;
	}
	.track_tbl td.track_dot span.track_line {
		background: #000;
		width: 3px;
		min-height: 50px;
		position: absolute;
		height: 101%;
	}
	.track_tbl tbody tr:first-child td.track_dot span.track_line {
		top: 30px;
		min-height: 25px;
	}
	.track_tbl tbody tr:last-child td.track_dot span.track_line {
		top: 0;
		min-height: 25px;
		height: 10%;
	}
	
	.form-control-borderless {
		border: none;
	}

	.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
		border: none;
		outline: none;
		box-shadow: none;
	}
	</style>
</head>

<body>

		<div class="layout-width">
		<?php $this->load->view("sub-page/$web/header");?>
		
		<div class="clearfix"></div>

		<div class="container">
    <br/>
	<div class="row justify-content-center" style="padding-top:80px;padding-bottom:80px;">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm">
                                <div class="card-body row no-gutters align-items-center">
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" value="<?php  echo (isset($_GET['id']) ? $_GET['id']:"");?>" name="id" type="search" placeholder="Search Reference ID">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
			<?php
				$stat = array("Not Assigned","Being Reviewed","Evaluated","Rejected");


				function history($arr){
					$string = "";
					for($i = 0; $i < count($arr); $i++){
						$words = explode(": ", $arr[$i]);
						$string .= "<tr>
									<td class=\"track_dot\">
										<span class=\"track_line\"></span>
									</td>
									<td>".($i+1)."</td>
									<td>".$words[1]."</td>
									<td>".date ("F d, Y G:i A",  strtotime($words[0]))."</td>
									
								</tr>";
						}
					return rtrim($string, "<br>");;
				}
				if(!empty($data))		
				for($i = 0; $i < count($data); $i++){
					$history = (array) json_decode($data[$i]['Array_String']);
					$s_history = history($history['Description']);
					echo "<div class=\"p-4\">
						<h3>Tracking Number: RCS-".($data[$i]['ConferenceID']+2049).'-'.($data[$i]['SubmissionID']+3630)."</h3>
						<h5>  Conference : <a href=\"conference?id=".$data[$i]['Acronym']."\">".$data[$i]['Name']."<br></h5></a>
						<h5>  Status: ".$stat[$data[$i]['Status']-1]."<br></h5>
						<table class=\"table table-bordered track_tbl\">
							<thead>
								<tr>
									<th></th>
									<th>Record No.</th>
									<th>Description</th>
									<th>Date/Time</th>
								</tr>
							</thead>
							<tbody>
								".$s_history."
							</tbody>
						</table>
					</div>";
				}
			?>
			
			

		</div>

		<div class="clearfix"></div>

		<?php $this->load->view("sub-page/$web/footer"); ?>
	</div>
	
	<script>
		var baseURL="<?php echo base_url();?>";
			function onLoad(){
				<?php
					if(isset($_GET['id'])&&empty($data))
						echo "fAlert('Invalid Tracking Number');";
				?>
			}
			
			window.onload = function(e){ 
				onLoad();
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
