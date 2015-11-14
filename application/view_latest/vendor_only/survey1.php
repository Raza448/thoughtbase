<!-- script src="<?=base_url('assets/js/multi.js') ?>"></script -->
<script src="<?=base_url('assets/fineupload/fine.js') ?>"></script>
<link href="<?=base_url('assets/fineupload/fine.css') ?>" rel="stylesheet">



<?php

$token = uniqid();


$action = 'Submit';
$survey_id = 0;
if($this->session->userdata('step1')){
 $action = 'Update';
 $survey_id = $this->session->userdata('survey_id');
 $data_temp  = $this->db->query('select * from survey_temp where id ='.$survey_id)->result_array();
 $template    = $data_temp[0]['template'];
}
?>
<div class="col-md-12">
	<?php $this->load->view('components/form_message'); ?>	
</div>
<form method="post" action="" id="query-form" novalidate="novalidate" enctype="multipart/form-data">
<input type="hidden" name="token" value="<?php echo $token; ?>" />
<span id="tricky">

</span>
<div class="row">
	<div class="form-group"> 	
		<div class="col-md-12">
			<label>Enter the title of your product, service, issue, or idea.<a class="mandatory"> *</a></label>
			
			<input name="title" type="text" autocorrect="off" autocapitalize="none" id="title" value="<?php echo set_value('title',(isset($data_temp[0]['name']) ? stripslashes($data_temp[0]['name']):'')); ?>" class="form-control input-lg" >
			<div class="col-md-6">
				<div id="results-title" class="results error"></div>
				<div id="errorcontainer-title" class='errorDiv'></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
			<label>Use the Description area to add promotional text. Think of this as textual ad space.(optional)</label>
			<textarea autocorrect="off" autocapitalize="none" name="description" id="desc" class="form-control input-lg" required><?php echo isset($data_temp[0]['description']) ? stripslashes($data_temp[0]['description']) : set_value('description'); ?></textarea>
			<div class="col-md-6">
				<div id="results-desc" class="results error"></div>
				<div id="errorcontainer-desc" class='errorDiv'></div>
			</div>
		</div>
	</div>
