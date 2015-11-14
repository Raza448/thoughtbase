<?$this->layout->block('currentPageCss')?>
<link rel="stylesheet"  href="<?=base_url('assets/js/validator/bvalidator.css') ?>">
<script src="<?=base_url('assets/js/validator/jquery.bvalidator.js') ?>"></script>
<style>
.alert .fa {
  font-size: 20px;
  position: relative !important;
  top: 2px;
}
.alert-success .check {
  float: left;
  margin-right: 5px;
  height: 60px;
} 
.question ul { display:none;
}
.question label {
display:none;
}
.radio, .checkbox {
margin-top:0;
margin-bottom:0;
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


										<li class="active">Dashboard</li>


									</ul>


								</div>


							</div>


							<div class="row">


								<div class="col-md-12">


									<h2>Dashboard</h2>


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


		<div class="row">


		<div class="col-md-12" style="padding-bottom:10px;">


		   <?php #$this->load->view('client_menu'); ?>


		</div>


		</div>


		


		


	<div class="row">
	<?php
	$id = $this->session->userdata('client_id');
	$out = $this->db->query("SELECT * FROM users WHERE id='$id' and profile='0'")->row_array();
	if(!empty($out))
	{
		redirect('user/Profile');
	}
	//print_r($single);
	?>
  <?php if( count($single) > 0 ){ ?>

	<div class="col-md-5" style="padding-right: 0;">


	<aside class="sidebar">

								<h4 class="hide_title">New Queries <!--<span><i class="fa fa-caret-down fa-2x"></i></span>--></h4>


								<ul class="nav nav-list primary push-bottom">
                                   <?php 
								     if(count($data) > 0 ){
								     foreach($data as $row => $val ){
								   ?>

									<li class="hide_val"><div  class="queries"><?php echo date('M j',strtotime($val['created_on'])) ?>
									<?php //echo  " : "; ?>
										<span style="color:#C5C5C5;font-size: 16px;"> : 
											<a href="<?php echo site_url('user/myQueries/'.$val['id']);?>"><?php echo $val['name']; ?></a> 
										</span> - 
										<span class="price_box"> <?php echo  " $5.00 "; ?></span>
											
									</div>	
									</li>

									<?php }}else{ ?>

									<li><a href="javascript:void(0);">No Queries.<br />
									</li>
									<?php } ?>

								</ul>
							</aside>


	</div>
	<?php } ?>
	



             <?php if( count($single) > 0 ){ ?>
			 			<div class="col-md-7">

			<!--- ---->

		    <div class="row">
			  <div class="col-md-12 center">
				<h2 class="shorter"><?php echo $single[0]['name']; ?></h2> <?php echo $single[0]['description']; ?>
			   </div>	
            <?php 
               //checking for image exists in campaign
			   $query = "select * from survey_images where survey =".$single[0]['id'];
			   $bout = $this->db->query($query)->result_array();
			   if( count($bout) > 0 ){
			?>            
			<div class="col-md-12">
							<div id="owl-demo" class="owl-carousel">
							
							<?php 
							foreach($bout as $rowz => $vak ){ 
							if(file_exists(SITE_ROOT.'/assets/fineupload/server/files/'.$vak['folder'].'/'.$vak['image'])){
							?>
							<div>				
								<div class="thumbnail">
									<img alt="" class="img-responsive img-rounded" src="<?php echo base_url(); ?>assets/fineupload/server/files/<?php echo $vak['folder']; ?>/<?php echo $vak['image']; ?>">
								</div>
							</div>
                        <?php }} ?>							

					</div>

				</div>
				
				<?php 
				}
				?>
				</div>		
<div class="row" style="clear:both;">
  <div class="col-md-12 " style="height:auto;padding-top:40px;" >
     <form method="post" action="" id="query-form" novalidate="novalidate" autocomplete="off">
	 <input type="hidden" name="sid" value="<?php echo $single[0]['id']; ?>" />
	 <input type="hidden" name="temp" value="<?php echo $single[0]['template']; ?>" />
	 <input type="hidden" name="sname" value="<?php echo $single[0]['name']; ?>" />
	 <input type="hidden" name="amount" value="<?php echo $single[0]['user_amount']; ?>" />
	  <?php	
	    $i=1;
		$a =2;
		$bp =1;
	    $qcqt = '';
	    $result1 = $this->db->query('select * from survey_questions where survey_id ='.$single[0]['template'].' and question_cat=3 order by id asc')->result_array();
		if(count($result1) > 0){
		foreach($result1 as $rowz => $valz ){
            
			$temp = $valz['question_cat'];
			if($qcqt != $temp){
               $bp = 1;
			   $qcqt = $temp;
			}
			if($valz['question_cat'] == '2'){
			 
			 $i = $a++;
			}
			
		?>
          
		    <ul style="list-style-type:none;padding:0px;"  class="a<?php echo $valz['question_cat']; ?>" >
			   <li style="padding-bottom:5px;">
			    <?php echo $i; ?>) <?php echo $valz['question']; ?>
			   </li>
			    <li>
			      <ul style="list-style-type:none;padding:10px;">
			   <?php 
			     $ans = $this->db->query('select * from survey_answers where question_id ='.$valz['id'])->result_array();
				
				//checking answer type
				//1 = radio
				//2 = text box
				//3 = combo
				//4 = checkbox
				//5 = textarea
                   if($valz['ans_type'] == 1 ){ //radio	?>
                	<?php 
					$z = 1;
					foreach($ans as $b => $q){ ?>
					<li><div class="radio"> <input <?php if($z==1){ ?> <?php } ?> type="radio" id="s<?php echo $bp.$valz['question_cat']; ?>" class="s<?php echo $bp; ?> input-radio<?php echo $valz['question_cat']; ?>" name="<?php echo $valz['id']; ?>" value="<?php echo $q['id']; ?>" >
					<label><span><span></span></span><?php echo $q['answer']; ?></label></div></li>
				    <?php $z++;} ?><div id="errorcontainer-s<?php echo $bp.$valz['question_cat']; ?>" class='errorDiv'></div>
			       <?php }else if($valz['question'] == 2){ //textbox ?>

				   <li><input name="question" type="text" autocorrect="off" autocapitalize="none" value="" ></li>
				  
				   
			   
                   <?php }else if($valz['question'] == 3){ //combo ?>
				     <li>
					 <select name="<?php echo $valz['id']; ?>">
					   <?php foreach($ans as $b => $q){ ?>
					   <option ><?php echo $q['answer']; ?></option>
				      <?php } ?>
					 </select>
					 </li>
				  
				   <?php }else if($valz['question'] == 4){ //checkbox ?>
				     <?php foreach($ans as $b => $q){ ?>
					<li><div class="radio"><label><input type="checkbox" name="<?php echo $valz['id']; ?>" value="<?php echo $q['id']; ?>" ><?php echo $q['answer']; ?></label></div></li>
				    <?php } ?>
				   <?php }else{  ?>
					  <textarea autocorrect="off" autocapitalize="none" id="general<?php echo $bp ?>" class="form-control input-sl  s<?php echo $bp; ?>" name="general_thought" ></textarea>
					  <div id="results-general<?php echo $bp ?>" class="results error"></div>
				     <div id="errorcontainer-general<?php echo $bp ?>" class='errorDiv'></div>
				   <?php } ?>
				 </ul>
			   </li> 
			</ul>
			<div style="height:20px;"></div>
		 
		<?php $i++;$bp++; } ?>
		<div class="col-md-12 a3">
			<label>Enter text from the below image <span class="mandatory">*</span></label>
			<input name="captcha" id="captcha" type="text" autocorrect="off" autocapitalize="none" value=""  class="form-control input-lg"  required><div id="errorcontainer-captcha" class='errorDiv'></div>
			<span id="captcha_img" style="float:left;margin-top:10px;"><?php echo $cap['image']; ?></span><br />
			<a id="refresh_captcha" style="color:red; font-size:12px;margin: 0 3px;cursor:pointer;"><img src="<?php echo base_url('assets/img/captcha1.png') ?>" /></a>
			<input type="hidden" name="ocaptcha" value="<?php echo $cap['word']; ?>" class="form-control input-lg" id="ocaptcha">
		</div>
		<div class="col-md-12" style="padding-left: 10px;">
			<button type="submit" class="btn btn-default submit pull-right" id="submit">Submit</button>
		</div>
		<div style="height:30px;"></div>
		<?php }elseif( $single[0]['template'] == 4 ){ ?>
        <label class="ques_1"><?php echo $single[0]['question']; ?></label><br />
	     <ul class="ques_1" style="list-style:none;padding:0px;padding-top:5px;">
	       <li>
		   <textarea autocorrect="off" autocapitalize="none" class="form-control input-lg" name="single_question" id="desc"></textarea>
		  <div id="results-desc" class="results error"></div>
		  <div id="errorcontainer-desc" class='errorDiv'></div></li>
	     </ul>
		 <div class="row">
			 <div class="col-md-12">
				<label>Enter text from the below image <span class="mandatory">*</span></label>
				<input name="captcha" id="captcha" type="text" autocorrect="off" autocapitalize="none" value=""  class="form-control input-lg"  required><div id="errorcontainer-captcha" class='errorDiv'></div>
				<span id="captcha_img" style="float:left;margin-top:10px;"><?php echo $cap['image']; ?></span><br />
				<a id="refresh_captcha" style="color:red; font-size:12px;margin: 0 3px;cursor:pointer;"><img src="<?php echo base_url('assets/img/captcha1.png') ?>" /></a>
				<input type="hidden" name="ocaptcha" value="<?php echo $cap['word']; ?>" class="form-control input-lg" id="ocaptcha">
			</div>
		</div>
		 <div class="col-md-12" style="padding-left: 10px;">
			<button type="submit" class="btn btn-default submit pull-right" id="submit">Submit</button>
		 </div>
	     <br />
		 <br />
	  
	  
	  <?php }else{ ?>
	     <ul style="padding:0px; list-style:none;" >
			   <li>
			    1) <?php echo get_social_icon('general_question') ?>
			   </li>
			   <li>
			      <ul style="list-style-type:none;padding:10px;">
                      <li><div class="radio"><input name="type" onClick="pp(this.value);" type="radio" value="2"><label><span><span></span></span>Yes</label></div></li>
			          <li><div class="radio"><input name="type" onClick="pp(this.value);" type="radio" value="1"><label><span><span></span></span>No</label></div></li>
				 </ul>
			  </li>
		 </ul>
		  <?php	
	    $i=2;
		$a =2;
		$bp =1;
	    $qcqt = '';
	    $result1 = $this->db->query('select * from survey_questions where survey_id ='.$single[0]['template'].' and ans_type=1 order by question_cat')->result_array();
		
		foreach($result1 as $rowz => $valz ){
            
			$temp = $valz['question_cat'];
			if($qcqt != $temp){
               $bp = 1;
			   $qcqt = $temp;
			}
			if($valz['question_cat'] == '2'){
			 
			 $i = $a++;
			}
			
		?>
          
		    <ul style="list-style-type:none;padding:0px;display:none;"  class="a<?php echo $valz['question_cat']; ?>" >
			   <li style="padding-bottom:5px;">
			    <?php echo $i; ?>) <?php echo $valz['question']; ?>
			   </li>
			    <li>
			      <ul style="list-style-type:none;padding:10px;">
			   <?php 
			     $ans = $this->db->query('select * from survey_answers where question_id ='.$valz['id'])->result_array();
				
				//checking answer type
				//1 = radio
				//2 = text box
				//3 = combo
				//4 = checkbox
				//5 = textarea
                   if($valz['ans_type'] == 1 ){ //radio	?>
                	<?php 
					$z = 1;
					foreach($ans as $b => $q){ ?>
					<li><div class="radio"><input <?php if($z==1){ ?> <?php } ?> type="radio" id="s<?php echo $bp.$valz['question_cat']; ?>" class="s<?php echo $bp; ?> input-radio<?php echo $valz['question_cat']; ?>" name="<?php echo $valz['id']; ?>" value="<?php echo $q['id']; ?>" >
					<label><span><span></span></span><?php echo $q['answer']; ?></label></div></li>
				    <?php $z++;} ?><div id="errorcontainer-s<?php echo $bp.$valz['question_cat']; ?>" class='errorDiv'></div>
			       <?php }else if($valz['question'] == 2){ //textbox ?>

				   <li><input name="question" type="text" autocorrect="off" autocapitalize="none" value="" ></li>
				  
				   
			   
                   <?php }else if($valz['question'] == 3){ //combo ?>
				     <li>
					 <select name="<?php echo $valz['id']; ?>">
					   <?php foreach($ans as $b => $q){ ?>
					   <option ><?php echo $q['answer']; ?></option>
				      <?php } ?>
					 </select>
					 </li>
				  
				   <?php }else if($valz['question'] == 4){ //checkbox ?>
				     <?php foreach($ans as $b => $q){ ?>
					<li><div class="radio"><label><input type="checkbox" name="<?php echo $valz['id']; ?>" value="<?php echo $q['id']; ?>" ><?php echo $q['answer']; ?></label></div></li>
				    <?php } ?>
				   <?php }else{  ?>
					 <textarea autocorrect="off" autocapitalize="none" class="form-control input-sl  s<?php echo $bp; ?>" name="general_thought" ></textarea>
				   <?php } ?>
				 </ul>
			   </li> 
			</ul>
		 
	  <?php $i++;$bp++;
		  if($valz['question_cat'] == '1')
		  {
			$za = $i;
		  }
	  }
	   $result2 = $this->db->query('select * from survey_questions where survey_id ='.$single[0]['template'].' and ans_type=2 order by question_cat')->result_array();
		$r = 1;
		foreach($result2 as $rowz => $valz1 ){
		?>
		<ul style="list-style-type:none;padding:0px;display:none;"  class="a<?php echo $valz1['question_cat']; ?>" >
			   <li style="padding-bottom:5px;">
			   <?php
				if($valz1['question_cat'] == '1'){echo $za;} else {echo $i;} ?>) <?php echo $valz1['question']; ?>
			   </li>
			    <li>
			      <ul style="list-style-type:none;padding:10px;">
				  <textarea autocorrect="off" autocapitalize="none" id="general<?php echo $r ?>" class="form-control input-sl  s<?php echo $bp; ?>" name="general_thought" ></textarea><div id="results-general<?php echo $r ?>" class="results error"></div>
				  <div id="errorcontainer-general<?php echo $r ?>" class='errorDiv'></div>
				  </ul>
				  </li>
				 </ul>
		<?php
		$za++;
		$r++;
		}?>
			 <div class="col-md-12 a1" style="display:none;">
				<label>Enter text from the below image <span class="mandatory">*</span></label>
				<input name="captcha1" id="captcha1" type="text" autocorrect="off" autocapitalize="none" value=""  class="form-control input-lg"  required><div id="errorcontainer-captcha1" class='errorDiv'></div>
				<span id="captcha_img1" style="float:left;margin-top:10px;"><?php echo $cap['image']; ?></span><br />
				<a id="refresh_captcha1" style="color:red; font-size:12px;margin: 0 3px;cursor:pointer;"><img src="<?php echo base_url('assets/img/captcha1.png') ?>" /></a>
				<input type="hidden" name="ocaptcha1" value="<?php echo $cap['word']; ?>" class="form-control input-lg" id="ocaptcha1">
			</div>
			<div class="col-md-12 a2" style="display:none;">
				<label>Enter text from the below image <span class="mandatory">*</span></label>
				<input name="captcha" id="captcha" type="text" autocorrect="off" autocapitalize="none" value=""  class="form-control input-lg"  required><div id="errorcontainer-captcha" class='errorDiv'></div>
				<span id="captcha_img" style="float:left;margin-top:10px;"><?php echo $cap['image']; ?></span><br />
				<a id="refresh_captcha" style="color:red; font-size:12px;margin: 0 3px;cursor:pointer;"><img src="<?php echo base_url('assets/img/captcha1.png') ?>" /></a>
				<input type="hidden" name="ocaptcha" value="<?php echo $cap['word']; ?>" class="form-control input-lg" id="ocaptcha">
			</div>
		<div class="col-md-12" style="padding-left: 10px;">
			<button type="submit" style="display:none;" class="btn btn-default submit kki pull-right" id="submit">Submit</button>
		</div>
	   <div style="height:30px;"></div>
	  <?php } ?>

      </form>

			</div>
