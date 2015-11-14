<form method="post" action="<?php echo site_url('main/newPost/'.$id); ?>" >
<input type="hidden" name="act" value="post"  />
<div class="row">
	<div class="form-group">
	<div class="col-md-12">
			<label for="eventType">What type of event are you planning?</label>
			<select name="eventType"  id="eventType"  class="form-control input-lg " onchange="get_sub_types(this.value);">
			     <option value=""></option>
				 <?php 
				   if(count($main_event_type) > 0){ 
				   foreach($main_event_type as $row => $val){
				 ?>
<option  <?php if(isset($eventType) && $eventType == $val['me_id'] ){ ?>   selected="selected" <?php } ?> value="<?php echo $val['me_id']; ?>"><?php echo $val['me_name']; ?></option>
                 <?php }} ?>
			</select>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
	<div class="col-md-12">
			<label for="eventSubType">What are you planning?</label>
			<select name="eventSubType" id="eventSubType"  class="form-control input-lg ">
			     <option value=""></option>
				 <?php echo isset($options) ? $options :''; ?>
			</select>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
	<div class="col-md-12">
			<label for="category">What are you looking for?</label>
			<select name="category" id="category"  class="combobox form-control input-lg ">
			     <option value=""></option>
			     <?php 
				   if(count($vendor_cat) > 0){ 
				   foreach($vendor_cat as $row => $val){
				 ?>
			     <option <?php if(isset($category) && $category == $val['vc_id'] ){ ?> selected="selected" <?php } ?> value="<?php echo $val['vc_id']; ?>"><?php echo $val['vc_name']; ?></option>
                 <?php }} ?>
			</select>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
	<div class="col-md-12">
			<label for="delivery_dt">When the service/product need to be deliver?</label>
			<input maxlength="100" class="form-control input-lg" id="delivery_dt" name="delivery_dt" value="<?php echo isset($delivery_dt) ? $delivery_dt :''; ?>" data-date-format="DD/MM/YYYY HH:mm" data-date-minDate="<?php echo @date('d/m/Y'); ?>" type="text" ></input>

	</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
	<div class="col-md-12">
			<label for="description">Address of the service/product is delivering to.</label>
			<textarea  maxlength="5000" rows="4" class="form-control" name="address" id="address"><?php echo isset($address) ? $address :'';?></textarea>
	</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	<label>What is your approximate budget? </label>
	</div>
</div>
<div class="row">
	
	<div class="form-group">	
			<div class="col-md-5">
			<label for="budget">Budget per <a href="#" id="unit" data-type="text"  data-pk="1" data-url="" data-title="Example: pax, table, hour...ect"><?php echo isset($post_unit) ? $post_unit :'unit';?></a> (click to change.)</label>
			<input type="hidden" name="post_unit" id="post_unit" value="" />
			<input maxlength="100" class="form-control input-lg num" id="budget" value="<?php echo isset($budget) ? $budget :'';?>" onkeyup="show_total();"  name="budget" type="text" ></input>
			</div>
			<div class="col-md-3">
			<label for="quantity">Quantity</label>
			<input maxlength="100" class="form-control input-lg num" id="quantity" value="<?php echo isset($quantity) ? $quantity :'';?>"  onkeyup="show_total();"  name="quantity" type="text" ></input>
			</div>
			<div class="col-md-4">
			<label for="total">Total</label>
			<input maxlength="100" class="form-control input-lg" readonly id="total" value="<?php echo isset($total) ? $total :'';?>" name="total" type="text" ></input>
			</div>
	</div>
</div>
<?php  if( $this->session->userdata('clientAuth')){ ?>
<div class="row">
	<div class="form-group">
	<div class="col-md-12">
			<label for="contact">Contact Number</label>
			<input maxlength="100" class="form-control input-lg" id="contact_number" value="<?php echo $contact_no; ?>" name="contact_number" type="text" ></input>
	</div>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="form-group">
	<div class="col-md-12">
			<label for="contactTime">When do you prefer to be contacted?</label>
			<?php $cont = isset($contactTime) ? $contactTime :0; ?>
			<select name="contactTime"  class="form-control input-lg ">
			              <option  <?php if($cont ==0 ){ ?> selected="selected" <?php } ?> value="0">No Preperence</option>
			              <option <?php if($cont ==1 ){ ?> selected="selected" <?php } ?> value="1">Morning (9am - 12pm)</option>
			              <option <?php if($cont ==2 ){ ?> selected="selected" <?php } ?> value="2">Afternoon (12pm - 6pm)</option>
						  <option <?php if($cont ==3 ){ ?> selected="selected" <?php } ?> value="3">Evening (6pm - 9pm)</option>
			</select>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
	<div class="col-md-12">
			<label for="description">Please state additional requirements here.</label>
			<textarea  maxlength="5000" rows="4" class="form-control" name="description" id="description"><?php echo isset($description) ? $description : ''; ?></textarea>
	</div>
	</div>
</div>
<script type="text/javascript">
   function get_sub_types(a){
    var id = a;
	 if(a==''){
	    $('#eventSubType').html('<option value=""></option>');
	 }else{
		 $.ajax({
				type: "POST",
				url: "<?php echo site_url('main/ajaxSubEvents'); ?>",
				data: {id: id},
				success: function(data){
					$('#eventSubType').html(data);
				}
			});
     }


   }
   
   function show_total(){
      var qty =   parseFloat($('#quantity').val());
      var price = parseFloat($('#budget').val());
	  if(qty !="" && price !=""  ){
	    var t = qty*price;
		if( parseInt(t) > 0 ){
	       $('#total').val(t);
		}else{
		   $('#total').val('');
		}
	  }else{
	    $('#total').val('');
	  }
    
   }
</script>