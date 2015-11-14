<?$this->layout->block('currentPageCss')?>
<link rel="stylesheet"  href="<?=base_url('assets/js/validator/bvalidator.css') ?>">
<script src="<?=base_url('assets/js/validator/jquery.bvalidator.js') ?>"></script>
<style>
.col-md-6 {
    width: 80%;
	float:none;
	margin:0 auto;
  }
  
.question ul { display:none;
}
.question label {
display:none;
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
  <?php if( count($single) > 0 ){ ?>

	<div class="col-md-3" style="border-right: 1px solid #EDEDDE;">


	<aside class="sidebar">





								<h4>My Queries</h4>


								<ul class="nav nav-list primary push-bottom">
                                   <?php 
								     if(count($data) > 0 ){ 
								     foreach($data as $row => $val ){
								   ?>

									<li><a href="<?php echo site_url('user/myQueries/'.$val['id']);?>"><?php echo $val['name']; ?><br />

										<?php echo $val['created_on']; ?></a>

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
			 			<div class="col-md-9">

			<!--- ---->

		    <div class="row">
			  <div class="col-md-6 center">
				<h2 class="shorter"><?php echo $single[0]['name']; ?></h2> <?php echo $single[0]['description']; ?>
			   </div>	
            <?php 
               //checking for image exists in campaign
			   $query = "select * from survey_images where survey =".$single[0]['id'];
			   $bout = $this->db->query($query)->result_array();
			   if( count($bout) > 0 ){
			?>            
			<div class="col-md-6">
							<div class="owl-carousel" data-plugin-options='{"items": 1, "autoHeight": true, "autoPlay": true, "navigation": true}'>
							
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
  <div class="col-md-6 " style="height:auto;padding-top:40px;" >
     <form method="post" action="" id="ans" >
	 <input type="hidden" name="sid" value="<?php echo $single[0]['id']; ?>" />
	 <input type="hidden" name="temp" value="<?php echo $single[0]['template']; ?>" />
	 <input type="hidden" name="sname" value="<?php echo $single[0]['name']; ?>" />
	 <input type="hidden" name="amount" value="<?php echo $single[0]['user_amount']; ?>" />
      <?php if( $single[0]['template'] == 4 ){ ?>
        <label class="ques_1"><?php echo $single[0]['question']; ?></label><br />
	     <ul class="ques_1" style="list-style:none;padding:0px;padding-top:5px;">
	       <li><textarea  data-bvalidator-msg="required"  data-bvalidator="required" class="form-control input-lg" name="single_question" required ></textarea></li>
	     </ul>
	    <button type="submit" class="btn btn-primary submit" id="submit">Submit</button>
	     <br />
		 <br />
	  
	  
	  <?php }else{ ?>
	     <ul style="padding:0px; list-style:none;" >
			   <li>
			    1) Have you used this product / service before ?
			   </li>
			   <li>
			      <ul style="list-style-type:none;padding:10px;">
                      <li><input name="type" onClick="pp(this.value);" type="radio" value="2">Yes</li>
			          <li><input name="type" onClick="pp(this.value);" type="radio" value="1">No</li>
				 </ul>
			  </li>
		 </ul>
		  <?php	
	    $i=2;
		$bp =1;
	    $qcqt = '';
	    $result1 = $this->db->query('select * from survey_questions where survey_id ='.$single[0]['template'].' order by question_cat')->result_array();
		foreach($result1 as $rowz => $valz ){ 
            
			$temp = $valz['question_cat'];
			if($qcqt != $temp){
               $bp = 1;
			   $qcqt = $temp;
			}
			if($i == 7){
			 $i =2;
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
					<li><input <?php if($z==1){ ?>data-bvalidator-msg="required" data-bvalidator="required" <?php } ?> type="radio" class="s<?php echo $bp; ?>" name="<?php echo $valz['id']; ?>" value="<?php echo $q['id']; ?>" ><?php echo $q['answer']; ?></li>
				    <?php $z++;} ?>
			       <?php }else if($valz['question'] == 2){ //textbox ?>
				   
				    
					   <li><input name="question" type="text"  value="" ></li>
				  
				   
			   
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
					<li><input type="checkbox" name="<?php echo $valz['id']; ?>" value="<?php echo $q['id']; ?>" ><?php echo $q['answer']; ?></li>
				    <?php } ?>
				   <?php }else{  ?>
					  <textarea  data-bvalidator="required" data-bvalidator-msg="required "  class="form-control input-sl  s<?php echo $bp; ?>" name="<?php echo $valz['id']; ?>" ></textarea>
				   <?php } ?>
				 </ul>
			   </li> 
			</ul>
		 
	  <?php $i++;$bp++;} ?>
	   <button type="submit" style="display:none;" class="btn btn-primary submit kki" id="submit">Submit</button>
	   <div style="height:30px;"></div>
	  <?php } ?>

      </form>

			</div>
</div>
	</div>
		  <!--- ---->
			<?php }else{	?>
			
			  <div class="col-md-12 " style="height:400px;line-height:400px; font-size:22px;" align="center" >
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
	 $('.a2').show();
   }else{
     $('.a2').hide();
	 $('.a1').show();
   }   
 }
</script>

<script type="text/javascript">
  $(document).ready(function () {
    var bValidatorOptions = {
        showCloseIcon: false
    };
    $('#ans').bValidator(bValidatorOptions);
  });
</script>


<?$this->layout->block('currentPageJS')?>


<!-- Current Page JS -->


<?$this->layout->block()?>