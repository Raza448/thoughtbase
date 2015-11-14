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
                        <li class="active">Categories</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                    <!-- Main row -->
                    <div class="row">
                       <div class="box">
                                 <div class="box-header">
                                    <h3 class="box-title">Select Answer</h3><br /><br />
									<div class="col-sm-6" style="float:none;padding:0;">
									 <form action="" method="post" role="form">
								
                                    <div class="box-body">
									<?php if($_GET['type'] == 0){ ?>
										<div class="form-group">
                                            <label for="exampleInputPassword1"><?php echo get_social_icon('general_question') ?></label>
                                            <select class="form-control" name="question_cat" id="question_cat">
                                                <option value=""> --select-- </option>
												<?php
												if(isset($_GET['ques_id']))
												{
												?>
                                                <option value="1" <?php echo ($_GET['ques_id'] == '1' ? 'selected':'') ?>> Yes </option>
                                                <option value="2" <?php echo ($_GET['ques_id'] == '2' ? 'selected':'') ?>> No </option>
                                                <option value="3" <?php echo ($_GET['ques_id'] == '3' ? 'selected':'') ?>> Both </option>
												<?php
												}
												else
												{
												?>
												<option value="1"> Yes </option>
                                                <option value="2"> No </option>
                                                <option value="3"> Both </option>
												<?php
												}
												?>
                                            </select>
                                        </div>
									<?php } ?>
									</div>
										
                                </form>
								</div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive question_all">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Modify</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php
										if(isset($questions))
										{
										
											foreach($questions as $row)
											{
										?>
                                            <tr>
                                                <td><?php echo $row['question'] ?></td>
												<td><a class="btn btn-info" href="edit_question?id=<?php echo $row['id'] ?>&type=<?php echo $_GET['type'] ?>"><i class="fa fa-edit"></i> Edit</a></td>
												<?php if(isset($_GET['ques_id'])){ ?>
												<td><a class="btn btn-danger" href="delete_question?id=<?php echo $row['id'] ?>&t_id=<?php echo $_GET['id'] ?>&ques_id=<?php echo $_GET['ques_id'] ?>&type=<?php echo $_GET['type'] ?>"><i class="fa fa-trash-o"></i> Delete</a></td>
												<?php }else{ ?>
												<td><a class="btn btn-danger" href="delete_question?id=<?php echo $row['id'] ?>&t_id=<?php echo $_GET['id'] ?>&type=<?php echo $_GET['type'] ?>"><i class="fa fa-trash-o"></i> Delete</a></td>
												<?php } ?>
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
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                    </table>
									
                                </div><!-- /.box-body -->
								<div class="box-body table-responsive question" style="display:none;">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Modify</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php
										if(isset($questions))
										{
										
											foreach($questions as $row)
											{
										?>
                                            <tr>
                                                <td><?php echo $row['question'] ?></td>
												<td><a class="btn btn-info" href="edit_question?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i> Edit</a></td>
												<td><a class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
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
                                                <th>Delete</th>
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