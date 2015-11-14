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
										<li class="active">Forgot Password</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Forgot Password</h2>
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
						<?php 
						if(isset($error))
						{
						?>
						<div class="alert alert-danger">
						<strong>Error!</strong> <?php echo $error; ?>
						</div>
						<?php
						}
						?>
				</div>
			</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row featured-boxes login">
									<div class="col-md-6">
										<div class="default info-content row">
											<div class="box-content">
												<form action="<?=site_url('main/forgot_password') ?>" id="login" method="post" >
														<div class="form-group">
															<div class="col-md-12">
																<label>E-mail Address</label>
																<input name="email" type="email" autocorrect="off" autocapitalize="none"  value="<?php echo set_value('email'); ?>" id="email" class="form-control input-lg">
																<div id="errorcontainer-email" class='errorDiv'></div>
															</div>
														</div>
														<div class="col-md-12">
															<input type="submit" value="Submit" class="btn btn-default pull-left push-bottom" data-loading-text="Loading...">
														</div>
												</form>
											</div>
										</div>
									</div>
								</div>

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
            $("#login").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
						checkWords: true
					},
                },
                messages: {
                    email: {
					required: "Please enter a valid email address",
					},
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
jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        error.appendTo('#errorcontainer-' + element.attr('id'));
    }
});
});
</script>
<?$this->layout->block()?>