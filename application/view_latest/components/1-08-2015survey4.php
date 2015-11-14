<div class="col-md-12">
				<?php $this->load->view('components/form_message'); ?>	
</div>
<form method="post" action="" id="payment-form" novalidate="novalidate" enctype="multipart/form-data">
	<input type="hidden" name="step4" value="step4" />

<div class="row">
	<div class="form-group">
		<div class="col-md-12">
            <?php 
              $rout = $this->db->query('select * from survey_temp where id='.$this->session->userdata('survey_id'))->result_array();
            ?>
			<?php if(isset($tot)) {echo $tot; } ?>
			<label><b>Amount $<?php echo $rout[0]['amount']; ?></b></label>
			<input type="hidden" name="example_payment_amuont" value="<?php echo $rout[0]['amount']; ?>" >
			</div>
	</div>
</div>
		<?php 
              $vout = $this->db->query('select * from vendors where user_id='.$this->session->userdata('vendor_id'))->row_array();
			 // print_r($this->session->all_userdata());
            ?>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>First name <span class="mandatory">*</span></label>
			<input type="text" autocorrect="off" autocapitalize="none" name="customer_first_name" id="fname" value="<?php echo stripslashes($vout['fname'])  ?>"   required  class="form-control input-lg" />
			<div id="results-fname" class="results error"></div>
			<div id="errorcontainer-fname" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Last name <span class="mandatory">*</span></label>
			<input type="text" autocorrect="off" autocapitalize="none" name="customer_last_name" id="lname" value="<?php echo stripslashes($vout['lname'])  ?>"   required   class="form-control input-lg"  />
			<div id="results-lname" class="results error"></div>
			<div id="errorcontainer-lname" class='errorDiv'></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Address Line 1 <span class="mandatory">*</span></label>
			<input type="text" autocorrect="off" autocapitalize="none" name="customer_address1" id="addr1" value="<?php echo set_value('customer_address1',(isset($vout['uen']) ? stripslashes($vout['uen']):'')); ?>"   required   class="form-control input-lg" />
			<div id="results-addr1" class="results error"></div>
			<div id="errorcontainer-addr1" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Address Line 2</label>
			<input type="text" autocorrect="off" autocapitalize="none" name="customer_address2" id="addr2" value="<?php echo set_value('customer_address2',(isset($vout['addr']) ? stripslashes($vout['addr']):'')); ?>"    required  class="form-control input-lg" />
			<div id="results-addr2" class="results error"></div>
			<div id="errorcontainer-addr2" class='errorDiv'></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>City <span class="mandatory">*</span></label>
			<input type="text" autocorrect="off" autocapitalize="none" name="customer_city" id="city" value="<?php echo stripslashes($vout['city'])  ?>"    required  class="form-control input-lg" />
			<div id="results-city" class="results error"></div>
			<div id="errorcontainer-city" class='errorDiv'></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>State <span class="mandatory">*</span></label>
			<input type="text" autocorrect="off" autocapitalize="none" name="customer_state" id="state" value="<?php echo stripslashes($vout['state'])  ?>"   required  class="form-control input-lg" />
			<div id="results-state" class="results error"></div>
			<div id="errorcontainer-state" class='errorDiv'></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Zip <span class="mandatory">*</span></label>
			<input type="number" name="customer_zip" id="zip" value="<?php echo stripslashes($vout['zip'])  ?>"  required  class="form-control input-lg" />
			<div id="results-zip" class="results error"></div>
			<div id="errorcontainer-zip" class='errorDiv'></div>
		</div>
	</div>
</div>


<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Country <span class="mandatory">*</span></label>

			 <?php $vvk = $vout['country']; ?>
			<select name="customer_country" required="required" required class="form-control input-lg">
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
<div class="col-md-12">
	<div class="col-md-6" style="padding:0;">
		<h4 style="float:left;border-bottom: solid 2px #317831;padding:0;">Payment Details</h4>
	</div>
