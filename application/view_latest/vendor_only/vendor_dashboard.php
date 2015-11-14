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
			<div class="col-md-12">
					<?php $this->load->view('vendor_menu'); ?>	
			</div>
		</div>
			
<div class="row">
	<div class="col-md-12" style="padding-top:30px;text-align:left;" >
	   <ul style="list-style:none;padding:0;">
	    <li>
		<!--<h4 class="short">No Queries</h4>-->
		</li>
		<li><a href="<?php echo site_url('business/step1'); ?>"> <input type="button" value="Create One Now" class="btn btn-default push-bottom" data-loading-text="Loading..."></a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style="padding-top:150px;">
	&nbsp;
	</div>
</div>

				
			
					

<?$this->layout->block('currentPageJS')?>
<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script> -->
<!-- Current Page JS -->
<?$this->layout->block()?>