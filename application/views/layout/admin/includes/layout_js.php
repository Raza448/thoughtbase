 </div><!-- ./wrapper -->
	<!-- Admin -->
	<script src="<?=base_url('assets/admin/js/jquery.min.js') ?>"></script>
	<script src="<?=base_url('assets/admin/js/bootstrap.min.js') ?>"></script>
	<script src="<?=base_url('assets/admin/js/jquery-ui.min.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery.validation/jquery.validation.js') ?>"></script>
	<script src="<?=base_url('assets/js/jquery.mockjax.js') ?>"></script>
	<script src="<?=base_url('assets/js/jquery.validate.min.js') ?>"></script>
	<!-- Morris.js charts -->
	<script src="<?=base_url('assets/admin/js/raphael-min.js') ?>"></script>
	<script src="<?=base_url('assets/admin/js/plugins/morris/morris.min.js') ?>"></script>
	
	<!-- Sparkline -->
	<script src="<?=base_url('assets/admin/js/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
	
	<!-- jvectormap -->
	<script src="<?=base_url('assets/admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
	<script src="<?=base_url('assets/admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
	
	<!-- jQuery Knob Chart -->
	<script src="<?=base_url('assets/admin/js/plugins/jqueryKnob/jquery.knob.js') ?>"></script>
	
	<!-- daterangepicker -->
	<script src="<?=base_url('assets/admin/js/plugins/daterangepicker/daterangepicker.js') ?>"></script>
	
	<!-- datepicker -->
	<script src="<?=base_url('assets/admin/js/plugins/datepicker/bootstrap-datepicker.js') ?>"></script>
	
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?=base_url('assets/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
	
	<!-- iCheck -->
	<script src="<?=base_url('assets/admin/js/plugins/iCheck/icheck.min.js') ?>"></script>
	
	<!-- AdminLTE App -->
	<script src="<?=base_url('assets/admin/js/AdminLTE/app.js') ?>"></script>
	
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<!--<script src="<?=base_url('assets/admin/js/AdminLTE/dashboard.js') ?>"></script>-->
	
	<!-- AdminLTE for demo purposes -->
	<script src="<?=base_url('assets/admin/js/AdminLTE/demo.js') ?>"></script>

	<!-- Theme Base, Components and Settings -->

	<script src="<?=base_url('assets/js/theme.js') ?>"></script>
	
	<script type="text/javascript">
	$('.change_pass').click(function(){
		$('#admin_login').hide();
		$('#password-form').show();
		$('.header').html('Change Password');
	});
	
	$('.login').click(function(){
		$('#admin_login').show();
		$('#password-form').hide();
		$('.header').html('Sign In');
	});
	
	<?php
	if(isset($_GET['id'])) { ?>
	$("#question_cat").change(function(){
	var ques_id = $(this).val();
	var id = "<?php echo $_GET['id'] ?>";
	var type = "<?php echo $_GET['type'] ?>";
	parent.location.assign("<?php echo site_url(); ?>/admin/main/survey_questions?id="+id+"&type="+type+"&ques_id="+ques_id+"");
	});
	<?php } ?>
	
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
    var template_validate = {};
	var mquestion_validate = {};
	var add_template = {};
	var modify_template = {};
	var setting_template = {};
	var password_template = {};
	
    template_validate =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#template-form").validate({
                submitHandler: function(form) {
                    form.submit();
                }
            });
			
		$('#template-form').find('.add_ques input[type=text]').each(function() {
			$(this).rules('add', {
				required: true,
				checkWords: true,
				messages: {
					required: "This field is required"
				}
			});
		});
		$('#template-form').find('.add_ques input[type=text]').each(function() {
			$(this).rules('add', {
				required: true,
				checkWords: true,
				messages: {
					required: "This field is required"
				}
			});
		});
		$('#template-form').find('#ques_cat').each(function() {
			$(this).rules('add', {
				required: true,
			});
		});
		$('#template-form').find('#ques_type').each(function() {
			$(this).rules('add', {
				required: true,
			});
		});
    }
	}
	mquestion_validate =
    {
        setupFormValidation: function()
        {
			
            //form validation rules
            $("#modify_question-form").validate({
                submitHandler: function(form) {
                    form.submit();
                }
            });
			
			$('#modify_question-form').find('#name').each(function() {
				$(this).rules('add', {
					required: true,
					checkWords: true,
					messages: {
						required: "This field is required"
					}
				});
			});
			$('#modify_question-form').find('#answer').each(function() {
				$(this).rules('add', {
					required: true,
					checkWords: true,
					messages: {
						required: "This field is required"
					}
				});
			});
        }
    }
	add_template =
    {
        setupFormValidation: function()
        {
			
            //form validation rules
            $("#add_template-form").validate({
                rules: {
					title: {
					 required: true,
					 checkWords: true
					}
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }
	modify_template =
    {
        setupFormValidation: function()
        {
			
            //form validation rules
            $("#modify_template-form").validate({
                rules: {
					temp_name: {
					 required: true,
					 checkWords: true
					}
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }
	password_template =
    {
        setupFormValidation: function()
        {
			
            //form validation rules
            $("#password-form").validate({
                rules: {
					current_password: {
					 required: true,
					 remote: '<?php echo site_url('admin/main/check_password') ?>'
					},
					new_password: {
					 required: true
					},
					confirm_password: {
					 required: true,
					 equalTo: '#new_password'
					}
                },
				messages:{
					current_password:{
						remote: "Your current password not matched."
					},
					confirm_password:{
						equalTo: 'Password not matched.'
					}
				},
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }
	setting_template =
    {
        setupFormValidation: function()
        {
			
            //form validation rules
            $("#setting-form").validate({
                rules: {
					site_name: {
					 required: true,
					 checkWords: true
					},
					site_url: {
					 required: true,
					 checkWords: true
					},
					general_question: {
					 required: true,
					 checkWords: true
					},
					user_commission: {
					 required: true,
					 number:true,
					 checkWords: true
					},
					site_commission: {
					 required: true,
					 number:true,
					 checkWords: true
					},
					site_email: {
					 required: true,
					 checkWords: true
					},
					contact_email: {
					 required: true,
					 checkWords: true
					},
					sandbox_payment_email: {
					 required: true,
					 checkWords: true
					},
					sandbox_api_username: {
					 required: true,
					 checkWords: true
					},
					sandbox_api_password: {
					 required: true,
					 checkWords: true
					},
					sandbox_api_signature: {
					 required: true,
					 checkWords: true
					},
					sandbox_app_id: {
					 required: true,
					 checkWords: true
					},
					live_payment_email: {
					 required: true,
					 checkWords: true
					},
					live_api_username: {
					 required: true,
					 checkWords: true
					},
					live_api_password: {
					 required: true,
					 checkWords: true
					},
					live_api_signature: {
					 required: true,
					 checkWords: true
					},
					live_app_id: {
					 required: true,
					 checkWords: true
					},
					twitter: {
					 required: true,
					 checkWords: true
					},
					facebook: {
					 required: true,
					 checkWords: true
					},
					linkedin: {
					 required: true,
					 checkWords: true
					},
					footer_copyright: {
					 required: true,
					 checkWords: true
					},
					validate_fields: {
					 required: true,
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
        template_validate.setupFormValidation();
        mquestion_validate.setupFormValidation();
        add_template.setupFormValidation();
        modify_template.setupFormValidation();
        setting_template.setupFormValidation();
        password_template.setupFormValidation();
    });

})(jQuery, window, document);
/* jQuery.validator.addMethod("company", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9- a\!.,?]+$/.test(value);
}); */
jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        error.appendTo('#errorcontainer-' + element.attr('id'));
    }
});
	
	var x = 1; //initlal text box count
    $(".add_field_button").click(function(e){ //on add input button click
        e.preventDefault();
        if(x < 10){ //max input box allowed
            x++; //text box increment
			$('<div style="display: none;"><input type="text"  class="form-control" name="answer[]" /><a href="#" class="remove_field">remove</a></div>').appendTo($(".input_fields_wrap")).slideDown("slow");
        }
    });
    
    $(".input_fields_wrap").on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--; //then remove from the DOM
	})
	</script>