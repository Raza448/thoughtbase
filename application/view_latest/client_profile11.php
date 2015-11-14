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
										<li class="active">Update Profile</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Update Profile</h2>
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
		<div class="row" style="clear:both;">
		<div class="col-md-12" >
		   <?php $this->load->view('client_menu'); ?>
		</div>
		</div>
						<div class="row" >
	<!--- -->					
<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;min-height:850px;">
							<li class="col-md-6 " >
								
							<h4>Update Profile</h4>
						<ul class="portfolio-list" style="clear:both;">
						 <li class="col-md-5">
						  Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
						 Quisque rutrum pellentesque imperdiet. Nulla lacinia 
						 iaculis nulla non pulvinar. Cum sociis natoque penatibus 
												 
						 </li>
						 <li class="col-md-1 " >
						  <h4>Interests</h4>
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
						    <input  style="float:left" name="interest[<?php echo $i; ?>]" <?php if( in_array($y['id'],$pk)){  ?> checked <?php } ?>  type="checkbox" value="<?php echo $y['id'];  ?>"><?php echo $y['name']." &nbsp;"; ?>
						  <?php 
						   $i++;}}
						  ?> 
 </div>
 <div style="clear:both;"></div>
    <!--<input type="submit"   value="Submit" class="btn btn-primary  push-bottom" data-loading-text="Loading...">-->
	</div>
</div>
						  </li> 
						  </ul>
								
								
							</li>
							<li class="col-md-6 " >
						<h4>&nbsp;</h4>
						<li>						
  <div class="form-group">
   
	<div class="col-md-4">
		<label>Age Range</label>	<br />
         <select name="age" class="form-control input-lg" >
         <option value="1" <?php if($result['age'] == 1  ){ ?> selected <?php } ?>  >12 - 17</option>
		 <option value="2" <?php if($result['age'] == 2  ){ ?> selected <?php } ?> >18 - 24</option>
		 <option value="3" <?php if($result['age'] == 3  ){ ?> selected <?php } ?> >25 - 34</option>
		 <option value="4" <?php if($result['age'] == 4  ){ ?> selected <?php } ?> >35 - 44</option>
		 <option value="5" <?php if($result['age'] == 5 ){ ?> selected <?php } ?> >45 - 54</option>
		 <option value="6" <?php if($result['age'] == 6  ){ ?> selected <?php } ?> >55 - 64</option>
		 <option value="7" <?php if($result['age'] == 7  ){ ?> selected <?php } ?> >65+</option>
	   </select>			
	</div>		<div class="col-md-4">
		<label>Gender</label>	
        <select name="gender" class="form-control input-lg">
			<option value="male" <?php if($result['gender'] == "male"  ){ ?> selected <?php } ?> >Male</option>
			<option value="female" <?php if($result['gender'] == "female"  ){ ?> selected <?php } ?> >Female</option>
		</select>						<label>Zipcode</label>
		<input name="zipcode" type="zipcode" value="<?php echo $result['zipcode']; ?>" required class="form-control input-lg"><br />				 <label>Paypal E-mail Address*</label><br />		 <input type="email" autocorrect="off" autocapitalize="none" class="form-control input-lg" name="email" value="<?php echo $result['email']; ?>"  readonly /><br />				<input type="submit" name="submit" value="Save" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">				<button class="btn btn-primary pull-right push-bottom" data-loading-text="Loading..." style="margin-right:10px;">Cancel</button>
					</form>



<form action="<?php echo site_url('user/Profile'); ?>" id="register" method="POST" type="post">
<input type="hidden" name="act" value="changepassword"  />
	<div style="clear:both;"></div>
	  <h4>Change Password</h4>
      <label>New Password*</label>
      <input name="password" type="password" id="password" value="" class="form-control input-lg"  >

 
      <label>Re-enter Password*</label>
      <input name="confirm_password" type="password" value=""  class="form-control input-lg"  >




    <input type="submit" value="Change Password" style="margin-top:15px;" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">

</form>
<div style="clear:both;"></div>
<h4 style="margin-top:15px;" >Deactivate Account</h4>


    <a href="<?php echo site_url('clients/deactivate'); ?>" style="margin-top:5px;"  onclick="return confirm('are you sure you want to deactivate your account ?');" ><button type="button" class="btn btn-danger">Deactivate</button></a>


  </div>
 </div>
						
						</li>
						</ul>

	<!--- -->						 
						
						
						
						
				
						</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>