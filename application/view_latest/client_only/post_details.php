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
										<li><a href="<?=site_url() ?>">Home</a></li>
										<li><a href="<?=site_url('main/myPosts') ?>">My Posts</a></li>
										<li class="active">Post Details</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Post Details</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
					<h2>Post: <?php echo $post_id; ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
					<?php $this->load->view('components/flash_msg'); ?>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
		<table class="table table-striped">
			<tbody>
				<tr>
					<td>
						Posted Date:
					</td>
					<td>
						<?php echo @date('d/m/Y H:i',strtotime($submitted_date)); ?>
					</td>
				</tr>
				<tr>
					<td>
						Expire Date:
					</td>
					<td>
						<?php echo @date('d/m/Y H:i',strtotime('+20 days',strtotime($submitted_date))); ?>
					</td>
				</tr>
					<tr>
						<td>
							Event Type:
						</td>
						<td>
							<?php echo $mainEventType; ?>
						</td>
					</tr>
					<tr>
						<td>
							Event:
						</td>
						<td>
							<?php echo $event_name; ?>
						</td>
					</tr>
					<tr>
						<td>
							Required Service/Product:
						</td>
						<td>
							<?php echo $vendorCatType; ?>
						</td>
					</tr>
					<tr>
						<td>
							Required Delivery Date Time:
						</td>
						<td>
							<?php echo $date; ?>
						</td>
					</tr>
					<tr>
						<td>
							Required Delivery Address:
						</td>
						<td>
							<?php echo $address; ?>
						</td>
					</tr>
				<tr>
					<td>
						Budget:
					</td>
					<td>
						Quantity: <?php echo $unit; ?>&nbsp;|&nbsp; 
						<?php echo $budget; ?> SGD per <?php echo $post_unit; ?>&nbsp; 
						&nbsp;|&nbsp;
						Total: <?php echo $budget*$unit; ?> SGD.
					</td>
				</tr>
				<tr>
					<td>
						Mobile Number:
					</td>
					<td>
						<?php echo $contact_number; ?>
					</td>
				</tr>
				<tr>
					<td>
						Prefered Contact Period:
					</td>
					<td>
						  <?php if($contact ==0 ){ echo "No Preperence" ;} ?>
			              <?php if($contact ==1 ){ echo "Morning (9am - 12pm)";}?>
			              <?php if($contact ==2 ){ echo "Afternoon (12pm - 6pm)";} ?>
				          <?php if($contact ==3 ){ echo "Evening (6pm - 9pm)";} ?>
					</td>
				</tr>
				<tr>
					<td>
						Additional Requirements:
					</td>
					<td>
						<?php echo $addi_req; ?>
					</td>
				</tr>
				<tr>
					<td>
						Assisted Service:
					</td>
					<td>
						<button type="button" class="btn btn-primary btn-sm">Get Assist Now!</button>
					</td>
				</tr>
				
			</tbody>
		</table>
			</div>
			<?php 
			 if($this->session->userdata('vendorAuth')){
		     //checking vendor already bidded
			 $vid = $this->session->userdata('vendor_id');
			 $query = "select id from bid where vendor_id =".$vid." and post_id = ".$post_id;
			 $zout = $this->db->query($query);
			 $tempz = $zout->result_array();
			 if(count($tempz) == 0 ){
			
			?>
			
			<div class="col-md-4">
			<form method="post" action="<?php echo site_url('clients/postBid/'.$post_id); ?>"  >
				<table class="table table-bordered">
					<thead>
						<tr>
							<td colspan="2">
								Bid
							</td>
						</tr>
					</thead>
					<tbody>
				        <tr>
							<td colspan="2">Paid to you<br />
								<input type="text" autocorrect="off" autocapitalize="none" id="kbid" class="form-control numkk" name="bid" style="outline:0">&nbsp;SGD
							</td>
						</tr>
						 <tr>
							<td colspan="2">Message<br />
								<textarea autocorrect="off" autocapitalize="none" class="form-control" name="comment" style="width:100%" ></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<button type="submit"  class="btn btn-primary btn-sm">Place Bid</button>
							</td>
						</tr>
						
					</tbody>
				</table>
				</form>
			</div>
				  <?php 
					  }}
					  ?>
			<div class="col-md-4">
				<table class="table table-bordered">
					<thead>
						<tr>
							<td colspan="2">
								Shortlisted vendors
							</td>
						</tr>
					</thead>
					<tbody>
					  <?php 
					  if(count($bids) > 0 ){ 
					  foreach($bids as $row => $val){
					  if($val['shortlisted'] == 1){
					  ?>
						<tr>
							<td>
								<?php echo $val['name']; ?>
							</td>
							<td>
							<a href="<?php echo site_url('clients/vendorProfile/'.$val['user_id'].'/'.$post_id);?>"><button type="button" class="btn btn-primary btn-sm">View</button></a>
							</td>
						</tr>
						<?php }}}else{ ?>
						 <tr>
							<td colspan="2">
								No vendor yet
							</td>
						</tr>
						
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		
		
		
		
		
		
			<div class="row">
						<div class="col-md-12">
							<div class="tabs tabs-product">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#productDescription" data-toggle="tab">Bids</a></li>
									</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="productDescription">
										<ul class="comments">
										  <?php 
										    if(count($bids) > 0 ){ 
					                        foreach($bids as $row => $val){
										  ?>
											<li style="padding-left:0px;">
												<div class="comment">
													<div class="comment-block">
														<div class="comment-arrow"></div>
														<span class="comment-by">
															<strong><?php echo $val['name']; ?></strong>
														</span>
														<p><strong>Bid:&nbsp;<?php echo $val['quotation']; ?>&nbsp;SGD </strong></p>
														<p><?php echo $val['comment']; ?></p>
														<p style="text-align:right;">
														<a href="<?php echo site_url('clients/vendorProfile/'.$val['vendor_id'].'/'.$val['post_id']);?>" class="btn btn-primary btn-icon"><i class="icon icon-external-link"></i>View</a>
														<?php if($val['shortlisted'] == 1){ ?>
														<a href="javascript:void();" class="btn   btn-info"><i class="icon icon-external-link"></i>Shortlisted</a> 
														<?php }else{ ?>
														<a href="<?php echo site_url('clients/shortlist/'.$val['post_id']."/".$val['vendor_id']); ?>" class="btn btn-primary btn-icon"><i class="icon icon-external-link"></i>Shortlist</a> 
														<?php } ?>
														</p>
													</div>
												</div>
											</li>
											<?php }} ?>
										</ul>
									</div>				
								</div>
							</div>
						</div>
					</div>
		
		</div>
	</div>
<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
		<script src="<?=base_url('assets/vendor/datetimepicker/js/moment.js') ?>"></script>
		<script src="<?=base_url('assets/vendor/xeditable/editable/js/bootstrap-editable.js') ?>"></script>
		<script src="<?=base_url('assets/vendor/xeditable/inputs-ext/typeaheadjs/lib/typeahead.js') ?>"></script>
		<script src="<?=base_url('assets/vendor/xeditable/inputs-ext/typeaheadjs/typeaheadjs.js') ?>"></script>
		<script src="<?=base_url('assets/js/views/view.postDetails.js') ?>"></script>
<?$this->layout->block()?>