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
										<li class="active">History</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>History</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
		<!--<div class="row">
			<div class="col-md-12">
					<?php $this->load->view('components/flash_msg'); ?>	
			</div>
		</div>
		<div class="row">
		<div class="col-md-12" style="padding-bottom:10px;">
		   <?php $this->load->view('client_menu'); ?>
		</div>
		</div>-->
		<?php 
		  $ouy = $this->db->query('select * from user_earnings where user_id ='.$this->session->userdata('client_id').' order by id desc')->result_array();
		  $ouz = $this->db->query('select sum(amount) as amountz from user_earnings where user_id ='.$this->session->userdata('client_id'))->result_array();
		?>
		
		<div class="row">
		<div class="col-md-12">
			<h3>Total payments to date:&nbsp;<span style="width:auto !important;">$<?php echo number_format($ouz[0]['amountz'],2);  ?></span></h3>
		</div>
		
		</div>
		
		<div class="row">
		
			<div class="col-md-12">
			  <table class="table table-striped history">
					<tbody>	
								 <?php 
								     $i=1;
								     if( count($ouy) > 0  ){ 
								     foreach( $ouy as $row => $val ){
									
								 ?>	
									<tr>
											
											<td>
												<?php echo date('m/d/Y',strtotime($val['date']))." : &nbsp;"; ?><?php echo "<b class='queries'>".$val['survey']."</b>"; ?>&nbsp;&nbsp;&nbsp;<?php //echo '$ '.number_format($val['amount'],2); ?><br />
												
											</td>
											<td>
												<?php echo '$'.number_format($val['amount'],2); ?><br />
												
											</td>
									</tr>
								<?php $i++;}}else{ ?>		
								       
										<tr>
											<td>
												You haven't completed any queries
											</td>										
										</tr>						
								<?php } ?>
								</tbody>
							</table>
				
			</div>
		</div>
	</div>

<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<?$this->layout->block()?>