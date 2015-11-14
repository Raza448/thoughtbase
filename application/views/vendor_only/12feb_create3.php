<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<?php
$action = 'Submit';
$survey_id = 0;
if($this->session->userdata('step3')){
 $action = 'Update';
}
 $survey_id  = $this->session->userdata('survey_id');
 $data_temp  = $this->db->query('select * from survey_temp where id ='.$survey_id)->result_array();
 $template    = $data_temp[0];
 $age        = $template['age'];
 $gender     = $template['gender'];
 $miles      = $template['miles'];
 $zipcode    = $template['zipcode'];
 $interest   = $template['interest'];
 
?>

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
										<li class="active">Create Query</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Create Query Step 2</h2>
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
			<div class="col-md-12">
					
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- ---->
				<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;min-height:850px;">
					<li class="" >
						
						<ul class="portfolio-list">
						 <li class="col-md-6 ">
						   <h6><b>Select Target Audience</b></h6>
						   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
						   Quisque rutrum pellentesque imperdiet. Nulla lacinia 
						   iaculis nulla non pulvinar. Cum sociis natoque penatibus 
						   et magnis dis parturient montes, nascetur ridiculus mus. 
						   Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus<br />
						   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
						   Quisque rutrum pellentesque imperdiet. Nulla lacinia 
						   iaculis nulla non pulvinar. Cum sociis natoque penatibus 
						   et magnis dis parturient montes, nascetur ridiculus mus. 
						   Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus <br />
						   </li>
						 </ul>	 
						 </li>
						 <li class="col-md-6 ">
						    <div class="col-md-12">
				              <?php $this->load->view('components/form_message'); ?>	
                            </div>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="step3" value="step3" >
<div class="row">
<div class="form-group">
<div class="col-md-12">
 <img id="burr" src="<?php echo base_url();?>assets/img/loading.gif" height="50" style="display:none;" />
</div>
</div>
</div>
<div class="row">
	<div class="radio">
	<div class="col-md-12">
	  <label>
		<input type="radio" name="optionsRadios" id="target_aud" value="option1" checked>
		Select Target Audience
	  </label>
	 </div>
	</div>
</div>
<div class="row">
	<div class="radio">
	<div class="col-md-12">
	  <label>
		<input type="radio" name="optionsRadios" id="custom_email" value="option2">
		Enter Customer Emails
	  </label>
	  <p style="color:#bcbcbc;"> </p>	   
	 </div>
	</div>
</div>
<div class="custom_users" style="display:none;">
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Enter Customer Emails separated by comma.</label>
			<textarea  name="description" id="desc" class="form-control input-lg"></textarea>
			<div class="col-md-6">
				<div id="errorcontainer-desc" class='errorDiv'></div>
			</div>
		</div>
	</div>
</div>
<div class="alert alert-info">
     <strong><span id="tot_user"></span>&nbsp; user(s) selected.&nbsp;$
	 <span id="custom_amount"></span></strong>
     <input type="hidden" id="custom_kk_am" value="" name="custom_kk_am">
	 <input type="hidden" id="custom_kk_am_user" value="" name="custom_kk_am_user">
</div>
</div>
<div class="target_users">
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
		<label>Age Range</label>	<br />
	    <select name="age" onChange="age_ajax1(this.value);" id="age" class="form-control input-lg">
		 <option value="0">- Any Range-</option>
         <option value="1" <?php if($age == 1){ ?>  selected <?php } ?> >12 - 17</option>
		 <option value="2" <?php if($age == 2){ ?>  selected <?php } ?> >18 - 24</option>
		 <option value="3" <?php if($age == 3){ ?>  selected <?php } ?> >25 - 34</option>
		 <option value="4" <?php if($age == 4){ ?>  selected <?php } ?> >35 - 44</option>
		 <option value="5" <?php if($age == 5){ ?>  selected <?php } ?> >45 - 54</option>
		 <option value="6" <?php if($age == 6){ ?>  selected <?php } ?> >55 - 64</option>
		 <option value="7" <?php if($age == 7){ ?>  selected <?php } ?> >65+</option>
	   </select>	
<p style="color:#bcbcbc;"> </p>	   
		</div>
	</div>
</div>


<div class="row">
	<div class="form-group">
		<div class="col-md-12">
		<label>Gender</label>	<br />
         <select name="gender" onChange="gender_ajax1(this.value);" id="gender" class="form-control input-lg">
		 <option value="0">- Any Gender-</option>
         <option value="1" <?php if($gender == 1){ ?>  selected <?php } ?> >Male</option>
		 <option value="2" <?php if($gender == 2){ ?>  selected <?php } ?> >Female</option>
	   </select>	
