<?php $this->load->view('components/form_message'); ?>
<form action="<?php echo site_url('user/Profile'); ?>" id="register" method="POST" type="post">
<input type="hidden" name="act" value="editaccount"  />
<input type="hidden" name="email" value="<?php echo $profile['email']; ?>"  />
<div class="row">
  <div class="form-group">
    <div class="col-md-12">
      <label>Paypal E-mail Address*</label><br />
      <b><?php echo $profile['email']; ?></b>
    </div>
  </div>
</div>


	<div class="row">
		<div class="col-md-6">
		<label>Age Range</label>	<br />
         <select name="age" class="form-control input-lg">
         <option value="1" <?php if($profile['age'] == 1  ){ ?> selected <?php } ?>  >12 - 17</option>
		 <option value="2" <?php if($profile['age'] == 2  ){ ?> selected <?php } ?> >18 - 24</option>
		 <option value="3" <?php if($profile['age'] == 3  ){ ?> selected <?php } ?> >25 - 34</option>
		 <option value="4" <?php if($profile['age'] == 4  ){ ?> selected <?php } ?> >35 - 44</option>
		 <option value="5" <?php if($profile['age'] == 5 ){ ?> selected <?php } ?> >45 - 54</option>
		 <option value="6" <?php if($profile['age'] == 6  ){ ?> selected <?php } ?> >55 - 64</option>
		 <option value="7" <?php if($profile['age'] == 7  ){ ?> selected <?php } ?> >65+</option>
	   </select>			
	</div>
	</div>

<div class="row">
	
		<div class="col-md-6">
		<label>Gender</label>	
         <select name="gender" class="form-control input-lg">
         <option value="male" <?php if($profile['gender'] == "male"  ){ ?> selected <?php } ?> >Male</option>
		 <option value="female" <?php if($profile['gender'] == "female"  ){ ?> selected <?php } ?> >Female</option>
	   </select>			
	</div>
	</div>


<div class="row">
		<div class="col-md-6">
			<label>Zipcode</label>
			<input name="zipcode" type="zipcode" value="<?php echo $profile['zipcode']; ?>" required class="form-control input-lg"><br />
		</div>
</div>





<div class="row">
  <div class="col-md-12">
    <input type="submit" value="Update Account" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
  </div>
</div>
</form>
<div class="row">
 <div class="col-md-12">
  <h4>Interests</h4>
 </div>
</div>
<form action="<?php echo site_url('user/Profile'); ?>" id="register" method="POST" type="post">
<input type="hidden" name="act" value="interest"  />
<div class="row">
  <div class="form-group">
    <div class="col-md-6">
      <?php 
						    $query = "select * from interests";
						    $out   = $this->db->query($query);
							$z     = $out->result_array();
							$query2 = "select * from user_interest where user_id =".$this->session->userdata('client_id');
						    $out2   = $this->db->query($query2);
							$z2     = $out2->result_array();
							$pk     = array();
							if(count($z2) > 0 ){
							 foreach( $z2 as $rows => $vals ){
							   $pk[] = $vals['interest'];
							 }
							}
							
							
							
						    if(count($z)>0){
							$i=0;
							foreach($z as $ry => $y ){
						  ?>
						    <label style="float:left"><?php echo $y['name']." &nbsp;"; ?></label>
						    <input style="float:left" name="interest[<?php echo $i; ?>]" <?php if( in_array($y['id'],$pk)){  ?> checked <?php } ?> class="form-control1" type="checkbox" value="<?php echo $y['id'];  ?>"><?php echo " &nbsp;"; ?>
						  <?php 
						   $i++;}}
						  ?>
	 
	 
	 
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <input type="submit" value="Submit" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
  </div>
</div>
</form>
<div class="row">
 <div class="col-md-12">
  <h4>Change Password</h4>
 </div>
</div>
<form action="<?php echo site_url('user/Profile'); ?>" id="register" method="POST" type="post">
<input type="hidden" name="act" value="changepassword"  />
<div class="row">
  <div class="form-group">
    <div class="col-md-6">
      <label>New Password*</label>
      <input name="password" type="password" id="password" value="" class="form-control input-lg"  >
    </div>
    <div class="col-md-6">
      <label>Re-enter Password*</label>
      <input name="confirm_password" type="password" value=""  class="form-control input-lg"  >
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <input type="submit" value="Change Password" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
  </div>
</div>
</form>

<div class="row">
 <div class="col-md-12">
  <h4>Deactivate Account</h4>
 </div>
</div>
<div class="row">
 <div class="col-md-12">
    <a href="<?php echo site_url('clients/deactivate'); ?>" onclick="return confirm('are you sure you want to deactivate your account ?');" ><button type="button" class="btn btn-danger">Deactivate</button></a>
 </div>
</div>
<div class="row">
 <div class="col-md-12">
  <h4></h4>
 </div>
</div>