<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer class="footer">
			<!-- Contact -->
			<div class="contact" id="contacts">
				<!-- Map -->
				<div class="map">
					<span class="fa fa-map-marker cont"></span>
					<span>J.P. Rizal Ext, Makati, 1215 Metro Manila</span>
				</div>
				<!-- Phone -->
				<div class="phone">
					<span class="fa fa-phone cont"></span>
					<span>+(02) 8883 1860</span>
				</div>
				<!-- Mail -->
				<div class="mail">
					<span class="fa fa-envelope cont"></span>
					<a href="mailto:ufro@umak.edu.ph" target="_top">ufro@umak.edu.ph</a>
				</div>
				<!-- Live Chat -->
				<div class="l-chat">
					<span class="fa fa-headphones cont"></span>
					<a href="https://www.facebook.com/messages/t/102127545036540">Message us</a>
				</div>
			</div>
			<!-- Footer Lv2 -->
			<div class="f-lv2">
				<div class="container" >
					<div class="row">
						<!-- About -->
						<div class="col-lg-6 col-sm-3">
							<div class="about">
								<!-- Brand -->
								<img src="assets/img/logo-b.png" style="height: 50px;" alt="X-Data">
								<!-- iNFO -->
								<p>
									The University of Makati (UMak) is a public, locally funded university of the local government of Makati. It is envisioned as the primary instrument where university education and industry training programs interface to mold Makati and non-Makati youth into productive citizens and IT-enabled professionals who are exposed to the cutting edge of technology in their areas of specialization. UMak is the final stage of Makati City's integrated primary level to tertiary level educational system that enables its less privileged citizens to compete for job opportunities in various businesses and industries.
								</p>
								<!-- Links -->
								<a href="terms">Terms |</a>
								<a href="policy">Policy</a>
								<!-- CopyRights -->
								<h4>© 2021 University of Makati. All rights reserved.</h4>
							</div>
						</div>
						<!-- Help -->
						<div class="col-lg-2 col-sm-3">
							<div class="links-foot">
								<h2>Help</h2>
								<ul>
									<li>
										<a href="https://www.facebook.com/messages/t/102127545036540">Chat us</a>
									</li>
									<li>
										<a href="faq">Faq</a>
									</li>
									<li>
										<a href="#contacts">Contact</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- NewsLetter -->
						<div class="col-lg-4 col-sm-3">
							<div class="links-foot">
								<h2>Need Help?</h2>
								<p>
									Message our Tech Support here.
								</p>
								<form id="ask-help">
									<input class="form-control mb-3" type="email" name="email" placeholder="Your Email">
									<input class="form-control mb-3" type="text" name="subject"  placeholder="Subject">
									
									<textarea placeholder="Enter Message" rows="5" name="message" class="form-control mb-3" ></textarea>
									<input class="sub-news" onclick="onAskHelp()" type="button" value="Send Message" >
								<form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<script>
			var baseURL="<?php echo base_url();?>";
			function onAskHelp(){
				$.ajax({
					 url:baseURL+'index.php/Rcw_controller/askMail',
					 method: 'post',
					 data: $("#ask-help").serialize(),
					 success: function(output, status, xhr){
						if(output==1){
							sAlert("Message Sent!\nPlease Expect a reply within a few days.", '');
							document.getElementById("ask-help").reset();
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