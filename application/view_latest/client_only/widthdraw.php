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
										<li class="active">Withdrawal</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Withdrawal</h2>
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
		   <?php $this->load->view('client_menu'); ?>
		</div>
		</div>
		
		
		<div class="row">
		                <div class="pricing-table">
							<div class="col-md-3 col-sm-6 ">
								<div class="plan most-popular">
									<h3>Total Withdrawal<span>$0.00</span></h3>
								</div>
							</div>
							
						</div>
						<div class="pricing-table">
							<div class="col-md-3 col-sm-6 ">
								<div class="plan ">
									<h3>available Balance<span>$0.00</span></h3>
								</div>
							</div>
							
						</div>
					</div>
					
					
	<div class="row" style="border-bottom:1px solid #DDD;margin-bottom:5px;">
		<div class="col-md-12" style="padding-bottom:10px;">
		  &nbsp;
		</div>
		</div>				
				<div class="row">
				
		<div class="col-md-12" style="padding-bottom:10px;">
		<br />
		   <h4>Withdrawal Request</h4>
		   <div class="row">
														<div class="form-group">
															<div class="col-md-4">
																<label>Amount</label>
																<input name="email" type="text" autocorrect="off" autocapitalize="none" value="" class="form-control input-lg">
															</div>
														</div>
													</div>
													<div class="row">
														
														<div class="col-md-4">
														You dont have enough account balance to mak a withwradal<input disabled="disabled" type="submit" value="Send Request" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
														</div>
													</div>
		</div>
		</div>			
					
		<div class="row" style="border-bottom:1px solid #DDD;margin-bottom:5px;">
		<div class="col-md-12" >
		  &nbsp;
		</div>
		</div>					
		
		<div class="row">
		
			<div class="col-md-12">
			  <br />
				<div class="tabs">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#active" data-toggle="tab">Withdrawal History</a>
						</li>
					
					</ul>
					<div class="tab-content">
						<div id="active" class="tab-pane active">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>
											Sl.No
										</th>
										<th>
											Survay Name
										</th>
										<th>
										   Requested date
										</th>
										<th>
										   Status
										</th>
										<th>
											Amount
										</th>
									</tr>
								</thead>
								<tbody>	
								 <?php 
								     if( count($data) > 0 && 1==2 ){ 
								     foreach($data as $row => $val ){
									 if($val['archived'] == 0 ){
								 ?>	
									
										<tr>
											<td>
												<?php echo $val['post_id']; ?>
											</td>
											<td>
												<?php echo $val['event_name']; ?>
											</td>
											<td>
												<?php echo @date('d/m/Y H:i',strtotime($val['submitted_date'])); ?>
											</td>
										</tr>
								<?php }}}else{ ?>							       
										<tr>
											<td colspan="3">
												You dont have any withdrawal
											</td>
											
										</tr>
								
								<?php } ?>
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>