</div>
<div class="row" style="padding:20px 0;">
	<div class="form-group">
		<div class="col-md-12">
		<label>Choose your query template.<a class="mandatory">*</a></label>
	         <select name="template" onchange="show_div(this.value);" id="template" class="form-control input-lg" required />
			  <option value="">Select Template</option>
			  <?php foreach($result as $row => $val ){ ?>
			  <option value="<?php echo $val['id'] ?>" <?php if(isset($template)){if($template  == $val['id']){ ?> selected <?php } } ?>  ><?php echo $val['name']; ?></option>
			  <?php } ?>
			</select>
			<div class="col-md-6">
				<div id="errorcontainer-template" class='errorDiv'></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="form-group">
		<div class="col-md-12" id="anu" style="display:none; height:auto;" >
		<?php 
		
		foreach($result as $row => $val ){ ?>
		  <div id="a<?php echo $val['id']; ?>" style="display:none;">
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
			   <li><label><span>Enter feedback question</span><span class="mandatory">*</span></label>
			    <textarea autocorrect="off" autocapitalize="none" class="form-control input-lg" id="feedback" name="question"><?php echo isset($data_temp[0]['question']) ? stripslashes($data_temp[0]['question']) : set_value('question'); ?></textarea>
				<div class="col-md-6">
				<div id="results-feedback" class="results error"></div>
				<div id="errorcontainer-feedback" class='errorDiv'></div>
			</div>
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
				   
				    
					   <li><input type="text" autocorrect="off" autocapitalize="none" value="" ></li>
				  
				   
			   
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
					  <textarea autocorrect="off" autocapitalize="none"></textarea>
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
	<div class="form-group">
		<div class="col-md-12">
			<label>Optionally select one or multiple photos to upload.</label>
			<div id="thumbnail-fine-uploader" style="float:left;"></div>

<script type="text/template" id="qq-simple-thumbnails-template">
  <div class="qq-uploader-selector qq-uploader"> 
    <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
      <span>Drop files here to upload</span>
    </div>
    <div class="qq-upload-button-selector qq-upload-button">
      <div>Upload Photos</div>
    </div>
    <span class="qq-drop-processing-selector qq-drop-processing">
      <span>Processing dropped files...</span>
      <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
    </span>
	<div class="col-md-6">
    <ul class="qq-upload-list-selector qq-upload-list">
      <li>
        <div class="qq-progress-bar-container-selector">
          <div class="qq-progress-bar-selector qq-progress-bar"></div>
        </div>
        <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
        <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
        <span class="qq-edit-filename-icon-selector qq-edit-filename-icon"></span>
        <span class="qq-upload-file-selector qq-upload-file"></span>
        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text" autocorrect="off" autocapitalize="none">
        <span class="qq-upload-size-selector qq-upload-size"></span>
        <a class="qq-upload-cancel-selector qq-upload-cancel" href="#">Cancel</a>
        <a class="qq-upload-retry-selector qq-upload-retry" href="#">Retry</a>
        <a class="qq-upload-delete-selector qq-upload-delete" href="#">Delete</a>
        <span class="qq-upload-status-text-selector qq-upload-status-text"></span>
      </li>
    </ul>
	</div>
  </div>
</script>

			
			
			
			
		</div>
	</div>
</div>

<?php if($survey_id > 0 ){ ?>
<div class="row">
	<div class="form-group">
		<div class="col-md-12">
		   <?php 
		    $data_img  = $this->db->query('select * from survey_images where survey ='.$survey_id)->result_array();  
		    if( count($data_img) > 0 ){ ?>
		    <ul style="list-style:none;padding:0px;">
		   <?php  
		     for( $z=0; $z < count($data_img); $z++){ 
		     if(file_exists(SITE_ROOT.'/assets/fineupload/server/files/'.$data_img[$z]['folder'].'/'.$data_img[$z]['image'])){
		   ?>
		    <li style="float:left;padding-left:5px;"><img src="<?php echo base_url(); ?>assets/fineupload/server/files/<?php echo $data_img[$z]['folder']; ?>/<?php echo $data_img[$z]['image']; ?>" width="50" height="50" /><br />
			<a onclick="return confirm('Are you sure you want to delete this image ?');" href="<?php echo site_url('vendors/remove_image/'.$data_img[$z]['id']); ?>">Remove</a>
			</li>
		   <?php }} ?> </ul> <?php } ?>
		</div>
	</div>
</div>
<?php } ?>


<div class="row">
  <div class="col-md-6">
  <a class="btn btn-primary  push-bottom" href="<?php echo site_url('business/back'); ?>">Cancel</a>

  <input type="submit" value="Next >>" style="float:right" id="next" class="btn btn-primary" data-loading-text="Loading...">

  </div>
</div>
<!--<div class="row">
	<div class="col-md-6">
		<p class="note">Note - Fields marked with asterik (*) are mandatory.</p>
	</div>
</div>-->
</form>

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
  
  var pp = '<?php if(isset($template)){echo $template;} ?>';
  if( pp > 0 ){
    document.getElementById('anu').style.display = "block";
	document.getElementById('a'+pp).style.display = "block";
	 document.getElementById('zz').value = pp;
  }
  $(document).ready(function() {
    $('#thumbnail-fine-uploader').fineUploader({
      template: "qq-simple-thumbnails-template",
      thumbnails: {
          placeholders: {
          }
      },
      request: {
        endpoint: '<?php echo base_url('assets/fineupload/server/endpoint.php');?>',
		 params: {
          param1: "<?php echo $token; ?>"
        }
      },
	  deleteFile: {
        enabled: true, // defaults to false
        endpoint: '<?php echo base_url('assets/fineupload/server/delete.php');?>',
		method:'POST'
    },
      validation: {
          allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
      }
    });
  });
</script>