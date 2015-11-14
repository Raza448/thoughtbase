<?$this->layout->block('currentPageCss')?>
<style>
input[type=checkbox]:not(old){
	display:none;
}
input[type=checkbox]:not(old) + div > span, input[type=radio ]:not(old) + div > span{
	margin:0.25em 0;
}
@media screen and (max-width: 768px) {
    .change_pass {
		float:left;
		width:100%;
	}
}
@media screen and (min-width: 992px) {
    .change_pass {
		float:right;
		margin-top: 40px;
	}
}
</style>
<!--define current page css-->

<?$this->layout->block()?>

<?$this->layout->block('breadcrumbs')?>

	<section class="page-top">
			<div class="container">

							<div class="row">

								<div class="col-md-12">

									<ul class="breadcrumb">

										<li><a href="<?=site_url() ?>">Home</a></li>

										<li class="active">Edit Profile</li>

									</ul>

								</div>

							</div>

							<div class="row">

								<div class="col-md-12">

									<h2>Edit Profile</h2>

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
		<?php 
		$id = $this->session->userdata('client_id');
		$out = $this->db->query("SELECT * FROM users WHERE id='$id' and profile='0'")->row_array();
		if(!empty($out))
		{
		?>
		<div class="alert alert-danger">
			<p>Your profile is not completed yet. Please complete your profile to access new query.</p>
		</div>
		<?php
		}
		?>
	<!--- -->					
 
