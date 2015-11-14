<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<style>
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
		<div class="row">
			<div class="col-md-12">
			  <!--<h4><?php #echo $result['name']; ?></h4>-->
				<div class="pricing-table" style="padding-top:15px;">
				 
					<div class="col-md-3 col-sm-3 " style="padding-left: initial;padding-right: 2px;">
	               <div style="border:1px solid #ccc; padding: 15px 20px;" >
				<?php				
				    $rtsz = 'SELECT * FROM clients_survey WHERE survey_id ='.$result['id'];
	                $retp = $this->db->query($rtsz)->result_array();
			    ?>
			   <ul style="list-style:none;padding:0 20px;display:block;border:none; margin: 0 auto;">
			   <li style="float:left;border:none;">
				<img height="100" src="<?php echo base_url(); ?>assets/img/users.jpg">
				</li>
				<li style="float:left;padding-left:10px;border:none;"><h1 style="color:#2E99D2;line-height:50px;font-size: 65px;margin: 20px 0 0 !important;"><?php echo count($retp); ?></h1>
				 <span style="font-size:16px;">Users</span>
				</li>
				</ul>
		
				
								<div style="clear:both;">&nbsp;</div>
								</div>
								<div style="clear:both;">&nbsp;</div>	
							</div>
							
<div class="col-md-6 col-sm-6 query_submit" style="padding:0 10px;">
<style>
.progress-label {
    float: left;
    margin-left: 50%;
    margin-top: 5px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
}
.box{ width:100px;position:absolute; font-size: 10px;color:#666; font-style:italic;line-height:1;}
.box2{left:20px;top:20px;width:200px;}
.box1{right:0px;top:20px}
</style>
<div id="progressbar" style="height:47px;" >
 <div class="box box1"><?php echo $this->sent; ?> Total Users</div>
<div class="box box2"><?php echo $this->attended; if($this->attended <= 1 ){ ?> Query <?php }else{ ?> Queries <?php } ?> Submitted</div>
</div>
				<br />	<br /><br />
	<?php
	
	$result2 = $this->db->query('select * from survey_questions where survey_id ='.$result['template'].' and question_cat=3 order by id asc')->result_array();
	if(empty($result2)){ 
	 if(($result['template'] != 4)) { ?>
	<div class="form-group">
		<label class="customer"><input name="customer" type="radio" class="new_cust" value="" style="float:left;margin:4px 0;" checked>&nbsp;Existing Customers</label>	
		<label class="customer"><input name="customer" type="radio" class="new_cust" value="2" style="float:left;margin:4px 0;">&nbsp;Potential New Customers</label>	
	</div>
	<?php }  } ?>	
						
							</div>
							
							
							
							
	<div class="col-md-3 col-sm-3 completed" style="padding-left: inherit;padding-right: 2px;">
	<div style="border:1px solid #ccc;padding: 15px 20px;" >

								
							<?php				
				                 $rtsz1 = 'SELECT * FROM completed_survey WHERE survey_id ='.$result['id'];
		                         $retp1 = $this->db->query($rtsz1)->result_array();
			                ?>
			<ul style="list-style:none;padding:0 10px; display:block;border:none; margin: 0 auto;">
			   <li style="float:left;border:none;">
				<img height="100" src="<?php echo base_url(); ?>assets/img/completed.png">
				</li>
				<li style="float:left;padding-left:10px;border:none;"><h1 style="color:#0B8914;line-height:50px;font-size: 65px;margin: 20px 0 0 !important;"><?php echo count($retp1); ?></h1><span style="font-size:16px;">Completed</span>
				</li>
				</ul>
								

								<div style="clear:both;">&nbsp;</div>
								</div>
								<div style="clear:both;">&nbsp;</div>	
							</div>
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
						      <div id="commentsz" style="width:100%; height: auto; max-height:400px; overflow-y: scroll;">
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
				<!-- ---->
				<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;">
					
						  <div class="col-md-9" style="padding-bottom:10px;" >
				 
						
							<div class="col-md-8">
							<?php
							 $result1 = $this->db->query('select * from survey_questions where survey_id ='.$result['template'].' order by question_cat')->result_array();
							?>
								Question: <select id="question" class="form-control input-lg">
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
								<div class="col-md-4">
								Sort By: <select id="sort" class="form-control input-lg">
								<option value="1">All</option>
								<option value="2">Gender</option>
								<option value="3">Age</option>
								</select>
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
						      <div id="commentsz" style="width:100%; height: auto; max-height:400px; overflow-y: scroll;">
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
		
		<div class="col-md-12 new" style="padding:0;display:none;">
				<!-- ---->
				<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;">
					
						  <div class="col-md-9" style="padding-bottom:10px;" >
				 
						
							<div class="col-md-8">
							<?php
							 $result1 = $this->db->query('select * from survey_questions where survey_id ='.$result['template'].' order by question_cat')->result_array();
							?>
								Question: <select id="new_question" class="form-control input-lg">
								<?php if(count($result1) > 0 ){ foreach($result1 as $r => $er){ 
								 if(($er['ans_type'] != '2') && ($er['question_cat'] == '2')){
								?>
								<option value="<?php echo $er['id']; ?>"><?php echo $er['question']; ?></option>
								<?php }else if(($er['ans_type'] != '2') && ($er['question_cat'] == '3')){
								?>
								<option value="<?php echo $er['id']; ?>"><?php echo $er['question']; ?></option>
								<?php }
								}} ?>
								</select>
								</div>
								<div class="col-md-4">
								Sort By: <select id="sort" class="form-control input-lg">
								<option value="1">All</option>
								<option value="2">Gender</option>
								<option value="3">Age</option>
								</select>
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
						      <div id="commentsz" style="width:100%; height: auto; max-height:400px; overflow-y: scroll;">
<?php
 $sql = 'select survey_questions.question_cat,client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.survey_id,client_answes.question_id, users.age,users.gender,users.zipcode from client_answes left join survey_questions on client_answes.question_id = survey_questions.id left join users on client_answes.client_id = users.id where client_answes.survey_id='.$result['id'].' and client_answes.comment !=""';
 
 $data_img = $this->db->query($sql)->row_array();  
 //print_r($data_img);
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
	var sort     = document.getElementById('sort').value;
	var survey   = '<?php echo $result['id']; ?>';
	
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
  
  $('#sort').change(function(){
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
		callmanu();
		$('.new').show();
	}else{
		$('.old').show();
		$('#question').prop('disabled', false);
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