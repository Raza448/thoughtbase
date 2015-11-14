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

										<li class="active">Reset Password</li>

									</ul>

								</div>

							</div>

							<div class="row">

								<div class="col-md-12">

									<h2>Reset Password</h2>

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

						<div class="row">

							<div class="col-md-12">

								<div class="row featured-boxes login">

									<div class="col-md-6">

										<div class="featured-box featured-box-secundary default info-content">

											<div class="box-content">

												

												<form action="<?=site_url('main/reset_password/'.$this->session->userdata('token')) ?>" id="login" method="post"  onsubmit="return reset_valid();">

													<div class="row">

														<div class="form-group">

															<div class="col-md-12">

																<label>New Password</label>

																<input name="pass" type="password" value="<?php echo set_value('password'); ?>" class="form-control input-lg" id="pass">

															</div>

														</div>
														
														<div class="form-group">

															<div class="col-md-12">

																<label>Confirm Password</label>

																<input name="confirm_pass" type="password" value="<?php echo set_value('confirm_pass'); ?>" class="form-control input-lg" id="confirm_pass">

															</div>

														</div>

													</div>

													<div class="row">

														

														<div class="col-md-12">

															<input type="submit" value="Submit" class="btn btn-default pull-left push-bottom" name="reset" data-loading-text="Loading...">

														</div>

													</div>

													

												</form>

											</div>

										</div>

									</div>

								</div>



							</div>

						</div>

<?$this->layout->block('currentPageJS')?>

		<!-- Current Page JS -->

<?$this->layout->block()?>