<p style="color:#bcbcbc;"> </p>	   	   
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-6">
		<label>Location</label>	<br />
         <select name="miles" class="form-control input-lg" id="miles" onChange="manu(this.value)">
		   <option value="0">Any</option>
		   <option value="5" <?php if($miles == 5){ ?>  selected <?php } ?>>5 Miles from Zip</option>
		   <option value="10" <?php if($miles == 10){ ?>  selected <?php } ?>>10 Miles from Zip</option>
		   <option value="50" <?php if($miles == 50){ ?>  selected <?php } ?>>50 Miles from Zip</option>
		   <option value="100" <?php if($miles == 100){ ?>  selected <?php } ?>>100 Miles from Zip</option>
		   <option value="300" <?php if($miles == 300){ ?>  selected <?php } ?>>300 Miles from Zip</option>
		   <option value="500" <?php if($miles == 500){ ?>  selected <?php } ?>>500 Miles from Zip</option>
		 </select>
		 <p style="color:#bcbcbc;"> </p>	   
		</div>
		<div class="col-md-6">
		<div  id="kzip" style="display:none;">
		<label >Zipcode</label><br />
          <input name="zipcode" id="zipcode" maxlength="5" type="number" value="<?php echo $zipcode; ?>" style="width:70%;float:left;"  class="form-control input-lg">
         <!-- <input type="button" onClick="checkZip();" style="float:left;height:45px;margin-left:7px;" value="search" class="btn btn-primary  push-bottom" data-loading-text="Loading..."> -->
        <br />
		</div>
		</div>
	</div>
</div>
<div class="row">
<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;">
							<li class="col-md-12 " >
							
						<ul class="portfolio-list">
						 <label>Interests</label>
						 <li style="overflow: hidden;width: 100%;">
						  <?php 
						    $kint  = explode('#',$interest); 
						    $query = "select * from interests";
						    $out   = $this->db->query($query);
							$z     = $out->result_array();
						    if(count($z)>0){
							$i=0;
							foreach($z as $ry => $y ){
						  ?>
						    <label><input style="float:left" onClick="interest_ajax1();"  <?php if(in_array($y['id'],$kint)){ ?> checked <?php } ?> name="interest[<?php echo $i; ?>]" class="form-control1 kkcx" type="checkbox" value="<?php echo $y['id'];  ?>">&nbsp;<?php echo $y['name']; ?></label><br />
							
						    
						  <?php 
						   $i++;}}
						  ?>
						 </li> 
						</ul>
						</li>
					</ul>
    
</div>

<div class="row">
  <div class="col-md-12" style="padding-top:20px;" >
  <div class="alert alert-info">
     <strong><span id="use"><?php echo $tot; ?></span>&nbsp; user(s) selected.&nbsp;$
	 <?php 
	  //total amount calculation comes here
	   $set_re   = $this->db->query('select * from settings')->result_array();	
	   $per_user = $set_re[0]['val'];
	   if($tot > 0 ){
	     $tat  = $tot*$per_user;
	     $zbt  = number_format((float)$tat, 2, '.', '');
	   //calculating user percentage
	     $tper = ($set_re[1]['val']/100)*$tat;
	     $ttot = $tat - $tper;
	     $zbt_user = number_format((float)($ttot/$tot), 2, '.', '');
	   }else{
	     $zbt = 0.00;
	     $zbt_user =0.00;
	   }	   	  
	 ?>
	 <span id="amount"><?php echo $zbt; ?></span></strong>
     <input type="hidden" id="kk_am" value="<?php echo $zbt; ?>" name="kk_am">
	 <input type="hidden" id="kk_am_user" value="<?php echo $zbt_user; ?>" name="kk_am_user">
  </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-12" style="padding-top:20px;" >
   <input type="submit" value="Next >>" style="float:right;" id="bback" class="btn btn-primary  push-bottom" data-loading-text="Loading...">
 <?php if($this->session->userdata('create')){ ?>
   <a style="float:left;" href="<?php echo site_url('business/step1'); ?>"><input type="button"  value="<< Back" class="btn btn-primary  push-bottom" data-loading-text="Loading..."></a>
 <?php } ?>
  </div>
</div>
		 </li>
	 </ul>
	<!--- -->
  </div>
</div>
<input type="hidden" id="zz"  value="0">
<input type="hidden" id="age_ajax" value="<?php echo ($age > 0 )? $age :0; ?>" />
<input type="hidden" id="gender_ajax" value="<?php echo ($gender > 0 )? $gender :0; ?>" />
<input type="hidden" id="mile_ajax" value="<?php echo ($miles > 0 )? $miles :0; ?>" />
<input type="hidden" id="interest_ajax" value="<?php echo ($interest !=""  )? str_replace('#','/',$interest) :0; ?>" />
</form>