<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;">
<form action="" id="register-form" novalidate="novalidate" method="POST" type="post">	
					
						
<ul class="portfolio-list col-md-6" data-sort-id="portfolio" style="position: relative;height:auto;">
						<li class="col-md-12 check_radio">
						 <!--<li class="col-md-5">

						  Lorem ipsum dolor sit amet, consectetur adipiscing elit. 

						 Quisque rutrum pellentesque imperdiet. Nulla lacinia 

						 iaculis nulla non pulvinar. Cum sociis natoque penatibus 

												 

						 </li>-->
						<h4>Interest</h4>
						 
					<input type="hidden" name="act" value="interest"  />
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
						  <label>
						  <input name="interest[<?php echo $i; ?>]" <?php if( in_array($y['id'],$pk)){  ?> checked <?php } ?>  type="checkbox" value="<?php echo $y['id'];  ?>"><div><span><span></span></span> &nbsp;<?php echo $y['name']; ?></div></label><br />
						  <?php 
						   $i++;}}
						  ?>
						</li>
						  </ul>

						<li class="col-md-6">
	<div class="row">					
  <div class="form-group">

   
	<div class="col-md-6">

		<label>Age Range <span class="mandatory">*</span></label>	<br />

         <select name="age" class="form-control input-lg" >

        <!-- <option value="1" <?php if($result['age'] == 1  ){ ?> selected <?php } ?>  >12 - 17</option>-->

		 <option value="2" <?php if($result['age'] == 2  ){ ?> selected <?php } ?> >18 - 24</option>

		 <option value="3" <?php if($result['age'] == 3  ){ ?> selected <?php } ?> >25 - 34</option>

		 <option value="4" <?php if($result['age'] == 4  ){ ?> selected <?php } ?> >35 - 44</option>

		 <option value="5" <?php if($result['age'] == 5 ){ ?> selected <?php } ?> >45 - 54</option>

		 <option value="6" <?php if($result['age'] == 6  ){ ?> selected <?php } ?> >55 - 64</option>

		 <option value="7" <?php if($result['age'] == 7  ){ ?> selected <?php } ?> >65+</option>

	   </select><i class="fa select"></i>			<br />

	</div>
	
	
	<div class="col-md-6">

		<label>Gender <span class="mandatory">*</span></label>	

        <select name="gender" class="form-control input-lg">

			<option value="male" <?php if($result['gender'] == "male"  ){ ?> selected <?php } ?> >Male</option>

			<option value="female" <?php if($result['gender'] == "female"  ){ ?> selected <?php } ?> >Female</option>

		</select><i class="fa select"></i>	<br />	
	</div>
	<div class="col-md-12">
		<label>Zipcode <span class="mandatory">*</span></label>

		<input name="zipcode" type="number" id="zip" value="<?php echo set_value('zipcode',(isset($result['zipcode']) ? $result['zipcode']:'')); ?>" required class="form-control input-lg">
		<div id="errorcontainer-zip" class='errorDiv'></div><br />
		
		<label>Username <span class="mandatory">*</span></label><br />
		<?php
		$id = $this->session->userdata('client_id');
		$out = $this->db->query("SELECT * FROM users WHERE id='$id' and profile='0'")->row_array();
		if(!empty($out))
		{ ?>
		<input type="text"  class="form-control input-lg" name="username" autocorrect="off" autocapitalize="none" id="username" value="<?php echo set_value('zipcode',(isset($out['username']) ? $out['username']:'')); ?>" /><div id="results-username" class="results error"></div><div id="errorcontainer-username" class='errorDiv'></div><br />
		<?php if(isset($_GET['id'])){ ?> 
		<input type="hidden" name='new_customer' value="<?php echo $_GET['id'] ?>" />
		<div class="row">
			<div class="form-group">
				<div class="col-md-6">
					<label>Password <span class="mandatory">*</span></label>
					<input name="new_password" type="password"  autocorrect="off" autocapitalize="none" id="new_password" value="<?php echo set_value('password'); ?>" class="form-control input-lg" >
					<div id="errorcontainer-new_password" class='errorDiv'></div>
				</div>
				<div class="col-md-6">
					<label>Re-enter Password <span class="mandatory">*</span></label>
					<input name="re_pass" type="password"  autocorrect="off" autocapitalize="none" id="re_pass" value="<?php echo set_value('confirm_password'); ?>"  class="form-control input-lg" />
					<div id="errorcontainer-re_pass" class='errorDiv'></div>
				</div>
			</div>	
		</div>
		<?php } ?>
		<!--<label>Password <span class="mandatory">*</span></label>
		<input name="password" type="password"  autocorrect="off" autocapitalize="none" id="password" value="<?php echo set_value('password'); ?>" class="form-control input-lg">
		<div id="errorcontainer-password" class='errorDiv'></div><br />
		<label>Re-enter Password <span class="mandatory">*</span></label>
		<input name="confirm_password" type="password"  autocorrect="off" autocapitalize="none" id="confirm_pass" value="<?php echo set_value('confirm_password'); ?>"  class="form-control input-lg"  required>
		<div id="errorcontainer-confirm_pass" class='errorDiv'></div><br />-->
		<?php
		}
		else
		{
		?>
		<input type="text"  class="form-control input-lg" name="username" autocorrect="off" autocapitalize="none" id="username" value="<?php echo $result['username']; ?>" disabled /><div id="results-username" class="results error"></div><div id="errorcontainer-username" class='errorDiv'></div><br />
		<?php
		}
		?>
		 <label>Paypal E-mail Address <span class="mandatory">*</span></label><br />

		 <input type="email" autocorrect="off" autocapitalize="none"  class="form-control input-lg" id="email" name="email" value="<?php echo $result['email']; ?>" <?php echo ((count($out)>0) ? 'readonly': '') ?> />
		 <div id="results-email" class="results error"></div>
		 <div id="errorcontainer-email" class='errorDiv'></div><br />
		<?php
		if(empty($out))
		{
		?>
		<div class="row">
		 <h4 class="col-md-12">Change Password</h4>
			<div class="col-md-6">
				<label>New Password <span class="mandatory">*</span></label>
				<input name="password" type="password"  autocorrect="off" autocapitalize="none" id="password" value="" class="form-control input-lg"  >
				<div id="errorcontainer-password" class='errorDiv'></div><br />
			</div>
			<div class="col-md-6">
				<label>Re-enter Password <span class="mandatory">*</span></label>
				<input name="confirm_password" type="password"  autocorrect="off" autocapitalize="none" id="confirm_pass" value=""  class="form-control input-lg"  >
				<div id="errorcontainer-confirm_pass" class='errorDiv'><div class="error"></div></div>
			</div>
		</div><br />
		<?php
		}
		?>
		<div class="col-md-12 pad-0">
			<div class="row">
				<div class="col-md-6">
					<a  href="<?=site_url() ?>/user/myQueries" class="btn btn-default reset" data-loading-text="Loading...">Cancel</a>
				</div>
				<div class="col-md-6 col_rgt">
					<input type="submit" name="submit" value="Save" id="save" class="btn btn-default" data-loading-text="Loading..." style="text-align:center;">
				</div>
			</div>
		</div>
	</li>
		
</form>

<li class="col-md-6 change_pass">

<div class="row">
<?php if(empty($out)){ ?>
	<div class="col-md-12">
		<div class="row">
		
			<h4 class="col-md-6" style="float: left;line-height: 2.2;margin-bottom: 0 !important;">Deactivate Account</h4>

			<a class="col-md-6 pull-right deactivate" href="<?php echo site_url('user/deactivate'); ?>" style="margin-top:5px;"  onclick="return confirm('Are you sure want to deactivate your account ?');" ><button type="button" class="btn btn-deactivate col-md-12">Deactivate</button></a>
		</div>
	</div>
	
<?php } ?>
		<!--<p class="note">Note - Fields marked with asterik (*) are mandatory.</p>-->
		<div class="col-md-12 mand">
									<p class="note">&nbsp;</p>
								</div>

