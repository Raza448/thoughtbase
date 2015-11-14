<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<style>
.row {
    margin-right: -5px;
    margin-left: -5px;
}
@media screen and (max-width: 768px) {
.query_submit{
padding:0 !important;
}
.completed{
padding:0 !important;
}
}
</style>
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<script type="text/javascript" src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
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
			<div class="col-md-12">
					<?php $this->load->view('vendor_menu'); ?>	
			</div>
		</div>
		<div style="clear:both;">&nbsp;</div>
		<div class="row">
			<div class="col-md-9">
			  <!--<h4><?php #echo $result['name']; ?></h4>-->
				<div class="pricing-table">
					<div class="col-md-6 tot_user">
						<?php				
							$rtsz = 'SELECT * FROM clients_survey WHERE survey_id ='.$result['id'];
							$retp = $this->db->query($rtsz)->result_array();
						?>
					<div class="wrapper">
						<div class="icon"><img src="<?php echo base_url(); ?>assets/img/user_icon.png"></div>
						<div style="float:left;"><h1><?php echo count($retp); ?></h1>
						<?php if(count($retp) <= 1 ){ ?> User <?php }else{ ?> Users <?php } ?> <!--<p> 1 Total Users</p>--></div>
					</div>
					</div>
					
					<div class="col-md-6 tot_query">
					<div class="wrapper">
						<div class="icon"><img src="<?php echo base_url(); ?>assets/img/complete_icon.png"></div>
						<div style="float:left;"><h1><?php echo $this->attended; ?></h1>
						Completed <!--<p> <?php echo $this->attended; if($this->attended <= 1 ){ ?> Query <?php }else{ ?> Queries <?php } ?> Submitted</p>--></div>
					</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
		<div class="col-md-9">
		<div class="row">
		<?php
		
			$result2 = $this->db->query('select * from survey_questions where survey_id ='.$result['template'].' and question_cat=3 order by id asc')->result_array();
			if(empty($result2)){ 
			 if(($result['template'] != 4)) { ?>
			 <div class="col-md-12" style="margin-bottom:30px;">
				<div class="col-md-6 tot_user pad-0">
				<label>
				 <input name="customer" type="radio" class="new_cust" value="" checked><div><span><span></span></span>&nbsp;Existing Customers</div>
				 </label>
				</div>
				<div class="col-md-6 tot_query pad-0">
				<label>
				 <input name="customer" type="radio" class="new_cust" value="2"><div><span><span></span></span>&nbsp;Potential New Customers</div>	
				 </label>
				</div>
								<!--<div class="col-md-6 pad-0 marg" style="text-align: center;">
								 <input type="radio" name="custom_users" id="custom_email" class="custom_email" value="2">
								<label style="font-size: 18px;"><span><span></span></span>Enter Customer Emails</label>
								</div>-->
							
			<!--<div class="col-md-6 tot_user pad-0" style="text-align:center;">
				<div class="form-group">
				<input name="customer" type="radio" class="new_cust" value="" checked><label><span><span></span></span>&nbsp;Existing Customers</label>	
				</div>
			</div>
			<div class="col-md-6 tot_query pad-0" style="text-align:center;">
				<div class="form-group">
					<input name="customer" type="radio" class="new_cust" value="2"><label><span><span></span></span>&nbsp;Potential New Customers</label>	
				</div>
			</div>-->
			</div>
			<?php }  } ?>	
			</div>
			</div>
		</div>
		
		<?php 
		    $kt  = 'SELECT * FROM survey_temp WHERE id ='.$result['id'];
		    $kt1 = $this->db->query($kt)->result_array(); 
			if($kt1[0]['template'] == 4 ){		
		?>
		
		<div class="row">
			<div class="col-md-12" style="padding-bottom:10px;" >
			 <h4><?php echo $kt1[0]['question']; ?></h4>
			 <h5>Comments</h5>
						 <ul class="portfolio-list">
						     <li>
						      <div id="commentsz">
<?php
 $sql ='select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes 
  left join users on
  client_answes.client_id = users.id where
  client_answes.survey_id='.$result['id'].' and client_answes.comment !=""';
 
 $data_img = $this->db->query($sql)->result_array();  
?>
<?php if(count($data_img ) > 0 ){  
foreach($data_img as $row => $val ){
?>
<div>
<?php
if($val['age'] == 1 ){
$age = '12-17';
}else if( $val['age'] == 2 ){
$age = '18-24';
}else if( $val['age'] == 3 ){
$age = '25-34';
}else if( $val['age'] == 4 ){
$age = '35-44';
}else if( $val['age'] == 5 ){
$age = '45-54';
}else if( $val['age'] == 6 ){
$age = '55-64';
}else
{
 $age = '65+';
}

?>
<strong>Age: <?php echo $age; ?>,&nbsp;&nbsp;Gender: <?php echo ucfirst($val['gender']); ?>,&nbsp;&nbsp;Zip: <?php echo $val['zipcode']; ?></strong>
<br />
<span style="font-size:17px;"><?php echo $val['comment']; ?></span>
</div>
<br />
<?php }}else{ ?>
<div>
No Comments yet
<h6 style="display:none;font-weight:bold;"><i class="fa fa-star"></i>Age Group:~ <i class="fa fa-star"></i>Gender:~ <i class="fa fa-star"></i>Zip:~ </h6>
</div>
<br />
<?php } ?>
							  </div>
						     </li>
						 </ul>	 
			
			</div>
	    </div>
		<?php }else{ ?>
		
		
		
		<div class="row">
			
		</div>
	   	<div class="row">
			<div class="col-md-12 old" style="padding:0;">
				<div class="row"><!-- ---->
				<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;">
					
						  <div class="col-md-9" style="padding-bottom:10px;" >
				 
						
							<div class="col-md-8">
							<?php
							 $result1 = $this->db->query('select * from survey_questions where survey_id ='.$result['template'].' order by question_cat')->result_array();
							?>
								Question:
								<div class="form-group drop">
									<select id="question" class="form-control input-lg">
									<?php if(count($result1) > 0 ){ foreach($result1 as $r => $er){ 
									 if(($er['ans_type'] != '2') && ($er['question_cat'] == '1')){
									?>
									<option value="<?php echo $er['id']; ?>"><?php echo $er['question']; ?></option>
									<?php }else if(($er['ans_type'] != '2') && ($er['question_cat'] == '3')){
									?>
									<option value="<?php echo $er['id']; ?>"><?php echo $er['question']; ?></option>
									<?php }
									}} ?>
									</select>
								</div>
								</div>
								<div class="col-md-4">
								Sort By: 
								<div class="form-group drop">
									<select id='sort' class="form-control input-lg">
									<option value="1">All</option>
									<option value="2">Gender</option>
									<option value="3">Age</option>
									</select>
								</div>
						       </div>
							 <div>&nbsp;</div>
						   <div class="col-md-12" id="answerz">
						     Please select a question from above list
							</div>
						
						
						</div>
						</ul>
						 
		
		<div class="col-md-3" style="padding-bottom:10px;" >
		<div class="col-md-12">
			 <h4><?php echo $kt1[0]['question']; ?></h4>
			 <h5>Comments</h5>
						 <ul class="portfolio-list">
						     <li>
						      <div id="commentsz">
<?php

$sql = 'select survey_questions.question_cat,client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.survey_id,client_answes.question_id, users.age,users.gender,users.zipcode from client_answes left join survey_questions on client_answes.question_id = survey_questions.id left join users on client_answes.client_id = users.id where client_answes.survey_id='.$result['id'].' and client_answes.comment !=""';

 /* $sql ='select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes 
  left join users on
  client_answes.client_id = users.id where
  client_answes.survey_id='.$result['id'].' and client_answes.comment !=""'; */
   $data_img = $this->db->query($sql)->row_array();  
 ?>
<?php if((count($data_img) > 0) && ($data_img['question_cat'] != '2')){ ?>
<div>
<?php
if($data_img['age'] == 1 ){
$age = '12-17';
}else if( $data_img['age'] == 2 ){
$age = '18-24';
}else if( $data_img['age'] == 3 ){
$age = '25-34';
}else if( $data_img['age'] == 4 ){
$age = '35-44';
}else if( $data_img['age'] == 5 ){
$age = '45-54';
}else if( $data_img['age'] == 6 ){
$age = '55-64';
}else
{
 $age = '65+';
}

?>
<strong style="font-style:italic;">Age: <?php echo $age; ?>,&nbsp;&nbsp;Gender: <?php echo ucfirst($data_img['gender']); ?>,&nbsp;&nbsp;Zip: <?php echo $data_img['zipcode']; ?></strong>
<br />
<span style="font-size:17px;"><?php echo $data_img['comment']; ?></span>
</div>
<br />
<?php }else{ ?>
<div>
No Comments yet
<h6 style="display:none;"><i class="fa fa-star"></i>Age Group:~ <i class="fa fa-star"></i>Gender:~ <i class="fa fa-star"></i>Zip:~ </h6>
</div>
<br />
<?php } ?>
							  </div>
						     </li>
						 </ul>	 
			
			</div>
			</div>
			</div>
		</div>
		
		<div class="col-md-12 new" style="padding:0;display:none;">
				<div class="row"><!-- ---->
				<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;">
					
						  <div class="col-md-9" style="padding-bottom:10px;" >
				 
						
							<div class="col-md-8">
							<?php
							 $result1 = $this->db->query('select * from survey_questions where survey_id ='.$result['template'].' order by question_cat')->result_array();
							?>
								Question: 
								<div class="form-group drop">
									<select id="new_question" class="form-control input-lg">
									<?php if(count($result1) > 0 ){ foreach($result1 as $r => $er){ 
									 if(($er['ans_type'] != '2') && ($er['question_cat'] == '2')){
									?>
									<optgroup>
									<option value="<?php echo $er['id']; ?>"><?php echo $er['question']; ?></option>
									</optgroup>
									<?php }else if(($er['ans_type'] != '2') && ($er['question_cat'] == '3')){
									?>
									<optgroup>
									<option value="<?php echo $er['id']; ?>"><?php echo $er['question']; ?></option>
									</optgroup>
									<?php }
									}} ?>
									</select>
								</div>
								</div>
								<div class="col-md-4">
								Sort By: 
								<div class="form-group drop">
									<select id="sort" class="form-control input-lg">
									<option value="1">All</option>
									<option value="2">Gender</option>
									<option value="3">Age</option>
									</select>
								</div>
						       </div>
							 <div>&nbsp;</div>
						   <div class="col-md-12" id="answerz1">
						     Please select a question from above list
							</div>
						
						
						</div>
						</ul>
						 
		
		<div class="col-md-3" style="padding-bottom:10px;" >
		<div class="col-md-12">
			 <h4><?php echo $kt1[0]['question']; ?></h4>
			 <h5>Comments</h5>
						 <ul class="portfolio-list">
						     <li>
						      <div id="commentsz">
<?php
 $sql = 'select survey_questions.question_cat,client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.survey_id,client_answes.question_id, users.age,users.gender,users.zipcode from client_answes left join survey_questions on client_answes.question_id = survey_questions.id left join users on client_answes.client_id = users.id where client_answes.survey_id='.$result['id'].' and client_answes.comment !="" and question_cat=2';
 
 $data_img = $this->db->query($sql)->row_array();  
 //echo $data_img['comment'];
?>
<?php if((count($data_img) > 0) && ($data_img['question_cat'] != '1')){ ?>
<div>
<?php
if($data_img['age'] == 1 ){
$age = '12-17';
}else if( $data_img['age'] == 2 ){
$age = '18-24';
}else if( $data_img['age'] == 3 ){
$age = '25-34';
}else if( $data_img['age'] == 4 ){
$age = '35-44';
}else if( $data_img['age'] == 5 ){
$age = '45-54';
}else if( $data_img['age'] == 6 ){
$age = '55-64';
}else{
 $age = '65+';
}
?>
<strong style="font-style:italic;">Age: <?php echo $age; ?>,&nbsp;&nbsp;Gender: <?php echo ucfirst($data_img['gender']); ?>,&nbsp;&nbsp;Zip: <?php echo $data_img['zipcode']; ?></strong>
<br />
<span style="font-size:17px;"><?php echo $data_img['comment']; ?></span>
</div>
<br />
<?php }else{ ?>
<div>
No Comments yet
<h6 style="display:none;"><i class="fa fa-star"></i>Age Group:~ <i class="fa fa-star"></i>Gender:~ <i class="fa fa-star"></i>Zip:~ </h6>
</div>
<br />
<?php } ?>
							  </div>
						     </li>
						 </ul>	 
			
				</div>
			</div>
		</div>
		</div>
		</div>
		<?php } ?>

