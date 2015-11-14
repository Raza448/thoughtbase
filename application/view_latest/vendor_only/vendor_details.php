<?$this->layout->block('currentPageCss')?>

<!--define current page css-->
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
	<section class="page-top">
			<div class="container">
							<div class="row">
								<div class="col-md-12">
									<ul class="breadcrumb">
										<li><a href="<?=site_url() ?>">Vendor</a></li>
										<li class="active">Profile</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Profile</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>

				<div class="container">
					<div class="portfolio-title">
						<div class="row">
							<div class=" col-md-3 right">
							<?php if(isset($logo) && $logo !=""  ){ ?>
							<img class="img-thumbnail img-responsive" style="max-width:200px;" src="<?php echo base_url(); ?>assets/thim/timthumb.php?src=<?php echo base_url(); ?>uploads/vendor/<?php echo $logo;  ?>&zc=1">
							<?php } ?>			
							</div>
							<div class="col-md-6 center">
								<h2 class="shorter"><?php echo $company_name; ?></h2>
							</div>							
						</div>
					</div>
					<hr class="tall">
					<div class="row">
				
						<div class="col-md-6">
							<div class="owl-carousel" data-plugin-options='{"items": 1, "autoHeight": true, "autoPlay": true, "navigation": true}'>
							<?php 
								  if(count($gal) > 0 ){ 
								  foreach($gal as $row => $val ){
								  if($val['image']!=""){
								  
								?>
								<div>
									<div class="thumbnail">
										<img alt="" class="img-responsive img-rounded" src="<?php echo base_url(); ?>uploads/vendor/<?php echo $val['image'];  ?>">
									</div>
								</div>
								<?php }}} ?>
								
							</div>
						<br>
						</div>
                     
						<div class="col-md-6">

							<div class="portfolio-info">
								<div class="row">
									<div class="col-md-12 center">
										<ul>
											<li >
												<a href="#" rel="tooltip" data-original-title="Like"><i class="icon icon-heart"></i>14</a>
											</li>
											<li>
												<i class="icon icon-calendar"></i> <?php echo vendor_reg($user_id); ?>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<h4>Vendor <strong>Description</strong></h4>
							<p class="taller">
							<input type="hidden" id="vendor-id" value="<?php echo $user_id; ?>" />
							<?php echo $description; ?>
							</p>

							
							<?php 
							 
							 if(isset($this->pid) && $this->pid > 0 ){ 
							 $owner = getOwner($this->pid);
							 if($this->session->userdata('client_id') && $this->session->userdata('client_id') == $owner  ){
							?>
							<a href="<?php echo site_url('clients/shortlist/'.$this->pid."/".$user_id); ?>" class="btn btn-primary btn-icon"><i class="icon icon-external-link"></i>Shortlist</a> <span class="arrow hlb" data-appear-animation="rotateInUpLeft" data-appear-animation-delay="800"></span>
                            <?php 
							  }}
							?>
							<ul class="portfolio-details">
								<li>
									<p><strong>Catergories:</strong></p>
									<ul class="list list-skills icons list-unstyled list-inline">
										<?php 
										 if(count($cat)>0){ 
										 foreach($cat as $fow => $val){
										?>
										<li><i class="icon icon-check-circle"></i> <?php echo vendor_cname($val['category_id']); ?></li>
										<?php }} ?>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="tabs tabs-product">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#productDescription" data-toggle="tab">Description</a></li>
									<li><a href="#productInfo" data-toggle="tab">Contact Information</a></li>
									<li><a href="#productReviews" data-toggle="tab">Recomandations (<?php echo count($review); ?>)</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="productDescription">
										<p><?php echo $description; ?></p>
									</div>
									<div class="tab-pane" id="productInfo">
										<table class="table table-striped push-top">
											<tbody>
												<tr>
													<th>
														Size:
													</th>
													<td>
														Unique
													</td>
												</tr>
												<tr>
													<th>
														Colors
													</th>
													<td>
														Red, Blue
													</td>
												</tr>
												<tr>
													<th>
														Material
													</th>
													<td>
														100% Leather
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="tab-pane" id="productReviews">
										<ul class="comments">
										  <?php 
										    if(count($review) > 0 ){
                                            foreach($review as $er => $val ){
										  ?>
											<li style="padding-left:0px;">
												<div class="comment">
													<div class="comment-block">
														<div class="comment-arrow"></div>
														<span class="comment-by">
															<strong><?php echo $val['name']; ?></strong>
														</span>
														<p><?php echo $val['review']; ?></p>
													</div>
												</div>
											</li>
											<?php }} ?>
										</ul>
	<?php
$name ='';
$email ='';

if($this->session->userdata('client_id')){
 $out_client = get_det_cli($this->session->userdata('client_id'));
 if( count($out_client) > 0 && isset($out_client[0]['contact_name'])  ){
   $name =$out_client[0]['contact_name'];
   $email =$out_client[0]['email'];
 }


?>									
										<hr class="tall">
										<h4>Add a review</h4>
										<div class="row">
											<div class="col-md-12">

												<form action="" id="submitReview" type="post">
													<div class="row">
														<div class="form-group">
															<div class="col-md-6">
																<label>Your name *</label>
																<input readonly type="text" autocorrect="off" autocapitalize="none" value="<?php echo $name; ?>" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name">
															</div>
															<div class="col-md-6">
																<label>Your email address *</label>
																<input readonly type="email" autocorrect="off" autocapitalize="none" value="<?php echo $email; ?>" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Review *</label>
																<textarea autocorrect="off" autocapitalize="none" maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message"></textarea>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<input type="button" onclick="post_comment();" value="Submit Review" class="btn btn-primary" data-loading-text="Loading...">
														</div>
													</div>
												</form>
									
											</div>

										</div>
										<?php } ?>
									</div>
									
									
								</div>
							</div>
						</div>
					</div>

					

				</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>