<style>
.col-xs-6 {
    width: 100%;
}
</style>
<?$this->layout->block('breadcrumbs')?>

<?$this->layout->block()?>
   
     <!--PAGE CONTENT START-->
        

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                    <!-- Main row -->
                    <div class="row">
							<div class="col-md-12">
              <!-- MAP & BOX PANE -->
              
          <div class="row">
			
			<div class="col-md-6">
                  <!-- USERS LIST -->
                  <div class="box box-info">
					  <form action="" method="get">
						<div class="box-header with-border">
						  <h3 class="box-title">User Accounts</h3>
						  <div class="box-tools pull-right">
						  <?php $user_date = ''; ?>
						  <?php if(isset($_GET['user_date'])){
							  $user_date = $_GET['user_date'];
						  } ?>
							 <select class="form-control" name="user_date" onchange="this.form.submit()" style="padding:5px;">
								<option value="<?php echo $all.'/1' ;?>" <?php echo (($user_date == $all.'/1')?'selected':'') ?>selected>All</option>
								<option value="<?php echo $last_day.'/2' ;?>" <?php echo (($user_date == $last_day.'/2')?'selected':'') ?>>Last 24 hours</option>
								<option value="<?php echo $week.'/3' ;?>" <?php echo (($user_date == $week.'/3')?'selected':'') ?>>This Week</option>
								<option value="<?php echo $month.'/4' ;?>" <?php echo (($user_date == $month.'/4')?'selected':'') ?>>This Month</option>
								<option value="<?php echo $last_three.'/5' ;?>" <?php echo (($user_date == $last_three.'/5')?'selected':'') ?>>Last 3 Months</option>
								<option value="<?php echo $year.'/6' ;?>" <?php echo (($user_date == $year.'/6')?'selected':'') ?>>This Year</option>
							  </select>
						  </div>
						</div><!-- /.box-header -->
						<div class="box-body">
						 <div class="table-responsive">
						<table id="example1" class="table no-margin">
						  <thead>
							<tr>
							  <th style="width:80px">User ID</th>
							  <th>Email</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php if(isset($users)){ foreach($users as $user_data) { ?> 
							<tr>
							  <td><?php echo $user_data['id']; ?></td>
							  <td><?php echo $user_data['email']; ?></td>
							</tr>
							<?php } }else{ ?>
							<tr>
							<td colspan="2">No records</td>
							</tr>
							<?php } ?>
						  </tbody>
						 <tfoot>
							<tr>
							  <td colspan="2"><strong>Total Users : <?php echo count($users) ?></strong></td>
							</tr>
						 </tfoot>
						</table>
					  </div><!-- /.table-responsive -->
						</div>
					</form>
                  </div><!--/.box -->
                </div><!-- /.col -->
				
			<div class="col-md-6">
                  <!-- USERS LIST -->
                  <div class="box box-info">
				   <form action="" method="get">
                    <div class="box-header with-border">
                      <h3 class="box-title">Business Accounts</h3>
                      <div class="box-tools pull-right">
						 <?php $business_date = ''; ?>
						  <?php if(isset($_GET['business_date'])){
							  $business_date = $_GET['business_date'];
						  } ?>
							 <select class="form-control" name="business_date" onchange="this.form.submit()" style="padding:5px;">
								<option value="<?php echo $all.'/1' ;?>" <?php echo (($business_date == $all.'/1')?'selected':'') ?>selected>All</option>
								<option value="<?php echo $last_day.'/2' ;?>" <?php echo (($business_date == $last_day.'/2')?'selected':'') ?>>Last 24 hours</option>
								<option value="<?php echo $week.'/3' ;?>" <?php echo (($business_date == $week.'/3')?'selected':'') ?>>This Week</option>
								<option value="<?php echo $month.'/4' ;?>" <?php echo (($business_date == $month.'/4')?'selected':'') ?>>This Month</option>
								<option value="<?php echo $last_three.'/5' ;?>" <?php echo (($business_date == $last_three.'/5')?'selected':'') ?>>Last 3 Months</option>
								<option value="<?php echo $year.'/6' ;?>" <?php echo (($business_date == $year.'/6')?'selected':'') ?>>This Year</option>
							  </select>
						  </div>
                      </div>
                    <div class="box-body">
					 <div class="table-responsive">
                    <table id="example2" class="table no-margin">
                      <thead>
                        <tr>
                          <th>Business ID</th>
                          <th>Business Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($business)){ foreach($business as $business_data) { ?> 
                        <tr>
                          <td><?php echo $business_data['id']; ?></td>
                          <td><?php echo $business_data['email']; ?></td>
						</tr>
						<?php } }else{ ?>
						<tr>
						<td colspan="2">No records</td>
						</tr>
						<?php } ?>
                      </tbody>
					  <tfoot>
						<tr>
						  <td colspan="2"><strong>Total Business : <?php echo count($business) ?></strong></td>
						</tr>
					 </tfoot>
                    </table>
                  </div><!-- /.table-responsive -->
					</div>
				</form>
                  </div><!--/.box -->
                </div><!-- /.col -->

              <!-- TABLE: LATEST ORDERS -->
			<div class="col-md-12">
              <div class="box box-info">
			   <form action="" method="get">
                <div class="box-header with-border">
                  <h3 class="box-title">Queries Created</h3>
                  <div class="box-tools pull-right">
					<?php $query_date = ''; ?>
						  <?php if(isset($_GET['query_date'])){
							  $query_date = $_GET['query_date'];
						  } ?>
							 <select class="form-control" name="query_date" onchange="this.form.submit()" style="padding:5px;">
								<option value="<?php echo $all.'/1' ;?>" <?php echo (($query_date == $all.'/1')?'selected':'') ?>selected>All</option>
								<option value="<?php echo $last_day.'/2' ;?>" <?php echo (($query_date == $last_day.'/2')?'selected':'') ?>>Last 24 hours</option>
								<option value="<?php echo $week.'/3' ;?>" <?php echo (($query_date == $week.'/3')?'selected':'') ?>>This Week</option>
								<option value="<?php echo $month.'/4' ;?>" <?php echo (($query_date == $month.'/4')?'selected':'') ?>>This Month</option>
								<option value="<?php echo $last_three.'/5' ;?>" <?php echo (($query_date == $last_three.'/5')?'selected':'') ?>>Last 3 Months</option>
								<option value="<?php echo $year.'/6' ;?>" <?php echo (($query_date == $year.'/6')?'selected':'') ?>>This Year</option>
							  </select>
                   </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example3" class="table no-margin">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Business Name</th>
                          <th>No. of Users</th>
                          <th>Query Template</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php if(isset($filter_data)){ foreach($filter_data as $query) { ?> 
                        <tr>
                          <td style="width:45%;"><?php echo $query['q_name'] ?></td>
                          <td><?php echo $query['b_name'] ?></td>
						  <td><?php $a = explode(',', $query['user_id']);
								echo count($a); ?></td>
                          <td><?php echo $query['s_name'] ?></td>
                        </tr>
						<?php } } ?>
                      </tbody>
					  <tfoot>
						<tr>
						  <td colspan="2"><strong>Total Queries Created : <?php echo count($filter_data) ?></strong></td>
						</tr>
					 </tfoot>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
			 </div>
			 <div class="col-md-12">
              <div class="box box-info">
			   <form action="" method="get">
                <div class="box-header with-border">
                  <h3 class="box-title">Queries Submitted</h3>
                  <div class="box-tools pull-right">
					 <?php $submit_date = ''; ?>
						  <?php if(isset($_GET['submit_date'])){
							  $submit_date = $_GET['submit_date'];
						  } ?>
							 <select class="form-control" name="submit_date" onchange="this.form.submit()" style="padding:5px;">
								<option value="<?php echo $all.'/1' ;?>" <?php echo (($submit_date == $all.'/1')?'selected':'') ?>selected>All</option>
								<option value="<?php echo $last_day.'/2' ;?>" <?php echo (($submit_date == $last_day.'/2')?'selected':'') ?>>Last 24 hours</option>
								<option value="<?php echo $week.'/3' ;?>" <?php echo (($submit_date == $week.'/3')?'selected':'') ?>>This Week</option>
								<option value="<?php echo $month.'/4' ;?>" <?php echo (($submit_date == $month.'/4')?'selected':'') ?>>This Month</option>
								<option value="<?php echo $last_three.'/5' ;?>" <?php echo (($submit_date == $last_three.'/5')?'selected':'') ?>>Last 3 Months</option>
								<option value="<?php echo $year.'/6' ;?>" <?php echo (($submit_date == $year.'/6')?'selected':'') ?>>This Year</option>
							  </select>
                   </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example4" class="table no-margin">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Business Name</th>
                          <th>Submitted by Users</th>
                          <th>Query Template</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($submit_data)){ foreach($submit_data as $submit) { ?> 
                        <tr>
                          <td><?php echo $submit['q_name'] ?></td>
                          <td><?php echo $submit['b_name'] ?></td>
                          <td style="width:45%;"><?php echo $submit['user_email'] ?></td>
						  <!--<td><?php $a = explode(',', $query['user_id']);
								echo count($a); ?></td>-->
                          <td><?php echo $submit['s_name'] ?></td>
                        </tr>
						<?php } } ?>
                      </tbody>
					  <tfoot>
						<tr>
						  <td colspan="2"><strong>Total Queries Submitted : <?php echo count($submit_data) ?></strong></td>
						</tr>
					 </tfoot>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
			 </div>
            </div>
			</div>

                            <!-- Custom tabs (Charts with tabs)-->
                           <!-- <div class="nav-tabs-custom" style="height:300px;padding:20px;">
								<h1>Welcome Admin</h1>
                             </div>-->
                        
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        
       <!--PAGE CONTENT END-->

