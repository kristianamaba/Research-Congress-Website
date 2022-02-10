<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Research Conference Archive</title>

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
		
		<!-- Blog -->
		<section class="blog">
			<div class="blog-title-top">
				<div class="container">
					<!-- Title -->
					<h2>Research Conference Archive</h2>
					<p>of <b>ICT Research Congress</b></p>
				</div>
			</div>
		</section>

		<!-- Blog Content -->
		<div class="blog-content">
			<div class="container">
				<div class="row">
					
					<!-- Content -->
					<div class="col-sm-9">
						<div class="row">
							<?php 
							
							function keywords($str){
									$strTemp = "";
									$words = explode(",", $str);
									foreach ($words as $w) {
										$strTemp = "<a href=\"search?s=".trim($w)."\"> ".trim($w)." </a>" . $strTemp;
										
									}
									return rtrim($strTemp, ",");;
							}
							
							//ConferenceID,Name,Acronym,Venue,DeadlineAbstract,TopicKeywords
							$yearTemp = 0;
							$issueTemp = 1;
							$volTemp = 0;
							
							if(isset($data))
							for($i = 0; $i < count($data); $i++){
								$year= date ("Y",  strtotime($data[$i]['DeadlineSubmission']));
								if($year ==  $yearTemp)
									++$issueTemp;
								else{
									++$volTemp;
									$issueTemp = 1;
									$yearTemp = $year;
								}
									
								
								echo "<!-- Item -->
								<div class=\"col-sm-12\">
									<div class=\"item-art\">
										<div class=\"text-area\">
											<!-- Title -->
											<a class=\"title-art-sub\" href=\"archive?id=".$data[$i]['Acronym']."\" style=\"padding-top:50px;\"> Vol $volTemp No. $issueTemp (".$data[$i]['Name'].") </a>
											<p>Vol $volTemp No. $issueTemp (".$year.")</p>
											<!-- HR -->
											<hr class=\"custom-art-hr\">
											<!-- Brief Description -->
											<p>Special Issue for the papers presented at the ".$data[$i]['Name']." held last ".date ("F d, Y",  strtotime($data[$i]['DeadlineSubmission']))." at ".$data[$i]['Venue']."</p>
										</div>
									</div>
								</div>";
							}
							?>
							
							
						</div>
					</div>
					<!-- Sidebar -->
					<div class="col-sm-3">
						<aside class="sidebar">

							<div class="block-sidebar-function">
								<!-- Widget Title -->
								<div class="wid-title">
									<h2>Recent Articles</h2>
									<div class="func-hr"></div>
									<div class="func-hr2"></div>
								</div>
								<!-- Widget Body -->
								<div class="wid-body">
									<ul class="posts">
										<?php //a.ArticleID, b.FirstName, b.LastName, a.Photo, a.Title, a.Content, a.CreatedAt
											for($i = 0; $i < count($data3); $i++){
												echo "<!-- Post -->
														<li>
															<!-- IMG -->
															<img src=\"".$data3[$i]['Photo']."\" style=\"max-height:120px;\">
															<!-- TITLE -->
															<a href=\"article?r=".generate_string(5).$data3[$i]['ArticleID'].generate_string(5)."\">".$data3[$i]['Title']."</a>
															<!-- DATE -->
															<div class=\"date-post-wid\">
																<span class=\"fa fa-clock-o\"></span>
																<span>".date ("F d, Y",  strtotime($data3[$i]['CreatedAt']))."</span>
															</div>
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

		<?php $this->load->view("sub-page/$web/footer"); 
		function generate_string($strength) {
			$permitted_chars = '0123456789abcdefgxyzABCDWXYZ';
			$permitted_chars_length = strlen($permitted_chars);
			$random_string = '';
			for($i = 0; $i < $strength; $i++) {
				$random_character = $permitted_chars[mt_rand(0, $permitted_chars_length - 1)];
				$random_string .= $random_character;
			}
			return $random_string;
		}
		?>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="assets/js/jquery-2.2.4.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Owl Carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- Plugins -->
	<script src="assets/js/plugins.js"></script>

</body>

</html>
