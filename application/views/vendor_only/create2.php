<?php
$action = 'Submit';
$survey_id = 0;
if($this->session->userdata('step2')){
 $action = 'Update';
}
 $survey_id  = $this->session->userdata('survey_id');
 $data_temp  = $this->db->query('select * from survey_temp where id ='.$survey_id)->result_array();
 $template    = $data_temp[0]['template'];

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
					<?php $this->load->view('vendor_menu'); ?>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- ---->
				<ul class="portfolio-list" data-sort-id="portfolio" style="position: relative;height:auto;min-height:850px;">
							<li class="" >
								
							<h4>Create Query - Step 2</h4>
							
						<ul class="portfolio-list">
						 <li class="col-md-6 ">
						   <h6><b>Select survey template</b></h6>
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
<form method="post" action="" enctype="multipart/form-data">
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
	         <select name="template" onchange="show_div(this.value);" class="form-control input-lg" required>
			  <option value="">Select Template</option>
			  <?php foreach($result as $row => $val ){ ?>
			  <option value="<?php echo $val['id'] ?>" <?php if($template  == $val['id']){ ?> selected <?php } ?>  ><?php echo $val['name']; ?></option>
			  <?php } ?>
			</select>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12" id="anu" style="display:none; height:auto;" >
		<?php 
		
		foreach($result as $row => $val ){ ?>
		  <div id="a<?php echo $val['id']; ?>" style="padding-left:10px;display:none;">
           <?php if($val['id'] !=4 ){ ?>
           <!--  <ul style="list-style-type:none;padding:0px;" >
			   <li>
			    1) Have you used this product / service before ?
			   </li>
			   <li>
			      <ul style="list-style-type:none;padding:10px;">
                      <li>
					  <input name="type" onClick="pp<?php echo $val['id']; ?>(this.value);" type="radio" value="2">Yes
			          <li><input name="type" onClick="pp<?php echo $val['id']; ?>(this.value);" type="radio" value="1">No</li>
				 </ul>
			  </li>
			</ul> -->
         <?php } ?>
		 <?php if($val['id'] ==4 ){ ?>
            <ul style="list-style-type:none;padding:0px;" >
			   <li>Enter feedback question<br />
			    <textarea  class="form-control input-lg" name="question"><?php echo $data_temp[0]['question']; ?></textarea>
			   </li>
			</ul>
         <?php } ?>





	   <?php	
	    $i=2;
	    $qcqt = '';
	    $result1 = $this->db->query('select * from survey_questions where survey_id ='.$val['id'].' order by question_cat')->result_array();
		
				
		foreach($result1 as $rowz => $valz ){ 
            
			$temp = $valz['question_cat'];
			if($qcqt != $temp){
               
			}
			if($i == 7){
			 $i =2;
			}
		?>
		
           
		    <ul style="list-style-type:none;padding:0px;display:none;"   class="a<?php echo $val['id'].$valz['question_cat']; ?>">
			   <li>
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
                	<?php foreach($ans as $b => $q){ ?>
					<li><input type="radio" value="<?php echo $q['id']; ?>" ><?php echo $q['answer']; ?></li>
				    <?php } ?>
			       <?php }else if($valz['question'] == 2){ //textbox ?>
				   
				    
					   <li><input type="text"  value="" ></li>
				  
				   
			   
                   <?php }else if($valz['question'] == 3){ //combo ?>
				     <li>
					 <select>
					   <?php foreach($ans as $b => $q){ ?>
					   <option ><?php echo $q['answer']; ?></option>
				      <?php } ?>
					 </select>
					 </li>
				  
				   <?php }else if($valz['question'] == 4){ //checkbox ?>
				     <?php foreach($ans as $b => $q){ ?>
					<li><input type="checkbox" value="<?php echo $q['id']; ?>" ><?php echo $q['answer']; ?></li>
				    <?php } ?>
				   <?php }else{  ?>
					  <textarea ></textarea>
				   <?php } ?>
				 </ul>
			   </li> 
			</ul>
		 
	  <?php $i++;} ?>
	   </div>
	  <?php } ?>
		  
		</div>
	</div>
</div>
<div class="row">
  <div class="col-md-12">
  <input type="submit" value="Next >>"  style="float:right;" class="btn btn-primary  push-bottom" data-loading-text="Loading...">
  <a style="margin-right:4px;float:left;" href="<?php echo site_url('business/step1'); ?>"><input type="button" value="<< Back" class="btn btn-primary  push-bottom" data-loading-text="Loading..."></a>
 </div>
</div>
</form>
						 </li>
						 </ul>
				<!--- --->
			</div>
</div>
<input type="hidden" id="zz"  value="0">
<script type="text/javascript">
  function show_div(a){
     if( a !=""){
	 document.getElementById('anu').style.display = "block";
	 var k =  document.getElementById('zz').value;
	   if(k !=0 ){
	     document.getElementById('a'+k).style.display = "none";
	   }
	     document.getElementById('a'+a).style.display = "block";
		 document.getElementById('zz').value = a;
	 }
  }
  
  var pp = '<?php echo $template; ?>';
  if( pp > 0 ){
    document.getElementById('anu').style.display = "block";
	document.getElementById('a'+pp).style.display = "block";
	 document.getElementById('zz').value = pp;
  }
  
  
</script>
<?$this->layout->block('currentPageJS')?>
<!-- Current Page JS -->
<?$this->layout->block()?>