<?$this->layout->block('currentPageJS')?>

<script src="<?=base_url('assets/admin/js/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('assets/admin/js/plugins/datatables/jquery.dataTables.columnFilter.js') ?>"></script>
<script src="<?=base_url('assets/admin/js/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?=base_url('assets/admin/js/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
	$(function() {
		var dataTable = $('#example1').dataTable({
		//sPaginationType: "full_numbers"
		"aaSorting": [],
		"bFilter": false,
		"bInfo": false,
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
		});
		var dataTable = $('#example2').dataTable({
		//sPaginationType: "full_numbers"
		"aaSorting": [],
		"bFilter": false,
		"bInfo": false,
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
		});
		var dataTable = $('#example3').dataTable({
		//sPaginationType: "full_numbers"
		"aaSorting": [],
		"bFilter": false,
		"bInfo": false,
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
		});
		var dataTable = $('#example4').dataTable({
		//sPaginationType: "full_numbers"
		"aaSorting": [],
		"bFilter": false,
		"bInfo": false,
		"iDisplayLength": 5,
		"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
		});
		dataTable.columnFilter({
	  sPlaceHolder: "head:before",
	  aoColumns: [
		  { type: "select" },  
		  { type: "select" },        
		  { type: "select" },  
		  { type: "select" },  
		  { type: "select" },  
		  { type: "select" }
	  ]
	});
});
        
</script>
<?$this->layout->block()?>