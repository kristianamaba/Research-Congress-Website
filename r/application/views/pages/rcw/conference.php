<!DOCTYPE html>
<?php
if(!isset($_GET['id']))
	header('Location: ./conferences');
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Conference Details</title>
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
					<!-- Content -->
					<div class="col-sm-9" id="conference-content">
						<?php
							function keywords($str){
									$strTemp = "";
									$words = explode(",", $str);
									foreach ($words as $w) {
										$strTemp = "<a href=\"search?s=".trim($w)."\">".trim($w)."</a>" . $strTemp;
										
									}
									return rtrim($strTemp, ",");;
							}
							if(!isset($data)){
								header("Location: conferences");
							}
							if(count($data)>=1)
								echo "<div class=\"content-x\">
												<!-- Item -->
												<div class=\"item-art\">
													<!-- Format -->
													<a class=\"art-format custom-bg-p".($data[0]['DeadlineSubmission']>=date('Y-m-d') ? "1\" ".(isset($confirm) ? ($confirm >=1 ? "onclick=\"fAlert('One Submission Per Day Only');\" href='#'":"href=\"submit-now?id=".$data[0]['Acronym']."\"") : "href=\"submit-now?id=".$data[0]['Acronym']."\"").">Submit Now":"3\" href=\"#\">Submission Ended")."</a>
													<div class=\"clearfix\"></div>
													<div class=\"text-area\">
														<!-- Title -->
														<a class=\"title-art-sub\" href=\"#\" style=\"padding-top:60px;\">".$data[0]['Name']."</a>
														Venue: ".$data[0]['Venue']."
														<!-- HR -->
														<hr class=\"custom-art-hr\">
														<!-- Information -->
														<div class=\"art-info-sub\">
															<!-- Date -->
															<div class=\"art-block-sub\">
																<span class=\"fa fa-calendar-o\"></span>
																<span>".date ("F d, Y",  strtotime($data[0]['DeadlineSubmission']))."</span>
															</div>
															<!-- User -->
															<div class=\"art-block-sub\">
																<span class=\"fa fa-credit-card\"></span>
																<a href=\"#\">".$data[0]['Acronym']."</a>
															</div>
															<!-- Folder -->
															<div class=\"art-block-sub\">
																<span class=\"fa fa-keyboard-o\"></span>
																".keywords($data[0]['TopicKeywords'])."
															</div>
														</div>
														<table class=\"table\">
															<tbody>
															  <tr>
																<th>Abstract registration deadline</th>
																<td>".date ("F d, Y",  strtotime($data[0]['DeadlineAbstract']))."</td>
															  </tr>
															  <tr>
																<th>Submission deadline</th>
																<td>".date ("F d, Y",  strtotime($data[0]['DeadlineSubmission']))."</td>
															  </tr>
															</tbody>
														  </table>
														<!-- Brief Description -->
														<div class=\"body-article\">
															<p>".str_replace("\n", '<br>', $data[0]['ConfDesc'])."</p>
															<br>
															<br>
															<blockquote>
																Conference Details
															</blockquote>
															<p>".str_replace("\n", '<br>', $data[0]['ConfDetails'])."</p>
															<br>
															<br>
															<blockquote>
																Topics
															</blockquote>
															<p><ul><li>".str_replace(",", '</li><li>', ucwords($data[0]['TopicKeywords']))."</li></ul>
															</p>
															<br>
															<br>
															
															<blockquote>
																Contact Person
															</blockquote>
															Name: ".$data[0]['ContactPerson']." <br>
															Email: ".$data[0]['ContactEmail']."
															</p>
															<br>
															<br>
															
														</div>
													</div>
												</div>
											</div>
											<!-- Author -->
											<div class=\"author-blog\">
												<div class=\"details-author\" style=\"margin:0px;\">
													<!-- User -->
													<a href=\"#\">Speakers</a>
													<!-- Information -->
													<p>".str_replace("\n", '<br>', $data[0]['Speakers'])."</p><br><br>

													<!-- User -->
													<a href=\"#\">Committees</a>
													<!-- Information -->
													<p>".str_replace("\n", '<br>', $data[0]['Committees'])."</p>
													
												</div>
											</div>";
							else
								header("Location: conferences");
						?>

						
					</div>

					<!-- Sidebar -->
					<div class="col-sm-3">
						<aside class="sidebar">

							

							<!-- Recent Posts -->
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
