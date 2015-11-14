<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<style>
.alert .fa {
    font-size: 28px;
    float: left;
    height: 50px;
    margin: 7px 10px 0 0;
}
</style>
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
	<section class="page-top">
			<div class="container">
							<div class="row">
								<div class="col-md-12">
									<ul class="breadcrumb">
										<li><a href="<?=site_url() ?>">Home</a></li>
										<li class="active">Confirm your E-mail address</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Confirm your E-mail address</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
			<div class="row">
				<div class="col-md-12">
						<?php $this->load->view('components/flash_msg'); ?>	
						<?php $this->load->view('components/form_message'); ?>	
				</div>
			</div>
						<div class="row" style="min-height:269px;">
							<div class="col-md-12">
								
					<div class="alert alert-info">
						<strong style="font-size:20px;"><i class="fa fa-info-circle"></i></strong>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.
					</div>
																					
										

							</div>
						</div>
		</div>
<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>