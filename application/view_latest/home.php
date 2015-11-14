<?$this->layout->block('breadcrumbs')?>

<?$this->layout->block()?>

<!--page content -->
		<div class="home-intro light secundary">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<h1 class="title"><span>Users Get Paid. <br />Businesses Get Answers.</span></h1>
						<p>
							<span class="intro">ThoughtBase is a platform that enables businesses and organizations to gain insights from consumers, who get instant cash payments for submitting their feedback on products, services, issues, and ideas.</span><br />
							<span class="intro">Check out the video to learn more.</span>
						</p>
						<div class="home_video">
							<video poster="<?php echo base_url() ?>/assets/img/video_thumb.png" style="cursor:pointer;" id="video1" onClick="playPause();" >
							  <source src="<?php echo base_url() ?>/assets/video/TB_Video_SD.mp4" type="video/mp4">
							  <source src="<?php echo base_url() ?>/assets/video/TB_Video_SD.ogg" type="video/ogg">
							  Your browser does not support HTML5 video.
							</video>
							<!--<p>
							<span>ThoughtBase is a platform that enables vendorses and organizations to gain insights from consumers, who get instant cash payments for submitting their feedback on products, services, issues, and ideas.</span>
							<span>Check out the video to learn more.</span>
							</p>-->
							
						</div>
					</div>

					<div class="col-md-5">
						<div class="home_bottom">
							<span class="user_title">Users</span><br />
							<div class="home_bottom_right">
								<p>
									<span>Create your anonymous ThoughtBase account now and start making money.  Our queries are quick and easy to complete from your desktop or mobile device, and you'll receive instant cash payments deposited into your PayPal account.</span>
								</p>
								<div class="button">
								<a  href="<?=site_url('main/userRegister') ?>" class="register_button">
									Get Started 
								</a>
								</div>
							</div>
						</div>
						<div class="home_bottom">
							<span class="business_title">BUSINESSES</span><br />
							<div class="business home_bottom_right">
								<p>
									<span>Create targeted queries in 3 easy steps from your desktop or mobile device, and get the answers you need with comprehensive, sortable feedback from our users or your own customers.</span>
								</p>
								<div class="button">
								<a  href="<?=site_url('main/businessRegister') ?>" class="register_button">
									Get Started 
								</a>
								</div>
							</div>
						</div>	
					</div>
					<!--<div class="col-md-4">
						<div class="get-started">
							<a href="<?=site_url('main/userLogin') ?>"" class="btn btn-lg btn-primary">Get Started Now!</a>
							<div class="learn-more">or <a data-hash href="#learnMore">learn more.</a></div>
						</div>
					</div>-->
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="about_details">
							<span>About ThoughtBase</span>
							<p style="text-align:justify;">
								Founded in 2015, our mission is to provide businesses and organizations with a fast and efficient way to get feedback from existing or potential customers.  By compensating them for their time and protecting their privacy, consumers will be motivated to give their feedback, and businesses will benefit from higher return rates and better data, allowing them to stay tuned to market needs.
							</p>
						</div>
					</div>
					<div class="col-md-5">
						<div class="contact_details">
						<span>Contact</span>
							<p>
								<strong>ThoughtBase Inc.</strong><br />							
								<strong>A California Company</strong><br />
								<strong><a href="mailto:contact@thoughtbase.com" style="color:#fff;"><?php echo $contact_email ?></a></strong><br />
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--<div id="learnMore" class="container">
			<div class="row center">
				<div class="col-md-12">
					<h2 class="short word-rotator-title">
						Survey is
						<strong class="inverted">
							<span class="word-rotate">
								<span class="word-rotate-items">
									<span>simple</span>
									<span>convinent</span>
									<span>free</span>
								</span>
							</span>
						</strong>
						Lorem ipsum dolor sit amet
					</h2>
					<p class="featured lead">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
					</p>
				</div>
			</div>
		</div>-->
		<!--<div class="home-concept">
			<div class="container">
				
				<div class="row center">
				<div class="col-md-6">
				<h1>Lorem Ipsum Dolor Sit Amet Consectetur Adip</h1>
				<p class="featured lead">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
					</p>
					<div class="button">
					<a  href="#" class="register_button">
								Learn More >
							</a>
					</div>
					<!--<span class="sun"></span>
					<span class="cloud"></span>
					<div class="col-md-2 col-md-offset-1">
						<div class="process-image" data-appear-animation="bounceIn">
							<br/>
							<strong>Select Requireme</strong>
						</div>
					</div>
					<div class="col-md-2">
						<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="200">
							<br/>
							<strong>create Survey</strong>
						</div>
					</div>
					<div class="col-md-2">
						<div class="process-image" data-appear-animation="bounceIn" data-appear-animation-delay="400">
							<br/>
							<strong>Post!</strong>
						</div>
					</div>
					<div class="col-md-4 col-md-offset-1">
						<div class="project-image">
							<br/><br/><br/><br/><br/>
							<strong class="our-work">Get Survey</strong>
						</div>
					</div>-->
				<!--</div>
			</div>
		
			</div>
		</div>-->
<!--page content end-->

<?$this->layout->block('currentPageJS')?>
	<!-- Current Page JS -->
	<script src="<?=base_url('assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/rs-plugin/js/jquery.themepunch.revolution.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/circle-flip-slideshow/js/jquery.flipshow.js') ?>"></script>
	<script src="<?=base_url('assets/js/views/view.home.js') ?>"></script>
	
<script> 
var myVideo=document.getElementById("video1"); 

function playPause()
{ 
if (myVideo.paused) 
  myVideo.play(); 
else 
  myVideo.pause(); 
} 
</script>
<?$this->layout->block()?>