</div><br /><br />
	<div class="form-group">
		<div class="col-md-6 payment_details">
			<label>Card Number <span class="mandatory">*</span></label>
			<input type="number" name="customer_credit_card_number" id="card_number" class="form-control input-lg" autocomplete="cc-number" />
			<div id="errorcontainer-card_number" class='errorDiv'></div>
		</div>
		<div class="col-md-6 payment_details">
			<label>Card Type <span class="mandatory">*</span><a class="payment"><img alt="payment1" src="<?php echo base_url('assets/img/payment-2.png'); ?>"> 
				 <img alt="payment2" src="<?php echo base_url('assets/img/payment-3.png'); ?>"> 
				 <img alt="payment3" src="<?php echo base_url('assets/img/payment-4.png'); ?>"> 
			</a></label>
		      <?php $vv = isset($_POST['customer_credit_card_type']) ? $_POST['customer_credit_card_type']: ''; ?>
                        	<select name="customer_credit_card_type" class="form-control input-lg" >
                            	<option value="Visa"  <?php if( $vv == 'Visa'){ ?>  selected <?php } ?> >Visa</option>
                                <option value="MasterCard"  <?php if( $vv == 'MasterCard'){ ?>  selected <?php } ?> >Master Card</option>
                                <option value="Discover" <?php if( $vv == 'Discover'){ ?>  selected <?php } ?> >Discover</option>
                                
                            </select>
							
		</div>
	</div>
</div>


<div class="row">
	<div class="form-group">
		<div class="col-md-4 payment_details">
			<label>Month <span class="mandatory">*</span></label>
			<select name="cc_expiration_month" class="form-control input-lg" autocomplete="cc-exp-month" />

				  <?php $vv1 = isset($_POST['cc_expiration_month']) ? $_POST['cc_expiration_month']: ''; ?>
                  <?php for(  $zi =1; $zi <  13 ; $zi++  ){ ?>
                                                                	<option   <?php if( $vv1 == $zi ){ ?>  selected <?php } ?>    value="<?php echo $zi; ?>"><?php echo $zi; ?></option>
                                                                <?php } ?>
                </select>
          </div>
          <div class="col-md-4 payment_details">
<label>Year<span class="mandatory">*</span></label>
  <?php $vv2 = isset($_POST['cc_expiration_year']) ? $_POST['cc_expiration_year']: ''; ?>

                                                              <select name="cc_expiration_year"  class="form-control input-lg" autocomplete="cc-exp-year" />
                                                              	<?php for(  $z =date('Y'); $z <  date('Y') +10 ; $z++  ){ ?>
                                                                	<option  <?php if( $vv2 == $z ){ ?>  selected <?php } ?>   value="<?php echo $z; ?>"><?php echo $z; ?></option>
                                                                <?php } ?>
                                                            </select>
															
		</div>
		<div class="col-md-4 payment_details">
			<label>CVV <span class="mandatory">*</span></label>
			<input type="number" name="cc_cvv2_number" id="card_verification" required value="<?php echo isset($_POST['cc_cvv2_number']) ? $_POST['cc_cvv2_number']: ''; ?>"     class="form-control input-lg" autocomplete="cc-csc" />
			<div id="errorcontainer-card_verification" class='errorDiv'></div>
		</div>
	</div>
</div>


<div class="row">
  <div class="col-md-12">
   <?php if($this->session->userdata('step2')){ ?>
   <a style="float:left;"><input type="button" value="<< Back" class="btn btn-primary" id="back" data-loading-text="Loading..."></a>
 <?php } ?>
  <?php if($rout[0]['amount'] > 0 ){ ?>
   <input type="submit" value="Make Payment" id="payment" style="float:right;" class="btn btn-primary" data-loading-text="Loading...">
   <?php }else{ ?>
     <strong>Payment Amount should be above 0$</strong>
   <?php } ?>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
	<p>&nbsp;</p>
		<!--<p class="note">Note - Fields marked with asterik (*) are mandatory.</p>-->
	</div>
</div>
</form>