</div>
	</div>
		  <!--- ---->
			<?php }else{	?>
			
			  <div class="col-md-12 " style="font-size:22px;margin-top:0px;" align="center" >
	             <b>You have no new queries.</b>
			  </div>
			<?php } ?>

		
		</div>
	</div>



<script type="text/javascript">
 function pp(a){
   $('.kki').show();
   if(a ==1 ){
     $('.a1').hide();
     $('.a1 input[type=radio]').prop('disabled', true);
     $('.a1 textarea').prop('disabled', true);
     $('.a1 #captcha1').prop('disabled', true);
	 $('.a2').show();
	 $('.a2 input[type=radio]').prop('disabled', false);
     $('.a2 textarea').prop('disabled', false);
	 $('.a2 #captcha').prop('disabled', false);
   }else{
     $('.a2').hide();
	 $('.a2 input[type=radio]').prop('disabled', true);
     $('.a2 textarea').prop('disabled', true);
	 $('.a2 #captcha').prop('disabled', true);
	 $('.a1').show();
	 $('.a1 input[type=radio]').prop('disabled', false);
     $('.a1 textarea').prop('disabled', false);
	 $('.a1 #captcha1').prop('disabled', false);
   }   
 }
</script>



<?$this->layout->block('currentPageJS')?>

