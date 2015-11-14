	<!-- Vendor -->
	
	<script src="<?=base_url('assets/vendor/jquery.appear/jquery.appear.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery.easing/jquery.easing.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery-cookie/jquery-cookie.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/bootstrap/bootstrap.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/common/common.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery.validation/jquery.validation.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery.stellar/jquery.stellar.js') ?>"></script>
	<!-- <script src="<?=base_url('assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') ?>"></script> 
	<script src="<?=base_url('assets/vendor/jquery.gmap/jquery.gmap.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/twitterjs/twitter.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/isotope/jquery.isotope.js') ?>"></script> -->
	<script src="<?=base_url('assets/vendor/owlcarousel/owl.carousel.js') ?>"></script>
	<!--<script src="<?=base_url('assets/vendor/jflickrfeed/jflickrfeed.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/magnific-popup/jquery.magnific-popup.js') ?>"></script> -->
	<script src="<?=base_url('assets/vendor/vide/jquery.vide.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/numeric/numeric.js') ?>"></script>
	
	<!-- Theme Base, Components and Settings -->
	<script src="<?=base_url('assets/js/theme.js') ?>"></script>	<script src="<?=base_url('assets/js/index.js') ?>"></script>	
	
	<!-- Theme Custom -->
	<script src="<?=base_url('assets/js/custom.js') ?>"></script>
	<script src="<?=base_url('assets/js/jquery.mockjax.js') ?>"></script>
	<script src="<?=base_url('assets/js/jquery.validate.min.js') ?>"></script>
	
	<!-- Theme Initialization Files -->
	<script src="<?=base_url('assets/js/theme.init.js') ?>"></script>						
	<script type="text/javascript">
	$(window).resize(function(){
		
		 var win_height = $(window).height();
		//alert(win_height);
	  //$('.body').css('min-height', win_height);
	  $('.main .container').css('min-height', (win_height-365));
	});
	$( document ).ready(function() {
	  var win_height = $(window).height();
		//alert(win_height);
	  //$('.body').css('min-height', win_height);
	  $('.main .container').css('min-height', (win_height-365));
		
       if($(".numkk").length > 0 ){
	     $(".numkk").numeric();
	   }	   	 		
	   var q_size = $(".question ul").size();		
	   var x = 1;		
	   var y = "";		
	   var z = "";				
	   $('.ques_'+x).show();		
	   $('#next').click(function () {			
		   if(x<q_size){				
			x++;				
			y = x;				
			z =y-1;				
		   $('.ques_'+x).show();				
		   $('.ques_'+z).css("display", "none");			
		   }		
	   });				
	   $('#prev').click(function () {			
	   if(x>1){			
		$('.ques_'+z).show();			
		$('.ques_'+y).hide();			
		y--;			
		z--;			
		x--;			
		}		
	  });				/* $('.question ul:lt('+x+'), .question label:lt('+x+')').show();		$('#next').click(function () {			x= (x+1 <= q_size) ? x+1 : q_size;			$('.question ul:lt('+x+'), .question label:lt('+x+')').show();			var y = x-1;			//alert(y);			y= (y <0) ? 1 : y;			$('.question ul:lt('+y+'), .question label:lt('+y+')').hide();		});			 */		
	  
	  $('#congrat').click(function(){
		$('html, body').animate({scrollTop: '0px'}, 300);
		$('#top_username').focus();
	  });
	  (function($,W,D)
{
    var form_validate = {};

    form_validate =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#top_login").validate({
                rules: {
                    username: "required",
					password : "required"
                },
                submitHandler: function(form) {
					$.ajax({
                        url: '<?php echo site_url('main/authenticate_user') ?>',
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if(response != ''){
								$('.error').show();
								$('.error span').html(response);
							}else{
								form.submit();
							}
                        }            
                    });
                    //form.submit();
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
	
	function post_comment(){
	 var ven = $('#vendor-id').val();
	 var name = $('#name').val();
	 var email = $('#email').val();
	 var comment = $('#message').val();
	 
	 if(name == ''){
	   $('#name').focus();
	 }else if(email ==""){
	   $('#email').focus();
	 }
	 else if(comment == ""){
	    $('#message').focus();
	 }else{
	 
  $.ajax({
   type: "POST",
   url: '<?php echo site_url('clients/review'); ?>',
   data: {name:name,email:email,comment:comment,vendor:ven},
   success: function(data, textStatus, jqXHR)
    {
        window.location.reload();
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
 
    }
  });
  }
  }    
  function reset_valid() 
  {    
	  var error ="";    
	  var pass = document.getElementById("pass").value;  
	  var conf_pass = document.getElementById("confirm_pass").value;  	
	  if (pass == 0)	
	  {		
	  error += "Please Enter Your New Password.\n";	
	  }	
	  if(conf_pass == 0)	
	  {		
	  error += "Please Enter Confirm Password.\n";	
	  }	
	  else if(conf_pass != pass)	
	  {		
	  error += "Confirm Password Not Matched.\n";	
	  }		
	  if (error != "")	
	  {		
	  alert(error);		
	  return false;	
	  }
	  else{		
	  return true;	
	  }      
  
  }    
  
     
  function vendor_register() 
  {    
  var error ="";    
  var pass = document.getElementById("password").value;  
  var conf_pass = document.getElementById("confirm_pass").value;  
  var terms = document.getElementById("terms").value;  		
  if(conf_pass != pass)	{		
  error += "Password Not Matched.\n";	
  }		
  if ($('input[type=checkbox]:checked').length === 0) 
  {		
  error += "Please accept our Terms and Conditions by Clicking on the Checkbox.";	
  }		
  if (error != "")	
  {		
  alert(error);		
  return false;	
  }
  else{		
  return true;	
  }      
  }   
  </script>