</div>
</div>

						</li>

						</ul>


 </div>

						




	<!--- -->						 

						

						

						

						

				

						</div>
</div>


<?$this->layout->block('currentPageJS')?>

		<!-- Current Page JS -->
<script type="text/javascript">
/**
  * Basic jQuery Validation Form Demo Code
  * Copyright Sam Deering 2012
  * Licence: http://www.jquery4u.com/license/
  */
$(document).ready(function() {
var val_fields = "<?php echo get_spam_words() ?>";
var junk_words = val_fields.split(",");
var self = this;
var self = {j_words:[]};
	var response;
	$.validator.addMethod(
		"checkWords", 
		function(value, element) {
			var v = value.toLowerCase();
			self.j_words = [];
			for( i = 0;i<junk_words.length;i++){
			  var string = junk_words[i].toLowerCase();
			  console.log(string +"+"+ v);
			  if (new RegExp("\\b"+string+"\\b").test(v)) {
				  console.log('string found');
				  self.j_words.push(string);
			  }
			}
			if(self.j_words.length > 0)
			 return false;
			else
				return true;
		},
		function(){
			return "These words are not acceptable ("+self.j_words.join(",")+").";
		}
	);
	$.validator.addMethod(
		"checkUsername", 
		function(value, element) {
		var isSuccess = true;
			$.ajax({
			type: "post", 
			url: "<?php echo site_url('main/check_username'); ?>",  
			data: {username: value},
			success: function(msg) { isSuccess = msg === "1" ? true : false }
			});
			return isSuccess;
		},
		"Username already Exists. Plese Type another one."
	);
(function($,W,D)
{
    var form_validate = {};
    var pass_validate = {};
    form_validate =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form").validate({
                rules: {
					username: {
					required: true,
					user:true,
					checkWords: true,
					remote: "<?php echo site_url('main/check_username') ?>"
					},
                    zipcode: {
					required: true,
					zip:true,
					},
                    email: {
                        required: true,
                        email: true,
						checkWords: true
					},
					password: {
                        required: false
                    },
					confirm_password: {
					required: false
					},
					new_password: {
                        required: true
                    },
					re_pass: {
					required: true,
					equalTo: '#new_password'
					}
                  },  
                messages: {
                    zipcode: {
					required: "Only Numbers are Allowed",
					zip: "Min. 5 and Max. 6 Characters are Allowed"
					},
                    email: {
					required: "Please enter a valid email address",
					},
                    username: {
					user: "Please enter an alphanumeric value",
					remote: "This Username is already registered"
					},
					 password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
					re_pass: {
                        required: "Re-enter password",
						equalTo: "Password not matched"
                    },
					 confirm_password: {
                        required: "Re-enter password",
                        minlength: "Your password must be at least 6 characters long",
						equalTo: "Please enter the same password as above"
                    },
                },
                submitHandler: function(form) {
						var pass = $('#password').val();
						var conf_pass = $('#confirm_pass').val();
						//alert(pass+'\n'+conf_pass);
						if(pass != ""){
							if(conf_pass == ""){
								$('#errorcontainer-confirm_pass .error').html('Please enter confirm password.');
							}else if(pass != conf_pass){
								$('#errorcontainer-confirm_pass .error').html('Password not matched.');
							}else{
								form.submit();
							}
						}else{
								form.submit();
						}
						
                }
            });
        }
    }
	pass_validate =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#change-pass-form").validate({
                rules: {
					password: {
                        required: true,
                        minlength: 6
                    },
					confirm_password: {
					required: true,
					equalTo: "#password"
				}
                },
                messages: {
                     password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
					 confirm_password: {
                        required: "Re-enter password",
                        minlength: "Your password must be at least 6 characters long",
						equalTo: "Password Not Matched"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        form_validate.setupFormValidation();
        pass_validate.setupFormValidation();
    });

})(jQuery, window, document);
jQuery.validator.addMethod("user", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9\._]+$/.test(value);
});

jQuery.validator.addMethod("zip", function(value, element) {
    return this.optional(element) || /^[0-9]{5,6}$/.test(value);
});
jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        error.appendTo('#errorcontainer-' + element.attr('id'));
    }
});

/* $("#email").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#username").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#zipcode").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
}); */

function ajax_spam(a,id) {
	if(a != 0 ){
	$.ajax({
	type: "POST",  
	url: "<?php echo site_url('main/validating_fields'); ?>",  
	data: {t_val: a},
	success: function(data){  
		$("#results-"+id).html(data);
		if(data != '')
		{
			$('#save').prop('disabled', true);
		}
		else
		{
			$('#save').prop('disabled', false);
		}
		} 		
	});
	}
}
});
</script>

<?$this->layout->block()?>