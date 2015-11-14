<div class="row">
	<div class="form-group">
		<div class="col-md-6">
		<label>Age Range</label>	<br />
         <select name="age" class="form-control input-lg">
         <option value="1">12 - 17</option>
		 <option value="2">18 - 24</option>
		 <option value="3">25 - 34</option>
		 <option value="4">35 - 44</option>
		 <option value="5">45 - 54</option>
		 <option value="6">55 - 64</option>
		 <option value="7">65+</option>
	   </select>			
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-6">
		<label>Gender</label>	<br />
         <select name="gender" class="form-control input-lg">
         <option value="male">Male</option>
		 <option value="female">Female</option>
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
			<input name="email" type="email" autocorrect="off" autocapitalize="none" value="<?php echo set_value('email',(isset($email) ? $email:'')); ?>" required class="form-control input-lg"><br />
			Dont have a paypal account
			<a href="https://www.paypal.com/" target="_blank">Click here to register</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Password*</label>
			<input name="password" type="password" id="password" value="<?php echo set_value('password'); ?>" class="form-control input-lg"  >
		</div>
		</div>
		</div>
<div class="row">
	<div class="form-group">		
		<div class="col-md-6">
			<label>Re-enter Password*</label>
			<input name="confirm_password" type="password" value="<?php echo set_value('confirm_password'); ?>"  class="form-control input-lg"  >
		</div>
	</div>
</div>


