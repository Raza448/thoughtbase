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
                        <li class="active">Users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                    <!-- Main row -->
                    <div class="row">
                       <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Users</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Music</th>
                                                <th>Movies</th>
                                                <th>Business</th>
                                                <th>Gender</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php
										if(isset($users))
										{
										
											foreach($users as $row)
											{
										?>
                                            <tr>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['music'] ?></td>
                                                <td><?php echo $row['movies'] ?></td>
                                                <td><?php echo $row['business'] ?></td>
                                                <td><?php echo $row['gender'] ?></td>
                                            </tr>
										<?php
											}
										}
										?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Email</th>
                                                <th>Music</th>
                                                <th>Movies</th>
                                                <th>Business</th>
                                                <th>Gender</th>
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
<script src="<?=base_url('assets/admin/js/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?=base_url('assets/admin/js/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
 <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

<?$this->layout->block()?>