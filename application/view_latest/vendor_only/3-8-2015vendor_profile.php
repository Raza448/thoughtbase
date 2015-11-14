<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
   <link rel="stylesheet" href="<?=base_url('assets/vendor/combobox/bootstrap-combobox.css') ?>">
   <link rel="stylesheet" href="<?=base_url('assets/vendor/xeditable/editable/css/bootstrap-editable.css') ?>">
   <link rel="stylesheet" href="<?=base_url('assets/vendor/xeditable/inputs-ext/select2-bootstrap.css') ?>">
   <link href="<?=base_url('assets/vendor/xeditable/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css') ?>" rel="stylesheet">
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
	<section class="page-top">
			<div class="container">
							<div class="row">
								<div class="col-md-12">
									<ul class="breadcrumb">
										<li><a href="<?=site_url('business/dashboard') ?>">Vendor</a></li>
										<li class="active">Profile</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Edit Profile</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
					<h2></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
					<?php $this->load->view('components/flash_msg'); ?>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
		<table class="table table-striped">
			<tbody>
			    <tr>
					<td>
						Logo:
					</td>
					<td>
					<form method="post" action="<?php echo site_url('vendors/logoupload'); ?>" enctype="multipart/form-data">
					  <input type="hidden" name="act" value="logo" />
					   <input type="hidden" name="pre_logo" value="<?php echo isset($profile['logo']) ? $profile['logo']:''; ?>" />
					  <?php if(isset($profile['logo']) && $profile['logo']!=""){ ?>
					  <img class="img-thumbnail img-responsive" style="margin-bottom:3px;" src="<?php echo base_url(); ?>assets/thim/timthumb.php?src=<?php echo base_url(); ?>uploads/vendor/<?php echo $profile['logo'];  ?>&w=50&zc=1" />
					  <?php } ?>
					  <br />
					  <input type="file" name="logo" style="float:left;" />&nbsp;
					  <button type="submit" class="btn btn-primary btn-sm" style="float:left;" >Upload</button>
					</form>
					</td>
				</tr>
				<tr>
					<td>
					<form method="post" action="<?php echo site_url('vendors/updatepro'); ?>" />
						Vendor Description:
					</td>
					<td>
						<textarea autocorrect="off" autocapitalize="none" maxlength="5000" rows="4" class="form-control" name="description" id="description"><?php echo isset($profile['description'])?$profile['description']:''; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Website:
					</td>
					<td>
						<input name="website" type="website" value="<?php echo isset($profile['website'])?$profile['website']:''; ?>" required="" class="form-control input-lg">
					</td>
				</tr>
					<tr>
						<td>
							Address:
						</td>
						<td>
						<textarea autocorrect="off" autocapitalize="none" maxlength="5000" rows="4" class="form-control" name="address" id="address"><?php echo isset($profile['description'])?$profile['description']:''; ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							Vendor Category Type*:
						</td>
						<td>
						  <?php 
						    $this->load->database();
							$out = $this->db->query('select vendor_cat_list.*,vendor_categories.* from vendor_cat_list 
							 left join vendor_categories on vc_id = category_id
							 where vendor_id='.$this->session->userdata('vendor_id')." LIMIT 0,1");
						    $res = $out->result_array();
							$cif = '';
							$par  = '';
							if( isset($res[0]['category_id']) && $res[0]['category_id'] > 0 ){
							  $cif = $res[0]['category_id'];
							  $par = $res[0]['vc_parent'];
							}
							
						  ?>
							<select onchange="get_sub_types(this.value);" name="catType" id="catType"  class="form-control input-lg ">
			                   <option value=""></option>
				               <?php if( count($ctype)> 0){ foreach($ctype as $row => $val){ ?>
							    <option value="<?php echo $val['cat_id']; ?>" <?php if($val['cat_id']==$par){ ?>  selected <?php } ?> ><?php echo $val['cat_name']; ?></option>
							   <?php }} ?>
			                 </select>
						</td>
					</tr>
					<tr>
						<td>
							Vendor Category*:
						</td>
						<td>			  
						  <select name="cat[]" id="cat" multiple  class="form-control input-lg ">
			                   <option value=""></option>
				          </select>
						</td>
					</tr>
					<tr>
					<td>
						
					</td>
					<td>
						<button type="submit" class="btn btn-primary btn-sm">Update</button>
						</form>
					</td>
				</tr>
				 <tr>
					<td>
						Image Gallery:
					</td>
					<td>
					<form method="post" action="<?php echo site_url('vendors/glogoupload'); ?>" enctype="multipart/form-data">
					  <input type="hidden" name="act" value="logo" />
					   <br />
					  <input type="file" name="logo[]" multiple style="float:left;" />&nbsp;
					  <button type="submit"  class="btn btn-primary btn-sm" style="float:left;" >Upload</button>
					</form>
					</td>
				</tr>
				 <tr>
					<td colspan="2">
					<ul style="list-style:none;">
					<?php
					$out_img = $this->db->query('select image,id  from vendor_photos where vendor_id='.$this->session->userdata('vendor_id'));
						$res_img = $out_img->result_array();
					    if( count($res_img) > 0 ){
						foreach($res_img as $img_row => $val_img ){
					?>
					<li style="padding-bottom:5px;float:left;">
					 <img class="img-thumbnail img-responsive" src="<?php echo base_url(); ?>assets/thim/timthumb.php?src=<?php echo base_url(); ?>uploads/vendor/<?php echo $val_img['image'];  ?>&w=100&h=58&zc=1" />
					<br />
					<a onclick="return confirm('Are you sure you want to delete this image?')" href="<?php echo site_url('vendors/delimg/'.$val_img['id']); ?>"><span class="label label-danger">Remove</span></a>
					</li>
					<?php }} ?>
					</ul>
					</td>
				</tr>
				
			</tbody>
		</table>
			</div>
		</div>
		</div>
	</div>
<script type="text/javascript">
   function get_sub_types(a){
    var id = a;
	 if(a==''){
	    $('#cat').html('<option value=""></option>');
	 }else{
		 $.ajax({
				type: "POST",
				url: "<?php echo site_url('vendors/ajaxSubcat'); ?>",
				data: {id: id},
				success: function(data){
					$('#cat').html(data);
				}
			});
     }
  }

 </script>
 
   <?php if($par !="" ){ ?>
    <script type="text/javascript">
	window.onload = function() {
   get_sub_types('<?php echo $par; ?>');
};
      
	</script>
  <?php } ?>
  
<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>