<script type="text/javascript" >
 function age_ajax1(a){
   if(a != 0 ){
     document.getElementById('age_ajax').value = a;
     call_ajax();
   }else{
     document.getElementById('age_ajax').value = 0;
	 call_ajax();
   }
 }
 
 function gender_ajax1(a){
   if(a != 0 ){
     document.getElementById('gender_ajax').value = a;
	 call_ajax();
   }else{    
     document.getElementById('gender_ajax').value = 0;
	 call_ajax();
   }
 }
 
 var xhr;
 var timer;
	
 function call_ajax(){
	if(timer) {
		clearTimeout(timer);
	}
	timer = setTimeout(function(){
		age      = document.getElementById('age_ajax').value;
		gender   = document.getElementById('gender_ajax').value;
		interest = document.getElementById('interest_ajax').value;
		range    = document.getElementById('miles').value;
		zip      = document.getElementById('zipcode').value;
		if(range > 0 ){
		  $('#kzip').show();
		}
		$("#burr").show();
		//$("#age").prop('disabled', true);
		//$("#gender").prop('disabled', true);
		//$("#miles").prop('disabled', true);
		//$("#zipcode").prop('disabled', true);
		//alert(this.xhr);
		// abort previous request.
		//console.log(this.xhr);
		if (typeof this.xhr !== 'undefined')
			 this.xhr.abort();
		console.log(this.xhr);	 
		this.xhr = $.ajax({ 
			url: '<?php echo site_url('main/ajax'); ?>', 
			type: 'POST', 
			dataType : 'json',
			// make this option false is blocking the request. deprecated in jquery 1.8
			async : true,
			data: {age : age ,gender: gender,interest:interest, range:range,zip:zip}, 
			success: function( response ){ 
				document.getElementById('use').innerHTML = response.count;
				document.getElementById('amount').innerHTML = response.amount;
				document.getElementById('kk_am').value = response.amount;
				document.getElementById('kk_am_user').value = response.amount_user;
				
				if( response.amount > 0 ){
				 $('#bback').show();
				}else{
				 $('#bback').hide();
				}
				
				//$("#age").prop('disabled', false);
				//$("#gender").prop('disabled', false);
				//$("#miles").prop('disabled', false);
				//$("#zipcode").prop('disabled', false);
				$("#burr").hide();
			}, 
			error: function(){ 
				$("#age").prop('disabled', false);
				$("#gender").prop('disabled', false);
				$("#miles").prop('disabled', false);
				$("#zipcode").prop('disabled', false);
				$("#burr").hide();			
			}
		});
	}, 500);	

 }
 
 
 function interest_ajax1(){
    var z = '';
    $('.kkcx').each(function (){
	  if($(this).is(':checked')){
	     z  = z.concat($(this).val()+'/');
	  }
	
	});
	if(z ==''){
	  document.getElementById('interest_ajax').value =0;
	}else{
	  document.getElementById('interest_ajax').value = z;
	}
	call_ajax();
 }
 
 window.onload = call_ajax;
 
 function manu(a){
    if(a==0){
	  $('#zipcode').val('');
	  $('#kzip').hide();
	  call_ajax();
    }else{
	  if($('#zipcode').val() > 0 ){
	    call_ajax();
	  }else{
	   $('#kzip').show();	
	   $('#zipcode').focus();
	  }
	}
 }
	var timer2;
	// checking zipcode.
	$("#zipcode").keyup(function(){
			var x = document.getElementById('zipcode');
			var p = x.value;
			var n = p.length;
			if( n > 4 && n < 7){
				call_ajax();
			}else if(n > 6){
			   alert("maximum 6 digits are allowed");
			   var newval = p.substring(0, p.length - 1);
			   x.value = newval;
			   x.focus();
			   return false;
			}
	});
	
	$("#custom_email").click(function() {
		$(".target_users").hide();
		$(".custom_users").show();
	});
	$("#target_aud").click(function() {
		$(".target_users").show();
		$(".custom_users").hide();
		
	});
	$("#desc").change(function() {
		var b = $(this).val();
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var e_val = b.split(",");
		var rr;
		var e = [];
		for(rr in e_val)
		{
			if(!e_val[rr].match(mailformat))
			{
				alert("Please Enter Valid E-mail ID.");
			}
			else
			{
				var res = e_val[rr];
				e.push(res);
			}
		}
		//alert(e);
		if (typeof this.xhr !== 'undefined')
			 this.xhr.abort();
		console.log(this.xhr);	 
		this.xhr = $.ajax({ 
			url: "<?php echo site_url('main/ajax_amount'); ?>",
			type: 'POST', 
			dataType : 'json',
			// make this option false is blocking the request. deprecated in jquery 1.8
			async : true,
			data: {emails: e},
			success: function(response){  
				document.getElementById('tot_user').innerHTML = response.tot_user;
				document.getElementById('custom_amount').innerHTML = response.custom_amount;
				document.getElementById('custom_kk_am').value = response.custom_amount;
				document.getElementById('custom_kk_am_user').value = response.custom_amount_user;
				}  
		});
	});
	
	
</script>



<?$this->layout->block('currentPageJS')?>
<!-- Current Page JS -->
<?$this->layout->block()?>