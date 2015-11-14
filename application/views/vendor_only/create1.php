<?$this->layout->block('currentPageCss')?>
<link rel="stylesheet" href="<?=base_url('assets/css/style.css') ?>">
<style>
span {
display: block;
font-size: 16px !important;
line-height: 1.5;
text-align: justify;
float:left;
}
label.error{
margin-top:0;
}
form label {
	font-weight: normal;
	font-size: 16px;
	/* float: left;
	width: 40%; */
	margin-right:10%;
	padding: 0;
}
.input-lg, .form-horizontal .form-group-lg .form-control {
/* float:left;
width:50%; */
}
.col-md-6 {
/* float:right;
padding:0;
width:50%; */
}
@media screen and (max-width: 768px) {
    .col-md-6 {
		float:left;
		width:100%;
	}
	.input-lg, .form-horizontal .form-group-lg .form-control {
		width:100%;
	}
	form label {
		float: left;
		width: 100%;
		margin-right: 0;
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
							<li class="active">Create Query</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8" style="float: none;margin: 0 auto;">
						<h2>Create Query Step 1</h2>
					</div>
				</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<?php $this->load->view('components/flash_msg'); ?>	
			</div>
		</div>
		<!--<div class="row">
			<div class="col-md-12">
					<div>&nbsp;</div>
			</div>
		</div>-->
		<div class="row">
			<div class="col-md-8" style="float: none;margin: 0 auto;">
				<!-- ---->
				<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;">
							
						 <li class="col-md-12">
						    <?php $this->load->view('components/survey1'); ?>
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
            $("#query-form").validate({
                rules: {
					title: {
					 required: true,
					 checkWords: true
					},
                    description: {
					 required: false,
					 maxlength: 500,
					 checkWords: true
					},
					template : {
					required: true,
					},
					question : {
					required: true,
					checkWords: true
					},
                },
                messages: {
                    title: {
					required: "This field is required",
					},
					question: {
					required: "This field is required",
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
/* jQuery.validator.addMethod("company", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9- a\!.,?]+$/.test(value);
}); */
jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        error.appendTo('#errorcontainer-' + element.attr('id'));
    }
});
$(document).on('click', '.close', function(){
    $('.modal').toggleClass('active');
});
$(document).on('click', '.inner_close', function(){
    $('.custom_modal').toggleClass('active');
});

$(document).on('click', '.upd_template', function(){
	var datastring = $("#query-form").serialize();
	//alert(datastring);
    $.ajax({
		type: 'GET',
		url : "<?php echo site_url('main/edit_question') ?>",
		data : datastring,
		success:function(response){
			/* $('.custom_modal').toggleClass('active');
			$('.modal').toggleClass('active'); */
		}
	});
});
/* $(document).on('click', '.add_custom_question', function(){
	var template_id = $('.template_id').val();
    $.ajax({
		type: 'GET',
		url : "<?php echo site_url('main/add_custom_questions') ?>",
		data : {id:template_id},
		success:function(response){
			$('.custom_modal').toggleClass('active');
			$('.custom_modal').html(response);
		}
	});
});
$(document).on('click', '.add_question', function(){
	var datastring = $("#query-form").serialize();
    $.ajax({
		type: 'GET',
		url : "<?php echo site_url('main/edit_question') ?>",
		data : datastring,
		success:function(response){
			$('.custom_modal').toggleClass('active');
			$('.modal').toggleClass('active');
		}
	});
}); */
var x = 1; //initlal text box count
$(document).on('click', '.add_field_button', function(e){ //on add input button click
	e.preventDefault();
	if(x < 6){ //max input box allowed
		x++; //text box increment
		$('<div style="display: none;"><input type="text"  class="form-control" name="answer[]" style="width:80%;"/><a href="#" class="remove_field">remove</a></div>').appendTo($(".input_fields_wrap")).slideDown("slow");
	}
});

$(document).on('click', '.remove_field', function(e){ //user click on remove text
	e.preventDefault(); $(this).parent('div').remove(); x--; //then remove from the DOM
})

$(document).on('click', '.delete_ques', function(e){ //user click on remove text
	e.preventDefault(); 
	var className = $(this).parent('div').attr('rel');
	//alert(className);
	$(this).parent('div').remove();
	$('.'+className+'').remove(); //then remove from the DOM
})
$(document).on('change', '#ques_type', function(){
	var cat = $(this).val();
	if(cat == 1){
		$(".add_ques").show();
		$(".add_ques_text").hide();
		$(".add_ques_text textarea").prop('disabled', true);
		$(".add_ques input[type=text]").prop('disabled', false);
	}else if(cat == 2){
		$(".add_ques_text").show();
		$(".add_ques").hide();
		$(".add_ques_text textarea").prop('disabled', false);
		$(".add_ques input[type=text]").prop('disabled', true);
	}else{
		$(".add_ques").hide();
		$(".add_ques_text").hide();
		$(".add_ques_text textarea").prop('disabled', true);
		$(".add_ques input[type=text]").prop('disabled', true);
	}
});

/* $("#title").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#desc").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#desc").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
$("#feedback").change(function()
{
	var a = $(this).val();
	var id = $(this).attr('id');
	ajax_spam(a,id);
});
 */
function ajax_spam(a,id) {
	$.ajax({
	type: "POST",  
	url: "<?php echo site_url('main/validating_fields'); ?>",  
	data: {t_val: a},
	success: function(data){  
		$("#results-"+id).html(data);
		if(data != '')
		{
			$('#next').prop('disabled', true);
		}
		else
		{
			$('#next').prop('disabled', false);
		}
		} 		
	});
}
});
</script>
<?$this->layout->block()?>