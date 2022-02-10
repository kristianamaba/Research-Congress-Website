<!DOCTYPE html>
<?php
	if(empty($_GET['s']))
		header("Location: index");
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Search Result</title>
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
		
		<!-- Blog -->
		<section class="blog">
			<div class="blog-title-top">
				<div class="container">
					<!-- Title -->
					<h2><?php echo $_GET['s'];?></h2>
					<p><?php echo count($data);?> search results</p>
				</div>
			</div>
		</section>

		<!-- Blog Content -->
		<div class="blog-content" >
			<div class="container" >
				<div class="row" >
					<!-- Sidebar -->
					<div class="col-sm-3">
						<aside class="sidebar">

							<!-- Recent Posts -->
							<div class="block-sidebar-function">
								<!-- Widget Title -->
								<div class="wid-title">
									<h2>Search Filters</h2>
									<div class="func-hr"></div>
									<div class="func-hr2"></div>
								</div>
								<!-- Widget Body -->
								<div class="wid-body">
									<form>
										<ul class="posts">
											
											<li>
												<a href="#" >Sort By:</a> 
												<select class="custom-select" name="sort">
													<option value="REV" <?php if(isset($_GET['sort'])) if($_GET['sort']=="REV") echo "selected";?>>Most Relevant</option>
													<option value="DESC" <?php if(isset($_GET['sort'])) if($_GET['sort']=="DESC") echo "selected";?>>Most Recent</option>
													<option value="ASD" <?php if(isset($_GET['sort'])) if($_GET['sort']=="ASD") echo "selected";?>>Oldest First</option>
												</select>
											</li>
										
											<li>
												<a href="#" >Select Country</a>
												<?php
													$countries = array("CA" => "Canada",
																		"CN" => "China",
																		"FR" => "France",
																		"DE" => "Germany",
																		"JP" => "Japan",
																		"PH" => "Philippines",
																		"CH" => "Switzerland",
																		"UK" => "United Kingdom",
																		"US" => "United States");
													
													foreach ($countries as $key => $value) {
														// $arr[3] will be updated with each value from $arr...
														echo "<input ".(isset($_GET['country'])? (in_array($key,$_GET['country']) ? "checked":""):"")." type=\"checkbox\" name=\"country[]\" value=\"".$key."\" > ".$value." <br>";
													}
												?>
												
											</li>
											
											
											<li>
												
												<a href="#" >Select Year Range</a>
												<div class="d-flex justify-content-center my-4">
													<div class="range-field w-90">
														<input name="years" id="slider11" class="border-0" type="range" min="<?php echo date("Y")-20;?>" max="<?php echo date("Y");?>" value="<?php echo (isset($_GET['years']) ? $_GET['years'] : date("Y")-20)?>"/>
														<span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>
													</div>
													
												</div>
											</li>
											
											<li>
												<input type="hidden" name="s" value="<?php echo $_GET['s']; ?>">
												<input type="reset" class="btn btn-secondary" value="Reset">
												<input type="submit" class="btn btn-primary" value="Advanced Search">
											</li>
										</ul>
									</form>
								</div>
							</div>
						</aside>
					</div>
					<!-- Content -->
					<div class="col-sm-6" >
						<div class="row">
							<?php
								function hl($str){
									$s = $_GET['s'];
									$str = strip_tags($str);
									$words = explode(" ", $s);
									foreach ($words as $w) {
										//$temp = "nmzxbczmnbxcbcmxn";
										//$str = str_replace('"'.$w.'"', $temp, $str);
										$str = str_replace($w, "<span style='background-color:#EEEE00'>$w</span>", $str);
										$str = preg_replace("#\\b($w)\\b#i", "<span style='background-color:#EEEE00'>$1</span>", $str);
										
										//$str = str_replace($temp, '"'.$w.'"', $str);
									}
									return $str;
								}
								
								function authors ($arr){
									$string = "";
									for($i = 1; $i <= count($arr); $i++){
										if($i%2==0){
											$words = explode(" ", $arr[$i-1]);
											foreach ($words as $w) {
											  $string .= $w[0] .". ";
											}
											 $string .= ",";
										}
										else
											$string .=  $arr[$i-1] ." ";
									}
									return rtrim($string, ",");;
								}
								
								function keywords($str){
									$strTemp = "";
									$words = explode(",", $str);
									foreach ($words as $w) {
										$strTemp = "<a href=\"search?s=".trim($w)."\"> ".hl(trim($w))." </a>" . $strTemp;
										
									}
									return rtrim($strTemp, ",");;
								}
								//ConferenceID,Acronym,TopicKeywords , SubmissionID, Title, Abstract, File, Array_String
								for($i = 0; $i < count($data); $i++){
									
									$authors = (array) json_decode($data[$i]['Array_String']);
									$s_auth = authors($authors['Authors']);
									echo "<!-- Item -->
											<div class=\"col-sm-12\" >
												<div class=\"item-art\">
													<!-- IMG -->
													<div class=\"text-area\">
														<!-- DATE -->
														<a href=\"#\" onclick=\"onDownload('".generate_string(5).$data[$i]['SubmissionID'].generate_string(5)."','".$data[$i]['File']."')\" class=\"date-post-wid\">
															<span class=\"fa fa-download\"></span>
															<span>Download Research</span>
														</a>
														<!-- Title -->
														<a class=\"title-art-sub\" href=\"research?r=".generate_string(5).$data[$i]['SubmissionID'].generate_string(5)."\" style=\"padding-top:50px;\">".hl($data[$i]['Title'])."</a>
														<!-- HR -->
														<hr class=\"custom-art-hr\">
														<!-- Information -->
														<div class=\"art-info-sub\">
															<!-- Date -->
															<div class=\"art-block-sub\">
																<span class=\"fa fa-calendar-o\"></span>
																<span>".hl(date ("F d, Y",  strtotime($data[$i]['Date'])))."</span>
															</div>
															<!-- User -->
															<div class=\"art-block-sub\">
																<span class=\"fa fa-user-o\"></span>
																<a href=\"#\">".hl($s_auth)."</a>
															</div>
															<!-- Folder -->
															<div class=\"art-block-sub\">
																<span class=\"fa fa-keyboard-o\"></span>
																".keywords($data[$i]['Keywords'])."
															</div>
														</div>
														<!-- Brief Description -->
														<p>".hl(strlen($data[$i]['Abstract'])<=100 ? $data[$i]['Abstract']:  substr($data[$i]['Abstract'], 0, 100)."...")."</p>
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

		<?php $this->load->view("sub-page/$web/footer"); 
		function generate_string($strength) {
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
		
			
			function onLoad(){
				const $valueSpan = $('.valueSpan');
				  const $value = $('#slider11');
				  $valueSpan.html($value.val());
				  $value.on('input change', () => {

					$valueSpan.html($value.val());
				  });
			}
			
			window.onload = function(e){ 
				onLoad();
			}
			
			function onDownload(id,link){
				$.ajax({
					 url:baseURL+'index.php/Rcw_controller/insertIP',
					 method: 'post',
					 data: {'id':id},
					 success: function(output, status, xhr){
						 if(output=='1'){
							 window.location = link;
						 }
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
