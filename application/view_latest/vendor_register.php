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
										<li class="active">Business Registration</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Business Registration</h2>
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
					<!--- vendor register ----->
						<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;/*min-height:850px;*/">
							<li class="" >
								
							<!--<h4 style="text-align:center;">Register An Account</h4>-->
						
						 </li>
						 <li>
						   <div class="col-md-12" style="padding:0">
									<div class="col-md-12" style="padding:0">
										<form action="<?php echo site_url('main/businessRegister'); ?>" id="register-form" class="vendor" novalidate="novalidate" method="POST" type="post">
										<?php $this->load->view('components/vendor_register_form'); ?>	
										<div class="row">
											<div class="form-group">
												<div class="col-md-6">
													<input type="hidden">
												</div>										
												<div class="col-md-6">
													<input type="submit" value="Create Account" id="register" class="btn btn-default pull-right" data-loading-text="Loading...">
												</div>
											</div>
										</div>
										<!--<div class="row">
											<div class="col-md-12">
												<p class="note">&nbsp;</p>
											</div>
										</div>-->
										</form>
																		
																	</div>
								</div>
								</div>
						   
						 
						 
						 </li>
						 </ul>
                    <!--- end of vendor register -->					
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

$('div.errorDiv').on('click', 'a.login_panel', function(event){
	event.preventDefault();
	$('div.navbar-collapse').addClass('in');
	$('html, body').animate({scrollTop: '0px'}, 300);
	var ab = $('#email').val();
	$('#username').val(ab);
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
					userName: {
					 required: true,
					 checkWords: true
					},
					fname: {
					 required: true,
					 alpha:true,
					 checkWords: true
					},
					company:{
					 required: true,
					 maxlength: 500,
					 checkWords: true
					},
					lname: {
					required: true,
					alpha:true,
					checkWords: true
					},
					uen: {
					required: true,
					checkWords: true
					},
					addr: {
					required: false
					},
					city: {
					required: true,
					alpha: true,
					checkWords: true
					},
					state: {
					required: true,
					alpha: true,
					checkWords: true
					},
                    zip: {
					required: true,
					zip: true	
					},
					/* contact_number: {
					required: true,
					contact_number:true
					}, */
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
                    userName: {
					company: "Please enter an alphanumeric value"
					},
					fname: {
					alpha: "Only Alphabets are allowed"
					},
					lname: {
					alpha: "Only Alphabets are allowed"
					},
					city:{
					alpha:"Only Alphabets are allowed"
					},
					state:{
					alpha:"Only Alphabets are allowed"
					},
                    zip: {
					required: "Only Numbers are Allowed",
					zip: "Min. 5 and Max. 6 Characters are Allowed"
					},
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
					 confirm_password: {
                        required: "Re-enter password",
                        minlength: "Your password must be at least 6 characters long",
						equalTo: "Password Not Matched"
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
jQuery.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
});
jQuery.validator.addMethod("company", function(value, element) {
    return this.optional(element) || /^[a-zA-Z \&]+$/.test(value);
});
/* jQuery.validator.addMethod("contact_number", function(value, element) {
    //return this.optional(element) || /^(\+\d{1,3}[- ]?)?\d{10}$/.test(value);
    return this.optional(element) || /^[1-9][0-9]{9}$/.test(value);
}); */
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
/* $("#company").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#company_desc").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#fname").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#lname").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#addr1").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#addr2").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#city").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#state").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#email").change(function()
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