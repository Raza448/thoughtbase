<!--<div class="col-md-3">
<ul style="list-style:none;padding:0px;">
<!--<li style="float:left;padding-right:16px;">

<a style="cursor:pointer;text-decoration:none;" href="<?php echo site_url('business/dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp;Home&nbsp;</a>
</li>
<li style="float:left;padding-right:6px;">

<a style="cursor:pointer;text-decoration:none;" href="<?php echo site_url('business/profile'); ?>"><i class="fa fa-user"></i>&nbsp;My Account&nbsp;</a>
</li>
</ul>
</div>-->
<div class="row">
	<div class="col-md-9">
	<?php if(isset($this->show) && $this->show == 1){ ?>
	<?php 
				//checking for survey's
				$rts = 'SELECT * FROM survey_temp WHERE user_id ='.$this->session->userdata('vendor_id').' and paid=1 order by id desc';
				$ret = $this->db->query($rts)->result_array();
			  if(count($ret) == 0 ){
			  ?>
			  <div class="form-group no_query drop" style="margin-bottom:0;">
				<select onChange="kkg(this.value)"  class="form-control input-lg">
				  <option value="0">No Queries</option>   
				  <option value="z">Create New Query</option>
				</select>  
			  </div>
			  <?php }else{ ?>
			  <div class="all_queries">
			  <div class="form-group drop">
				  <select onChange="kkg(this.value)"  class="form-control input-lg">
				  <?php foreach($ret as $pr => $pt ){ ?>
				  <option  <?php if($this->id == $pt['id'] ){ ?>  selected <?php } ?> value="<?php echo $pt['id']; ?>"><?php echo ucfirst($pt['name']); ?></option>
				  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('business/view_campaigns/'.$pt['id']); ?>"></a></li>
				  <?php } ?><option value="z">Create New Query</option></select>	
			 </div>
			 </div>
			  <?php } ?>
			   
		  <?php } ?>
	</div>
</div>


<script type="text/javascript">
function kkg(a){
  if(a == 'z'){
   location.href="<?php echo site_url('business/step1'); ?>";
  }else if(a == 0){
  }else{
    location.href="<?php echo site_url('business/view_campaigns'); ?>/"+a;
  }
  }
</script>


