<?php extract($result); ?>
<form action="<?php echo site_url('business/profile'); ?>" id="register-form" novalidate="novalidate" method="POST" type="post">
<input type="hidden" name="act" value="editaccount" />
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Company Name <span class="mandatory">*</span></label>
			<input name="userName" type="text"  id="company" value="<?php echo set_value('userName',(isset($name) ? stripslashes($name):'')); ?>" class="form-control input-lg" required pattern="[a-zA-Z ]+" />
			<div id="results-company" class="results error"></div>
			<div id="errorcontainer-company" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Company Description <span class="mandatory">*</span></label>
			<textarea  name="company" id="company_desc" class="form-control input-lg" required><?php echo set_value('company',(isset($company_name) ? stripslashes($company_name):'')); ?></textarea>
			<div id="results-company_desc" class="results error"></div>
			<div id="errorcontainer-company_desc" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>First Name <span class="mandatory">*</span></label>
			<input name="fname" type="text"  id="fname" value="<?php echo set_value('fname',(isset($fname) ? $fname:'')); ?>" class="form-control input-lg" required pattern="[a-zA-Z ]+" />
			<div id="results-fname" class="results error"></div>
			<div id="errorcontainer-fname" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Last Name <span class="mandatory">*</span></label>
			<input name="lname" type="text"  id="lname" value="<?php echo set_value('lname',(isset($lname) ? $lname:'')); ?>" class="form-control input-lg" required pattern="[a-zA-Z ]+" />
			<div id="results-lname" class="results error"></div>
			<div id="errorcontainer-lname" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Address Line 1 <span class="mandatory">*</span></label>
			<textarea  name="uen" id="addr1" class="form-control input-lg"><?php echo set_value('uen',(isset($uen) ? stripslashes($uen):'')); ?></textarea>
			<div id="results-addr1" class="results error"></div>
			<div id="errorcontainer-addr1" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Address Line 2</label>
			<textarea  class="form-control input-lg" id="addr2" name="addr" required><?php echo set_value('addr',(isset($addr) ? stripslashes($addr):'')); ?></textarea>
			<div id="results-addr2" class="results error"></div>
			<div id="errorcontainer-addr2" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>City <span class="mandatory">*</span></label>
			<input name="city" type="text"  id="city" value="<?php echo set_value('city',(isset($city) ? $city:'')); ?>" class="form-control input-lg" required pattern="[a-zA-Z ]+" />
			<div id="results-city" class="results error"></div>
			<div id="errorcontainer-city" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>State <span class="mandatory">*</span></label>
			<input name="state" type="text"  id="state" value="<?php echo set_value('state',(isset($state) ? $state:'')); ?>" class="form-control input-lg" />
			<div id="results-state" class="results error"></div>
			<div id="errorcontainer-state" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Zip <span class="mandatory">*</span></label>
			<input type="number" name="zip" id="zip" value="<?php echo set_value('zip',(isset($zip) ? $zip:'')); ?>" required  class="form-control input-lg" />
			<div id="results-zip" class="results error"></div>
			<div id="errorcontainer-zip" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Country <span class="mandatory">*</span></label>
 <?php $vvk = set_value('country',(isset($country) ? $country : '')); ?>
			<select name="country" required="required" required class="form-control input-lg">
				<?php
                    $jm = $this->db->query('select * from countries')->result_array();
                    foreach($jm as $re => $pp ){
				 ?>
                      <option   <?php if( $vvk == $pp['country_code'] ){ ?>  selected <?php } ?>   value="<?php echo $pp['country_code']; ?>"><?php echo $pp['country_name']; ?></option>
                 <?php } ?>
            </select>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Contact Number <span class="mandatory">*</span></label>
			<input name="contact_number" type="text"  id="contact_number" data-inputmask="'mask': ['(999)-999-9999']" value="<?php echo set_value('contact_number',(isset($contact_number) ? $contact_number:'')); ?>" class="form-control input-lg" required />
			<div id="errorcontainer-contact_number" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>E-mail Address <span class="mandatory">*</span></label><br />
			<input name="vendor_email" type="email" autocorrect="off" autocapitalize="none"  id="email" value="<?php echo set_value('email',(isset($email) ? $email:'')); ?>" class="form-control input-lg" readonly required />
			<div id="results-email" class="results error"></div>
			<div id="errorcontainer-email" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-md-12">
    <input type="submit" value="Update Account" id="update" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
  </div>
</div>
</form>
<form action="" id="change-pass-form" novalidate="novalidate" method="POST" type="post">
<input type="hidden" name="act" value="changepassword"  />
<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>New Password <span class="mandatory">*</span></label>
			<input name="password" type="password"  autocorrect="off" autocapitalize="none" id="password" value="" class="form-control input-lg"  >
			<div id="errorcontainer-password" class='errorDiv'></div>
		</div>
		<div class="col-md-6">
			<label>Re-enter Password <span class="mandatory">*</span></label>
			<input name="confirm_password" type="password"  autocorrect="off" autocapitalize="none" id="confirm_pass" value=""  class="form-control input-lg"  >
			<div id="errorcontainer-confirm_pass" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-md-12">
    <input type="submit" value="Change Password" class="btn btn-primary pull-right" data-loading-text="Loading...">
  </div>
</div>
</form>