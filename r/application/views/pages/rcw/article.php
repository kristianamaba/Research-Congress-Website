<!DOCTYPE html>
<html lang="en">
<?php
if(!isset($data))
	header('Location: ./index');
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Article</title>
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
		<!-- Blog Content -->
		<div class="blog-content article-page">
			<div class="container">
				<div class="row">
					<?php
						//print_r($data);
						
						//a.ArticleID, b.FirstName, b.LastName, a.Photo, a.Title, a.Content, a.CreatedAt
								
								for($i = 0; $i < count($data); $i++){
									
									
									
										echo  "<!-- Content -->
										<div class=\"col-sm-9\">
											<div class=\"content-x\">
												<!-- Item -->
												<div class=\"item-art\">
													<!-- IMG -->
													<img class=\"article-page-img\" src=\"".$data[$i]['Photo']."\" alt=\"x-data\">
													<!-- Format -->
													<a class=\"art-format custom-bg-p1\" href=\"#\">Article</a>
													<div class=\"clearfix\"></div>
													<div class=\"text-area\">
														<!-- Title -->
														<a class=\"title-art-sub\" href=\"#\">".$data[$i]['Title']."</a>
														<!-- HR -->
														<hr class=\"custom-art-hr\">
														<!-- Information -->
														<div class=\"art-info-sub\">
															<!-- Date -->
															<div class=\"art-block-sub\">
																<span class=\"fa fa-calendar-o\"></span>
																<span>".date ("F d, Y",  strtotime($data[$i]['CreatedAt']))."</span>
															</div>
															<!-- User -->
															<div class=\"art-block-sub\">
																<span class=\"fa fa-user-o\"></span>
																<a href=\"#\">".$data[$i]['FirstName']." ".$data[$i]['LastName']."</a>
															</div>
														</div>
														<!-- Brief Description -->
														<div class=\"body-article\">
															<p>".str_replace("\n", '<br>',$data[$i]['Content'])."</p>
														</div>
													</div>
												</div>
											</div>

											
										</div>";
								}
						
						
					?>
					

					<!-- Sidebar -->
					<div class="col-sm-3">
						<aside class="sidebar">

							

							<!-- Recent Posts -->
							<div class="block-sidebar-function">
								<!-- Widget Title -->
								<div class="wid-title">
									<h2>Recent Conferences</h2>
									<div class="func-hr"></div>
									<div class="func-hr2"></div>
								</div>
								<!-- Widget Body -->
								<div class="wid-body">
									<ul class="posts">
										<?php
											for($i = 0; $i < count($data2); $i++){
												echo "<li>
														<!-- TITLE -->
														<a href=\"conference?id=".$data2[$i]['Acronym']."\">".$data2[$i]['Name']."</a>
														<p class=\"font-weight-light\"><span class=\"fa fa-credit-card\"></span> ".$data2[$i]['Acronym']."</p>
														<!-- DATE -->
														<div class=\"date-post-wid\" style=\"margin-top:40px\">
															<span class=\"fa fa-clock-o\"></span>
															<span>".date ("F d, Y",  strtotime($data2[$i]['DeadlineSubmission']))."</span>
														</div>
														<div class=\"func-hr2\"></div>
													</li>";
											}
										?>
										
									</ul>
								</div>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view("sub-page/$web/footer"); ?>
	</div>
	<script>
		var baseURL="<?php echo base_url();?>";
			
	
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
