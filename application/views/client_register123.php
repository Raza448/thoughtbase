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
										<li class="active">Register</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Register</h2>
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
		<form action="<?php echo site_url('main/userRegister'); ?>" id="register" method="POST" type="post">
																				  <input type="hidden" name="disable_flag" value="1" />
						<div class="row">
						<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;min-height:850px;">
							<li class="col-md-6 " >
								
							<h4>Register An Account</h4>
						<ul class="portfolio-list">
						 <li class="col-md-5 ">
						 Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
						 Quisque rutrum pellentesque imperdiet. Nulla lacinia 
						 iaculis nulla non pulvinar. Cum sociis natoque penatibus 
						 et magnis dis parturient montes, nascetur ridiculus mus. 
						 Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus<br />
						 Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
						 Quisque rutrum pellentesque imperdiet. Nulla lacinia 
						 iaculis nulla non pulvinar. Cum sociis natoque penatibus 
						 et magnis dis parturient montes, nascetur ridiculus mus. 
						 Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus
						 
						 </li>
						 <li class="col-md-1 ">
						  <h4>Interests</h4>
						  <?php 
						    $query = "select * from interests";
						    $out   = $this->db->query($query);
							$z     = $out->result_array();
						    if(count($z)>0){
							$i=0;
							foreach($z as $ry => $y ){
						  ?>
						    <label style="float:left"><?php echo $y['name']; ?></label>
						    <input style="float:left" name="interest[<?php echo $i; ?>]" <?php if(isset($_POST['interest'][$i]) && $_POST['interest'][$i] == $y['id'] ){ ?> checked <?php } ?> class="form-control input-lg" type="checkbox" value="<?php echo $y['id'];  ?>">
						  <?php 
						   $i++;}}
						  ?>
						 </li> 
						</ul>
						</li>
							<li class="col-md-6 " >
						<h4>&nbsp;</h4>
						   <div >
																		<div >
																			<div>
																				
																				
																				<div class="row">
	<div class="form-group">
		<div class="col-md-6">
		<label>Age Range</label>	<br />
         <select name="age" class="form-control input-lg">
         <option value="1" <?php if(isset($_POST['age']) && $_POST['age'] == 1  ){ ?> selected <?php } ?>  >12 - 17</option>
		 <option value="2" <?php if(isset($_POST['age']) && $_POST['age'] == 2  ){ ?> selected <?php } ?> >18 - 24</option>
		 <option value="3" <?php if(isset($_POST['age']) && $_POST['age'] == 3  ){ ?> selected <?php } ?> >25 - 34</option>
		 <option value="4" <?php if(isset($_POST['age']) && $_POST['age'] == 4  ){ ?> selected <?php } ?> >35 - 44</option>
		 <option value="5" <?php if(isset($_POST['age']) && $_POST['age'] == 5 ){ ?> selected <?php } ?> >45 - 54</option>
		 <option value="6" <?php if(isset($_POST['age']) && $_POST['age'] == 6  ){ ?> selected <?php } ?> >55 - 64</option>
		 <option value="7" <?php if(isset($_POST['age']) && $_POST['age'] == 7  ){ ?> selected <?php } ?> >65+</option>
	   </select>			
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-6">
		<label>Gender</label>	<br />
         <select name="gender" class="form-control input-lg">
         <option value="male" <?php if(isset($_POST['gender']) && $_POST['gender'] == "male"  ){ ?> selected <?php } ?> >Male</option>
		 <option value="female" <?php if(isset($_POST['gender']) && $_POST['gender'] == "female"  ){ ?> selected <?php } ?> >Female</option>
	   </select>			
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Zipcode</label>
			<input name="zipcode" type="zipcode" value="<?php echo set_value('zipcode',(isset($zipcode) ? $zipcode:'')); ?>" required class="form-control input-lg"><br />
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Paypal E-mail Address*</label>
			<input name="email" type="email" autocorrect="off" autocapitalize="none"  value="<?php echo set_value('email',(isset($email) ? $email:'')); ?>" required class="form-control input-lg"><br />
			Dont have a paypal account
			<a href="https://www.paypal.com/" target="_blank">Click here to register</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Password*</label>
			<input name="password" type="password"  autocorrect="off" autocapitalize="none" id="password" value="<?php echo set_value('password'); ?>" class="form-control input-lg"  >
		</div>
		</div>
		</div>
<div class="row">
	<div class="form-group">		
		<div class="col-md-6">
			<label>Re-enter Password*</label>
			<input name="confirm_password" type="password"  autocorrect="off" autocapitalize="none" value="<?php echo set_value('confirm_password'); ?>"  class="form-control input-lg"  >
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Verify you're human</label>
			<?php echo $image; ?>
			<input type="hidden" name="ocaptcha" value="<?php echo $word; ?>" class="form-control input-lg"  >
		<br />
			<label>Enter text from the image</label>
			<input name="captcha" type="text"  value=""  class="form-control input-lg"  >
		</div>
	</div>
</div>
																				<div class="row">
																					<div class="col-md-6">
																						<input type="submit" value="Register" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
																					</div>
																				</div>
																			
																			</div>
																		</div>
																	</div>
								
						
						
							</li>
						</ul>
						
						
									
							
									
							
								
								
				
								<!--- --->
								
								
								
					
					</div>
						</form>
					</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>