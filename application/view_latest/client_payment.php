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
										<li class="active">Edit Payment Seetings</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Edit Payment Seetings</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<?php $this->load->view('components/flash_msg'); ?>	
			</div>
		</div>
		<div class="row" style="clear:both;">
		<div class="col-md-12" >
		   <?php $this->load->view('client_menu'); ?>
		</div>
		</div>
						<div class="row" >
							<div class="col-md-12">
								<div class="row featured-boxes login">
									<div class="col-md-6 col-md-offset-3">
																		<div class="featured-box featured-box-secundary default info-content">
																			<div class="">
																				<h4>Paypal Account</h4>
																				<?php $this->load->view('components/profile_form_pay',array('profile'=>$result)); ?>	
																			</div>
																			
																		</div>
																	</div>
								</div>
								
							</div>
						</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>