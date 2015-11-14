<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<style>
.payment_details {
		margin:20px 0 0 0;
	}
@media (min-width: 768px) {
    .payment_details {
		margin:0;
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
										<li class="active">Create Query</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Create Query Step 3</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
		<?php if($this->error !=""){ ?>
		<div class="row">
			<div class="col-md-12">
               <div class="alert alert-danger">
                  <?php echo $this->error; ?>
               </div>
			</div>
		</div>

		<?php } ?>
		<div class="row">
			<div class="col-md-12">
					<?php $this->load->view('components/flash_msg'); ?>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
					
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- ---->
				<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;min-height:850px;">
							<li class="" >
							<div class="col-md-6">	
							<h4>Create Query - Make Payment</h4>
							</div>
						<ul class="portfolio-list">
						 <li class="col-md-6 ">
						   
						   </li>
						 </ul>	 
						 </li>
						 <li class="col-md-6 ">
						    <?php $this->load->view('components/survey4'); ?>
						 </li>
						 </ul>
				<!--- --->
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

    form_validate =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#payment-form").validate({
                rules: {
					customer_first_name: {
					required: true,
					alpha:true,
					checkWords: true
					},
					customer_last_name: {
					required: true,
					alpha:true,
					checkWords: true
					},
					customer_address1 : {
					required: true,
					checkWords: true
					},
					customer_address2: {
					required:false,
					checkWords: true
					},
					customer_city: {
					required: true,
					alpha:true,
					checkWords: true
					},
					customer_state: {
					required: true,
					alpha:true,
					checkWords: true
					},
                    customer_zip: {
					required: true,
					zip:true,
					},
					customer_credit_card_number: {
					required: true,
					card: true,
					},
					cc_cvv2_number: {
					required: true,
					verify: true
					}
                },
                messages: {
                    customer_first_name: {
					alpha: "Only Alphabets are allowed",
					},
                    customer_last_name: {
					alpha: "Only Alphabets are allowed",
					},
                    customer_city: {
					alpha: "Only Alphabets are allowed",
					},
                    customer_state: {
					alpha: "Only Alphabets are allowed",
					},
					customer_address1: {
					required: "This field is required",
					},
                    customer_zip: {
					required: "Only Numbers are allowed",
					zip: "Min. 5 and Max. 6 characters are allowed",
					},
					customer_credit_card_number : "Please Enter 16 Characters of your Card Number",
					cc_cvv2_number : "Please Enter 3 Characters of your CVV Number"
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
jQuery.validator.addMethod("zip", function(value, element) {
    return this.optional(element) || /^[0-9]{5,6}$/.test(value);
});
jQuery.validator.addMethod("company", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
});
jQuery.validator.addMethod("card", function(value, element) {
    return this.optional(element) || /^[0-9]{1,16}$/.test(value);
});
jQuery.validator.addMethod("verify", function(value, element) {
    return this.optional(element) || /^[0-9]{1,3}$/.test(value);
});
jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        error.appendTo('#errorcontainer-' + element.attr('id'));
    }
});
$("#back").click(function(){
	window.history.back();
});
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
			$('#payment').prop('disabled', true);
		}
		else
		{
			$('#payment').prop('disabled', false);
		}
		} 		
	});
	}
}
});
</script>
<?$this->layout->block()?>