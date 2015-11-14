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
										<li class="active">Registration Confirmation</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Registration Confirmation</h2>
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
						<div class="row" style="height:300px;">
							<div class="col-md-12">
								
					<div class="alert alert-info ">
						<strong style="font-size:20px;"><i class="fa fa-info-circle"></i></strong>&nbsp;&nbsp;Thank you for registering!. <a href="<?php echo site_url(); ?>/main/userLogin">Click here</a> to login into your account.
					</div>
																					
										

							</div>
						</div>
<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>