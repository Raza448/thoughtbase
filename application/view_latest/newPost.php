<?php $this->layout->block('currentPageCss'); ?>
   <!--define current page css-->
   <link rel="stylesheet" href="<?=base_url('assets/vendor/combobox/bootstrap-combobox.css') ?>">
   <link rel="stylesheet" href="<?=base_url('assets/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>">
   <link rel="stylesheet" href="<?=base_url('assets/vendor/xeditable/editable/css/bootstrap-editable.css') ?>">
   
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
	<section class="page-top">
			<div class="container">
							<div class="row">
								<div class="col-md-12">
									<ul class="breadcrumb">
										<li><li><a href="<?=site_url() ?>">Home</a></li></li>
										<li class="active">Get Quotes</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Get Quotes</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
<!--  Page content -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<?php $this->load->view('components/flash_msg'); ?>	
						<?php $this->load->view('components/form_message'); ?>	
				
			</div>
		</div>

		<h3 >1. Please tell us about your requirements</h3>
		<div class="row">
			<div class="col-md-8">
				<?php $this->load->view('components/newPost_form'); ?>
			</div>
				<div class="col-md-4">
					<div class="featured-box featured-box-secundary default info-content">
					<div class="box-content">
					<h4>Popular Services/Products</h4>
					<div class="row">
						<div class="col-md-12">
						<span class="label label-primary">Photo Both (1000)</span>
						<span class="label label-primary">BBQ Catering (900)</span>
						<span class="label label-primary">Photography (500)</span>
						<span class="label label-primary">Event T-shirt (300)</span>
					</div>
					<div class="row">&nbsp;</div><div class="row">&nbsp;</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	
	<?php if(!$this->session->userdata('clientAuth')){ ?>
				<hr>
				<h3>2. Please create your Account</h3>
			<div class="row">
				<div class="col-md-8">	
							<?php $this->load->view('components/register_form'); ?>		
				</div>
				<div class="col-md-4">
					<div class="featured-box featured-box-secundary default info-content">
					<div class="box-content">
						
					<h4>or Sign up with</h4>
					<div class="row">
						<div class="col-md-12">
						<button type="button" class="btn btn-default pull-center push-bottom" style="color:#428bca !important"><i class="icon icon-facebook-square"></i>&nbsp;&nbsp;Sign Up with Facebook</button>
					</div>
					<div class="row"><p>We don't post to Facebook without asking</p></div><div class="row">&nbsp;</div>
					</div>
					</div>
					</div>
				</div>
			</div>
			
	<?php } ?>		
		
		<hr class="short">
		<div class="row">
			<div class="col-md-12">
				<p>By clicking "Get my Free Quotes" button below, you declare you have read and agreed to eventbites.sg's User Agreement and Privacy Policy.</p>
		
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type="submit" value="Get My Free Quotes" class="btn btn-primary btn-lg pull-left push-bottom" 				data-loading-text="Loading...">
			</div>
			
		</div>

<?php $this->layout->block('currentPageJS')?>
	<!-- Current Page JS -->
	<script src="<?=base_url('assets/vendor/combobox/bootstrap-combobox.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/datetimepicker/js/moment.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/datetimepicker/js/bootstrap-datetimepicker.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/xeditable/editable/js/bootstrap-editable.js') ?>"></script>
	<script src="<?=base_url('assets/js/views/view.newPost.js') ?>"></script>
	
	
<?php $this->layout->block()?>