<script type="text/javascript">
$(document).ready(function() {

$("#owl-demo").owlCarousel({
    navigation:true,
    singleItem : true,
    autoHeight : true
  });
  
/* $(".hide_val").show();
    $(".hide_title").click(function(){
        $(".hide_val").slideToggle();
}); */

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
                submitHandler: function(form) {
                    form.submit();
                }
            });
			
		$('#query-form').find('.input-sl').each(function() {
        $(this).rules('add', {
            required: true,
			checkWords: true,
            messages: {
                required: "This field is required"
            }
        });
    });
	$('#query-form').find('#desc').each(function() {
        $(this).rules('add', {
            required: true,
			checkWords: true,
            messages: {
                required: "This field is required"
            }
        });
    });
	$('#query-form').find('.input-radio1').each(function() {
        $(this).rules('add', {
            required: true,
            messages: {
                required: "This field is required"
            }
        });
    });
	$('#query-form').find('.input-radio3').each(function() {
        $(this).rules('add', {
            required: true,
            messages: {
                required: "This field is required"
            }
        });
    });
	$('#query-form').find('.input-radio2').each(function() {
        $(this).rules('add', {
            required: true,
            messages: {
                required: "This field is required"
            }
        });
    });
	$('#captcha').rules('add', {
		required: true,
		equalTo: "#ocaptcha",
		messages: {
			required: "Enter Captcha",
			equalTo: "Invalid captcha"
		}
	});
	$('#captcha1').rules('add', {
		required: true,
		equalTo: "#ocaptcha1",
		messages: {
			required: "Enter Captcha",
			equalTo: "Invalid captcha"
		}
	});
	$('#captcha2').rules('add', {
		required: true,
		equalTo: "#ocaptcha2",
		messages: {
			required: "Enter Captcha",
			equalTo: "Invalid captcha"
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
/* $("#desc").change(function() {
		var a = $(this).val();
		var id = $(this).attr('id');
		ajax_spam(a,id);
	});
$("#general1").change(function() {
		var a = $(this).val();
		var id = $(this).attr('id');
		ajax_spam(a,id);
	});
$("#general2").change(function() {
		var a = $(this).val();
		var id = $(this).attr('id');
		ajax_spam(a,id);
	});
function ajax_spam(a,id) {
	$.ajax({
	type: "POST",  
	url: "<?php echo site_url('main/validating_fields'); ?>",  
	data: {t_val: a},
	success: function(data){  
		$("#results-"+id).html(data);
		if(data != '')
		{
			$('#submit').prop('disabled', true);
		}
		else
		{
			$('#submit').prop('disabled', false);
		}
		} 		
	});
} */
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
$('#refresh_captcha1').click(function(event){
	 var site_url = '<?php echo site_url(); ?>';
	 event.preventDefault();
	 $.ajax({
		 url:site_url+'/main/check_captcha',
		 dataType : 'json',
		 success:function(response){
			 $('#captcha_img1').html(response.captcha);
			 $('#ocaptcha1').val(response.captcha_word);
			 //document.getElementById('ocaptcha').value = response.captcha_word;
			 //$('#captcha_img').html(data);
		 }
	 });            
});
});
</script>

<!-- Current Page JS -->

<?$this->layout->block()?>