<?php 
  if($kt1[0]['template'] != 4 ){		
?>

<script type="text/javascript">
   function  callmanu(){
	if ($('#question').prop("disabled") == false){
		var question = document.getElementById('question').value;
	}else{
		var question = document.getElementById('new_question').value;
	}
	//alert(question);
	var sort = 1;
	var a = $('.old #sort').val();
	var b = $('.new #sort').val();
	if(a == null){
		var sort = b;
	}else{
		var sort = a;
	}
	
	var survey   = '<?php echo $result['id']; ?>';
	//alert(sort);
	if( question > 0 ){
		$.ajax({ 
		  url: '<?php echo site_url('main/ajax_one'); ?>', 
		  type: 'post', 
		  dataType : 'json',
		  async : false,
		  data: {question : question ,sort: sort,survey:survey}, 
		  success: function( data, textStatus, jQxhr ){ 
		   $('#answerz').html('');
			$('#answerz').html(data.question);
			$('#answerz1').html('');
			$('#answerz1').html(data.question);
			/*$('#commentsz').html(data.comment);*/
			$('#myModal').modal('hide');
		  }, 
		  error: function( jqXhr, textStatus, errorThrown ){ 
			$('#myModal').modal('hide');
		  } 
		});   
	   }else{
        alert('Please select a question');
       }
	   
	   
	   
	}
	
  $(function(){
      $( "#progressbar" ).progressbar({
	        max: <?php echo $this->sent; ?>, 
           value: <?php echo $this->attended; ?>
    });
	
	if( '<?php echo $this->attended; ?>' > 0 ){
	$('.ui-progressbar-value').show();
    } 
	 // setTimeout(progress, 3000);
	 callmanu();
  });
  
  $('.new #sort').change(function(){
	 callmanu();
  });
  $('.old #sort').change(function(){
	 callmanu();
  });
  $('#new_question').change(function(){
	  callmanu();
  });
  $('#question').change(function(){
	  callmanu();
  });
  
  $('.new_cust').click(function(){
	var ab = $(this).val();
	if(ab == 2){
		$('.old').hide();
		$('#question').prop('disabled', 'disabled');
		$('.old #sort option').prop('disabled', 'disabled');
		callmanu();
		$('.new').show();
	}else{
		$('.old').show();
		$('#question').prop('disabled', false);
		$('.old #sort option').prop('disabled', false);
		callmanu();
		$('.new').hide();
	}
  });
</script>

<?php }else{ ?>
<script type="text/javascript">
$(function(){
      $( "#progressbar" ).progressbar({
	        max: <?php echo $this->sent; ?>, 
           value: <?php echo $this->attended; ?>
    });
	
	if( '<?php echo $this->attended; ?>' > 0 ){
	$('.ui-progressbar-value').show();
    } 
	  });
</script>
<?php } ?>
<!--- model ---->

<div class="modal" id="myModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          Processing your request....
        </div>
      </div>
    </div>
</div>
<!-- --->

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>