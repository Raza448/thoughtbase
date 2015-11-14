<?$this->layout->block('breadcrumbs')?>

<?$this->layout->block()?>
   
     <!--PAGE CONTENT-->
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                   
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Templates</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                    <!-- Main row -->
                    <div class="row">
                       <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Templates</h3>
									<div class="new_temp">
										<a class="btn btn-success" href="edit_template"><i class="fa fa-edit"></i> Add Template</a>
									</div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Modify</th>
                                                <th>Enable/Disable</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php
										if(isset($templates))
										{
										
											foreach($templates as $row)
											{
										?>
                                            <tr>
                                                <td><?php echo $row['name'] ?></td>
												<td><a class="btn btn-success" href="add_questions?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><i class="fa fa-edit"></i> Add Questions</a>&nbsp;<a class="btn btn-info" href="survey_questions?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>&ques_id=1"><i class="fa fa-edit"></i> Manage</a>&nbsp;<a class="btn btn-info" href="edit_template?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>"><i class="fa fa-edit"></i> Edit</a></td>
												<!--<td><a class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
												<td><a class="<?php echo (($row['status'] == '0')?'btn btn-success':'btn btn-danger') ?>" href="disable_template?id=<?php echo $row['id'] ?>"><i class="fa fa-trash-o"></i> <?php echo (($row['status'] == '0')?'Enable':'Disable') ?></a>
												</td>
                                            </tr>
										<?php
											}
										}
										?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Modify</th>
                                                <th>Enable/Disable</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

       <!--PAGE CONTENT END-->

<?$this->layout->block('currentPageJS')?>
<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="http://jquery-datatables-column-filter.googlecode.com/svn/trunk/media/js/jquery.dataTables.columnFilter.js"></script>
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>

<script src="<?=base_url('assets/admin/js/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
	$(function() {
		var dataTable = $('#example1').dataTable({
		sPaginationType: "full_numbers"
		});
		dataTable.columnFilter({
	  sPlaceHolder: "head:before",
	  aoColumns: [
		  { type: "select" },  
	  ]
	});
});
        
</script>

<?$this->layout->block()?>