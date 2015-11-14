<?php $this->layout->block('currentPageCss'); ?>
   <!--define current page css-->
   <link rel="stylesheet" href="<?=base_url('assets/vendor/combobox/bootstrap-combobox.css') ?>">
   <link rel="stylesheet" href="<?=base_url('assets/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>">
   <link rel="stylesheet" href="<?=base_url('assets/vendor/xeditable/editable/css/bootstrap-editable.css') ?>">
   <!-- Admin Extension Specific Page Vendor CSS -->
   <link rel="stylesheet" href="<?=base_url('admin/assets/vendor/pnotify/pnotify.custom.css') ?>" />

   <!-- Admin Extension CSS -->
   <link rel="stylesheet" href="<?=base_url('admin/assets/stylesheets/theme-admin-extension.css') ?>">

   	<!-- Admin Extension Skin CSS -->
   	<link rel="stylesheet" href="<?=base_url('admin/assets/stylesheets/skins/extension.css') ?>">
	
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
<div class="container">
	<div class="col-md-9">
		<section class="panel form-wizard" id="w4">
			<header class="panel-heading">
				<!--<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
					<a href="#" class="fa fa-times"></a>
				</div>
					
				<h2 class="panel-title">Form Wizard</h2>-->
			</header>
			<div class="panel-body">
				<div class="wizard-progress wizard-progress-lg">
					<div class="steps-progress">
						<div class="progress-indicator"></div>
					</div>
					<ul class="wizard-steps">
						<li class="active">
							<a href="#w4-account" data-toggle="tab"><span>1</span>Account Info</a>
						</li>
						<li>
							<a href="#w4-profile" data-toggle="tab"><span>2</span>Profile Info</a>
						</li>
						<li>
							<a href="#w4-billing" data-toggle="tab"><span>3</span>Billing Info</a>
						</li>
						<li>
							<a href="#w4-confirm" data-toggle="tab"><span>4</span>Confirmation</a>
						</li>
					</ul>
				</div>
					
				<form class="form-horizontal" novalidate="novalidate">
					<div class="tab-content">
						<div id="w4-account" class="tab-pane active">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="w4-username">Username</label>
								<div class="col-sm-9">
									<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="username" id="w4-username" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="w4-password">Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" name="password" id="w4-password" required minlength="6">
								</div>
							</div>
						</div>
						<div id="w4-profile" class="tab-pane">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="w4-first-name">First Name</label>
								<div class="col-sm-9">
									<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="first-name" id="w4-first-name" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="w4-last-name">Last Name</label>
								<div class="col-sm-9">
									<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="last-name" id="w4-last-name" required>
								</div>
							</div>
						</div>
						<div id="w4-billing" class="tab-pane">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="w4-cc">Card Number</label>
								<div class="col-sm-9">
									<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="cc-number" id="w4-cc" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="inputSuccess">Expiration</label>
								<div class="col-sm-5">
									<select class="form-control" name="exp-month" required>
										<option>January</option>
										<option>February</option>
										<option>March</option>
										<option>April</option>
										<option>May</option>
										<option>June</option>
										<option>July</option>
										<option>August</option>
										<option>September</option>
										<option>October</option>
										<option>November</option>
										<option>December</option>
									</select>
								</div>
								<div class="col-sm-4">
									<select class="form-control" name="exp-year" required>
										<option>2014</option>
										<option>2015</option>
										<option>2016</option>
										<option>2017</option>
										<option>2018</option>
										<option>2019</option>
										<option>2020</option>
										<option>2021</option>
										<option>2022</option>
									</select>
								</div>
							</div>
						</div>
						<div id="w4-confirm" class="tab-pane">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="w4-email">Email</label>
								<div class="col-sm-9">
									<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="email" id="w4-email" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
									<div class="checkbox-custom">
										<input type="checkbox" name="terms" id="w4-terms" required>
										<label for="w4-terms">I agree to the terms of service</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<ul class="pager">
					<li class="previous disabled">
						<a><i class="fa fa-angle-left"></i> Previous</a>
					</li>
					<li class="finish hidden pull-right">
						<a>Finish</a>
					</li>
					<li class="next">
						<a>Next <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>
			</div>
		</section>
	</div>
	<div class="col-md-3">
		<aside class="sidebar">
			<hr />
			<h5>Popular Events</h5>
			<a href="#"><span class="label label-dark">Wedding</span></a>
			<a href="#"><span class="label label-dark">Travel</span></a>
			<a href="#"><span class="label label-dark">Sport</span></a>
			<a href="#"><span class="label label-dark">TV</span></a>
			<a href="#"><span class="label label-dark">Books</span></a>
			<a href="#"><span class="label label-dark">Tech</span></a>
			<a href="#"><span class="label label-dark">Adidas</span></a>
			<a href="#"><span class="label label-dark">Promo</span></a>
			<a href="#"><span class="label label-dark">Reading</span></a>
			<a href="#"><span class="label label-dark">Social</span></a>
			<a href="#"><span class="label label-dark">Books</span></a>
			<a href="#"><span class="label label-dark">Tech</span></a>
			<a href="#"><span class="label label-dark">New</span></a>
			<hr />
		</aside>
</div>
<?php $this->layout->block('currentPageJS')?>
	<!-- Current Page JS -->
	<script src="<?=base_url('assets/vendor/combobox/bootstrap-combobox.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/datetimepicker/js/moment.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/datetimepicker/js/bootstrap-datetimepicker.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/xeditable/editable/js/bootstrap-editable.js') ?>"></script>
	<script src="<?=base_url('assets/js/views/view.newPost.js') ?>"></script>	
	
	<!-- Admin Extension Specific Page Vendor -->
	<script src="<?=base_url('admin/assets/vendor/jquery-validation/jquery.validate.js') ?>"></script>
	<script src="<?=base_url('admin/assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js') ?>"></script>
	<script src="<?=base_url('admin/assets/vendor/pnotify/pnotify.custom.js') ?>"></script>

	<!-- Admin Extension -->
	<script src="<?=base_url('admin/assets/javascripts/theme.admin.extension.js') ?>"></script>

	<!-- Admin Extension Examples -->
	<script src="<?=base_url('admin/assets/javascripts/forms/examples.wizard.js') ?>"></script>
<?php $this->layout->block()?>