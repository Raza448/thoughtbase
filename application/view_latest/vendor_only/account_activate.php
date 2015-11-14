<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
	<section class="page-top">
			<div class="container">
							<div class="row">
								<div class="col-md-12">
									<ul class="breadcrumb">
										<li><a href="<?=site_url() ?>">Home</a></li>
										<li class="active"> My Account</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2> Account Activation</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
					<div class="row" style="min-height:269px;">

							<div class="col-md-12">
								
					<div class="alert alert-info active_account">
						<strong style="font-size:20px;"><i class="fa fa-info-circle"></i></strong><span>Congratulations! Your account has been activated succesfully.</span>
					</div>
																					
										

							</div>
						</div>
				</div>
<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<script type="text/javascript">
$(document).ready(function() {
		$('div.navbar-collapse').addClass('in');
		$('html, body').animate({scrollTop: '0px'}, 300);
		var ab = "<?php print_r($this->session->userdata('email')) ?>"
		$('#username').val(ab);
		$('#top_password').focus();
});
</script>
<?$this->layout->block()?>