<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
		<header>
			<div class="container">
				<!-- Logo & Menu -->
				<div class="l-area">

					<!-- Brand and toggle get grouped for better mobile display -->
					<nav class="navbar navbar-expand-lg navbar-header">
						<!-- Logo -->
						<a class="navbar-brand" href="index">
							<img class="logo" style="height: 50px;" src="assets/img/logo.png" alt="UMAK LOGO">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
						  aria-label="Toggle navigation">
							<span class="navbar-toggler-icon">
								<i class="fa fa-bars"></i>
							</span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse custo-drp-res" id="navbarNav">
							<!-- Menu -->
							<ul class="navbar-nav menu">
								<!-- Home -->
								<li>
									<a href="index">Home</a>
								</li>
								<!-- About us -->
								<li class="dropdown">
									<a class="dropdown-toggle" id="dLabel-services" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About us
										<span class="fa fa-angle-down mrg-l"></span>
									</a>
									<ul class="dropdown-menu custom" aria-labelledby="dLabel-services">
										<li>
											<a href="about">
												<span class="fa fa-group menu-ser"></span>Vision & Mission</a>
										</li>
										<li>
											<a href="faq">
												<span class="fa fa-book menu-ser"></span>FAQ</a>
										</li>
										<li>
											<a href="terms">
												<span class="fa fa-balance-scale menu-ser"></span>Terms and Condition</a>
										</li>
										<li>
											<a href="#contacts">
												<span class="fa fa-volume-control-phone menu-ser"></span>Contacts</a>
										</li>
									</ul>
								</li>

								<li class="dropdown">
									<a class="dropdown-toggle" id="dLabel-services" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferences
										<span class="fa fa-angle-down mrg-l"></span>
									</a>
									<ul class="dropdown-menu custom" aria-labelledby="dLabel-services">
										<li>
											<a href="conferences">
												<span class="fa fa-list menu-ser"></span>Conferences List</a>
										</li>
										<li>
											<a href="archives">
												<span class="fa fa-archive menu-ser"></span>Archives</a>
										</li>
										<li>
											<a href="about-conference">
												<span class="fa fa-info-circle menu-ser"></span>About Conferences</a>
										</li>
									</ul>
								</li>
								 <li> <a href="tracking">Tracking</a> </li>
								<?php
									if($this->session->userdata('LoggedIn')=="1")
										echo "<!-- About us -->
												<li class=\"dropdown\">
													<a class=\"dropdown-toggle\" id=\"dLabel-services\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">My Account
														<span class=\"fa fa-angle-down mrg-l\"></span>
													</a>
													<ul class=\"dropdown-menu custom\" aria-labelledby=\"dLabel-services\">
														<li>
															<a href=\"history\">
																<span class=\"fa fa-history menu-ser\"></span>History</a>
														</li>
														<li>
															<a href=\"profile\">
																<span class=\"fa fa-address-card menu-ser\"></span>Profile</a>
														</li>
														<li>
															<a href=\"logout\">
																<span class=\"fa fa-sign-out menu-ser\"></span>Logout</a>
														</li>
													</ul>
												</li>";
									else
										echo "<!-- Login --> <li> <a href=\"login\">Login</a> </li>";
									
										
								?>
								
								
								
							</ul>
						</div>
					</nav>
				</div>
				<!-- SocialMedia -->
				<div class="s-area">
					<ul class="navbar-nav menu">
						<li>
							<div>
							<input id="search" style="width: 70%;" value="<?php if(isset($_GET['s'])) echo $_GET['s'];?>" type="text" placeholder="Search Research.." class="search-box-inp" onkeyup="if (event.keyCode === 13) { location.href = 'search?s='+this.value; }">
							<input type="button"  style="height: 40px;width: 40px;"  onclick="location.href = 'search?s='+document.getElementById('search').value;" value="&#xf002;" class="search-box-sub">
							</div>
						</li>
					</ul>
				</div>
			</div>
		</header>