<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<style>
@media screen and (min-width: 992px) {
	.deact {
	  float: right;
	}
	.mand {
		padding:0;
	}
	
}
@media screen and (max-width: 768px) {
	
    .col-md-6 {
		float:left;
		width:100%;
	}
}

</style>
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
		
		<div class="row">
			<div class="col-md-12">
					<?php //$this->load->view('vendor_menu'); ?>	
			</div>
		</div>
		
						<div class="row">
							<div class="col-md-12">
							
							<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;/* min-height:850px; */">
							<li class="col-md-6" >
						
						 
						 </li>
						 <li class="col-md-12 pad-0" style="float:left;">
						   
						 <?php $this->load->view('components/vendor_profile_form',array('result'=>$result)); ?>	
						 
						 </li>
						 </ul>
						 <ul class="portfolio-list">
						 <li class="col-md-6 deact pad-0"> 						  
						 <div style="margin-top:40px;">
						   <h4 style="float:left;">Deactivate Account</h4><a onClick="return confirm('Are you sure you want to delete this account ?');" href="<?php echo site_url('business/deactivate'); ?>"> <input type="button" value="Deactivate" class="btn btn-default pull-right" data-loading-text="Loading..."></a>
						   </div>
						   <div class="col-md-12 mand">
									<p class="note">&nbsp;</p>
								</div>
						 </li>
						 </ul>
							
								
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
					userName: {
					required: true,
					checkWords: true
					},
					fname: {
					required: true,
					alpha: true,
					checkWords: true
					},
					company:{
					required: true,
					maxlength: 500,
					checkWords: true
					},
					lname: {
					required: true,
					alpha: true,
					checkWords: true
					},
					uen: {
					required: true,
					checkWords: true
					},
					addr: {
					required: false,
					checkWords: true
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
                    vendor_email: {
					required: true,
					email: true,
					checkWords: true
					},
                    term: "required",
					captcha : "required"
                },
                messages: {
                    userName: {
					company: "Please enter an alphanumeric value",
					},
                    fname: {
					alpha:"Only Alphabets are allowed"
					},
                    lname: {
					alpha:"Only Alphabets are allowed"
					},
					company:{
					required: "This field is rquired",
					},
                    city:{
					alpha:"Only Alphabets are allowed"
					},
					state:{
					alpha:"Only Alphabets are allowed"
					},
					uen: {
					required: "This field is rquired",
					},
                    zip: {
					required: "Only Numbers are Allowed",
					zip: "Min. 5 and Max. 6 Characters are Allowed"
					},
                    vendor_email: {
					required: "Please enter a valid email address",
					},
                    term: "Please accept our policy",
					captcha : "Please Enter the text from Below image"
                },
                submitHandler: function(form) {
                    form.submit();
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
jQuery.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
});
jQuery.validator.addMethod("company", function(value, element) {
    return this.optional(element) || /^[a-zA-Z \&]+$/.test(value);
});
jQuery.validator.addMethod("zip", function(value, element) {
    return this.optional(element) || /^[0-9]{5,6}$/.test(value);
});
jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        error.appendTo('#errorcontainer-' + element.attr('id'));
    }
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