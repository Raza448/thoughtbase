<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<style>

/* @media (min-width: 992px){
	.client_register {
		padding: 0;
	}
} */
</style>
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
	<section class="page-top">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb">
							<li><a href="<?=site_url() ?>">Home</a></li>
							<li class="active">User Registeration</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h2>User Registeration</h2>
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
		<form action="<?php echo site_url('main/userRegister'); ?>" id="register-form" novalidate="novalidate" method="POST" type="post">
						<input type="hidden" name="disable_flag" value="1" />
						<div class="row">
						<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;min-height:850px;">
						<li class="col-md-6 reg_text check_radio">
						
							<h4>Register An Account</h4>
						
							Our registration form is different.<br />
							We're not asking for any personal information, not even your first name. All we need are some basic anonymous stats, and your PayPal account email, which we will ONLY use to send you cash payments, new query notifications, and account messages.</br />
							<div>&nbsp;</div>
							That’s our entire privacy policy.
							<div>&nbsp;</div>
							After you create your account, all you have to do is sit back and wait for query notification emails to arrive. Then just login, give your honest opinion, and get paid!<br /><br />
						 
						 <h4>Interests</h4>
						 
						  <?php 
						    $query = "select * from interests";
						    $out   = $this->db->query($query);
							$z     = $out->result_array();
						    if(count($z)>0){
							$i=0;
							foreach($z as $ry => $y ){
						  ?>
						  <label>
						    <input name="interest[<?php echo $i; ?>]" <?php if(isset($_POST['interest'][$i]) && $_POST['interest'][$i] == $y['id'] ){ ?> checked <?php } ?> type="checkbox" value="<?php echo $y['id'];  ?>">&nbsp; <div for="option"><span><span></span></span><?php echo $y['name']; ?></div></label><br />
						  <?php 
						   $i++;}
						   }
						  ?>
						 
						 </li>
						 
						
							<li class="col-md-6 client_register" >
						<div>&nbsp;</div>
						<p></p>
						   <div >
<div >
<div>												
	<div class="row">
	<div class="form-group" style="margin-bottom:0px;">
		<div class="col-md-6">
			<label>Age Range <span class="mandatory">*</span></label>	<br />
			 <select name="age" class="form-control input-lg">
			 <!--<option value="1" <?php if(isset($_POST['age']) && $_POST['age'] == 1  ){ ?> selected <?php } ?>  >12 - 17</option>-->
			 <option value="2" <?php if(isset($_POST['age']) && $_POST['age'] == 2  ){ ?> selected <?php } ?> >18 - 24</option>
			 <option value="3" <?php if(isset($_POST['age']) && $_POST['age'] == 3  ){ ?> selected <?php } ?> >25 - 34</option>
			 <option value="4" <?php if(isset($_POST['age']) && $_POST['age'] == 4  ){ ?> selected <?php } ?> >35 - 44</option>
			 <option value="5" <?php if(isset($_POST['age']) && $_POST['age'] == 5 ){ ?> selected <?php } ?> >45 - 54</option>
			 <option value="6" <?php if(isset($_POST['age']) && $_POST['age'] == 6  ){ ?> selected <?php } ?> >55 - 64</option>
			 <option value="7" <?php if(isset($_POST['age']) && $_POST['age'] == 7  ){ ?> selected <?php } ?> >65+</option>
			</select>
			<i class="fa select"></i>
		</div>
		<div class="col-md-6">
			<label>Gender <span class="mandatory">*</span></label>	<br />
			 <select name="gender" class="form-control input-lg">
			 <option value="male" <?php if(isset($_POST['gender']) && $_POST['gender'] == "male"  ){ ?> selected <?php } ?> >Male</option>
			 <option value="female" <?php if(isset($_POST['gender']) && $_POST['gender'] == "female"  ){ ?> selected <?php } ?> >Female</option>
		     </select>	
			<i class="fa select"></i>			 
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Zipcode <span class="mandatory">*</span></label>
			<input name="zipcode" type="number" id="zip" value="<?php echo set_value('zipcode',(isset($zipcode) ? $zipcode:'')); ?>" required class="form-control input-lg" >
			<div id="errorcontainer-zip" class='errorDiv'></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Paypal E-mail Address <span class="mandatory">*</span></label>
			<input name="email" type="email" autocorrect="off" autocapitalize="none"  id="email" value="<?php echo set_value('email',(isset($email) ? $email:'')); ?>" required class="form-control input-lg">
			<div id="results-email" class="results error"></div>
			<div id="errorcontainer-email" class='errorDiv'></div>
			Don't have a PayPal account ?  
			<a href="https://www.paypal.com/" target="_blank" style="color:blue">Sign up for free</a>
		</div>
		</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Username <span class="mandatory">*</span></label>
			<input name="username" type="text" autocorrect="off" autocapitalize="none" id="username" value="<?php echo set_value('username',(isset($username) ? $username:'')); ?>" class="form-control input-lg" />
			<div id="results-username" class="results error"></div>
			<div id="errorcontainer-username" class='errorDiv'></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-6">
			<label>Password <span class="mandatory">*</span></label>
			<input name="password" type="password"  autocorrect="off" autocapitalize="none" id="password" value="<?php echo set_value('password'); ?>" class="form-control input-lg" >
			<div id="errorcontainer-password" class='errorDiv'></div>
		</div>
		<div class="col-md-6">
			<label>Re-enter Password <span class="mandatory">*</span></label>
			<input name="confirm_password" type="password"  autocorrect="off" autocapitalize="none" id="confirm_pass" value="<?php echo set_value('confirm_password'); ?>"  class="form-control input-lg" />
			<div id="errorcontainer-confirm_pass" class='errorDiv'></div>
		</div>
		
	</div>
	
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-8 captcha_text">
			<label>Enter text from the below image <span class="mandatory">*</span></label>
			<input name="captcha" id="captcha" type="text"  value=""  class="form-control input-lg"  required><div id="errorcontainer-captcha" class='errorDiv'></div>
			<span id="captcha_img" style="float:left;margin-top:10px;"><?php echo $image; ?></span><br />
			<a id="refresh_captcha" style="color:red; font-size:12px;margin: 0 3px;cursor:pointer;"><img src="<?php echo base_url('assets/img/captcha1.png') ?>" /></a>
			<input type="hidden" name="ocaptcha" value="<?php echo $word; ?>" class="form-control input-lg" id="ocaptcha">
		</div>
	</div>
