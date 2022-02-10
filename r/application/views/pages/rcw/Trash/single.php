<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Single</title>
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
					<div class="col-sm-9">
						<div class="content-x">
							<!-- Item -->
							<div class="item-art">
								<!-- IMG -->
								<img class="article-page-img" src="assets/img/blog/1.jpg" alt="x-data">
								<!-- Format -->
								<a class="art-format custom-bg-p1" href="#">Blog Type</a>
								<div class="clearfix"></div>
								<div class="text-area">
									<!-- Title -->
									<a class="title-art-sub" href="single">10 Great Books for the Lady Boss in Your Life</a>
									<!-- HR -->
									<hr class="custom-art-hr">
									<!-- Information -->
									<div class="art-info-sub">
										<!-- Date -->
										<div class="art-block-sub">
											<span class="fa fa-calendar-o"></span>
											<span>Monday, June 26, 2017</span>
										</div>
										<!-- User -->
										<div class="art-block-sub">
											<span class="fa fa-user-o"></span>
											<a href="#">Abdelrahman</a>
										</div>
										<!-- Folder -->
										<div class="art-block-sub">
											<span class="fa fa-folder-o"></span>
											<a href="#">Classic</a>
										</div>
									</div>
									<!-- Brief Description -->
									<div class="body-article">
										<p>Inspiration: the one thing that all successful people have in common. Sometimes that spark comes from real-life
											heroines. Other times, the best motivators are found in the pages of books.
											<br>
											<br> In honor of International Women’s Day, we’ve put together a list of best-sellers that will empower and entertain
											the high-powered ladies in your life. Let’s get inspired!
										</p>
										<br>
										<br>
										<blockquote>
											10 Great Books for the Lady Boss in Your Life
										</blockquote>
										<br>
										<h1>1. Rookie Smarts: Why Learning Beats Knowing in the New Game of Work</h1>
										<br>
										<p>In today’s marketplace, the ability to keep learning is a more valuable than absolute mastery. This book is a great
											read for any business leader who wants to keep her workplace skills fresh and thriving.</p>
										<br>
										<br>
										<img src="assets/img/blog/1.jpg" alt="x-data">
										<br>
										<br>
										<p>If you’re wondering where a best-selling female author gets her inspiration, take a peek at this list of nine books.</p>
									</div>
								</div>
							</div>
						</div>
						<!-- Author -->
						<div class="author-blog">
							<!-- IMG -->
							<img src="assets/img/users/1.jpg" alt="Author">
							<div class="details-author">
								<!-- User -->
								<a href="#">Admin</a>
								<!-- Information -->
								<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Vestibulum ac vehicula leo. Donec urna lacus gravida ac vulputate
									sagittis tristique vitae lectus. Nullam rhoncus tortor at dignissim vehicula.</p>
								
							</div>
						</div>

						
					</div>

					<!-- Sidebar -->
					<div class="col-sm-3">
						<aside class="sidebar">

							

							<!-- Recent Posts -->
							<div class="block-sidebar-function">
								<!-- Widget Title -->
								<div class="wid-title">
									<h2>Recent Posts</h2>
									<div class="func-hr"></div>
									<div class="func-hr2"></div>
								</div>
								<!-- Widget Body -->
								<div class="wid-body">
									<ul class="posts">

										<!-- Post -->
										<li>
											<!-- IMG -->
											<img src="assets/img/blog/2.jpg" alt="x-data">
											<!-- TITLE -->
											<a href="single">2017 Decorators opens with home design inspiration</a>
											<!-- DATE -->
											<div class="date-post-wid">
												<span class="fa fa-clock-o"></span>
												<span>Mar 22, 2015</span>
											</div>
										</li>

										<!-- Post -->
										<li>
											<!-- IMG -->
											<img src="assets/img/blog/3.jpg" alt="x-data">
											<!-- TITLE -->
											<a href="single">2017 Decorators opens with home design inspiration</a>
											<!-- DATE -->
											<div class="date-post-wid">
												<span class="fa fa-clock-o"></span>
												<span>Mar 22, 2015</span>
											</div>
										</li>

										<!-- Post -->
										<li>
											<!-- IMG -->
											<img src="assets/img/blog/1.jpg" alt="x-data">
											<!-- TITLE -->
											<a href="single">2017 Decorators opens with home design inspiration</a>
											<!-- DATE -->
											<div class="date-post-wid">
												<span class="fa fa-clock-o"></span>
												<span>Mar 22, 2015</span>
											</div>
										</li>
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