</div>
<div class="checkbox">
<label>
		<input type="checkbox" name="term" id="terms" value="1" <?php echo ((set_value('term') == 1) ? 'checked' : ''); ?> required /><div><span><span></span></span> I agree to the ThoughtBase <a href="terms_condition" style="color:blue">Terms of Service.</a> </div></label><span class="mandatory">*</span>
		<div id="errorcontainer-terms" class='errorDiv'></div>
</div><br />
				<div class="row">
					<div class="col-md-12">
						<input type="submit" value="Register" id="register" class="btn btn-default pull-right" data-loading-text="Loading...">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p> &nbsp;</p>
						<!--<p class="note">Note - Fields marked with asterik (*) are mandatory.</p>-->
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
<script type="text/javascript">
/**
  * Basic jQuery Validation Form Demo Code
  * Copyright Sam Deering 2012
  * Licence: http://www.jquery4u.com/license/
  */
$(document).ready(function() {

$('div.errorDiv').on('click', 'a.login_panel', function(event){
		event.preventDefault();
		$('html, body').animate({scrollTop: '0px'}, 300);
		var ab = $('#email').val();
		$('.navbar-collapse').addClass('in');
		$('#top_username').val(ab);
		$('#top_password').val('');
		$('#top_password').focus();
});

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
(function($,W,D)
{
    var form_validate = {};

    form_validate =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form").validate({
                rules: {
                    zipcode: {
					required: true,
					number:true,
					zip:true
					},
                    username: {
					required: true,
					user:true,
					checkWords: true,
					remote: "<?php echo site_url('main/check_username') ?>"
					},
                    email: {
                        required: true,
                        email: true,
						checkWords: true,
						remote: "<?php echo site_url('main/check_email') ?>"
					},
                    password: {
                        required: true,
                        minlength: 6
                    },
					confirm_password: {
						required: true,
						equalTo: "#password"
					},
                    term: "required",
					captcha: {
						required: true,
						equalTo: "#ocaptcha"
					}
                },
                messages: {
                    zipcode: {
					required: "Only Numbers are Allowed",
					zip: "Min. 5 and Max. 6 Characters are Allowed"
					},
                    username: {
					user: "Please enter an alphanumeric value",
					remote: "This Username is already exist"
					},
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
					 confirm_password: {
                        required: "Re-enter password",
                        minlength: "Your password must be at least 6 characters long",
						equalTo: "Please enter the same password as above"
                    },
                    email: {
					required: "Please enter a valid email address",
					remote: "An account with this email already exists. <a href='#' class='login_panel' style='color:blue;'>Click here</a> to Login"
					},
                    term: "Please accept our policy",
					captcha: {
						equalTo: "Invalid captcha"
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
    });

})(jQuery, window, document);
jQuery.validator.addMethod("user", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9\._-]+$/.test(value);
});
jQuery.validator.addMethod("zip", function(value, element) {
    return this.optional(element) || /^[0-9]{5,6}$/.test(value);
});
jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        error.appendTo('#errorcontainer-' + element.attr('id'));
    }
});


 $('#refresh_captcha').click(function(event){
	 var site_url = '<?php echo site_url(); ?>';
	 event.preventDefault();
	 $.ajax({
		 url:site_url+'/main/check_captcha',
		 dataType : 'json',
		 success:function(response){
			 $('#captcha_img').html(response.captcha);
			 $('#ocaptcha').val(response.captcha_word);
			 //document.getElementById('ocaptcha').value = response.captcha_word;
			 //$('#captcha_img').html(data);
		 }
	 });            
});
/*$("#username").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
}); */

function ajax_spam(a,id) {
	if(a != 0 ){
	$.ajax({
	type: "POST",  
	url: "<?php echo site_url('main/check_captcha'); ?>",  
	data: {t_val: a},
	success: function(data){  
		$("#results-"+id).html(data);
		if(data != '')
		{
			$('#register').prop('disabled', true);
		}
		else
		{
			$('#register').prop('disabled', false);
		}
		} 		
	});
	}
}
});
</script>
<?$this->layout->block()?>