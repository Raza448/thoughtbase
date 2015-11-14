<style>
.col-md-6 {
	margin:0 auto;
	float:none !important;
}
.radio label, .checkbox label{
padding: 0 20px 0 0;
}
</style>

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
						<?php 
						if(isset($category))
						{
						?>
                        <li class="active">Edit Category</li>
						<?php
						}
						else
						{
						?>
						<li class="active">Add Category</li>
						<?php
						}
						?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                    <!-- Main row -->
                    <div class="row">
					 <div class="col-md-6">
                       <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">
									<?php
									if(isset($category))
									{
										echo 'Edit Category';
									}
									else
									{
										echo 'Add Category';
									}
									?>
									</h3>
                                </div><!-- /.box-header -->
								
								<div class="box box-primary">
                               
                                <!-- form start -->
                                <form action="" method="post" role="form">
								
                                    <div class="box-body">
									<?php
									if(isset($category))
									{
									//print_r($category);
									?>
                                        <div class="form-group">
										<label for="exampleInputEmail1">Category Name</label>
										<input type="text"  class="form-control" name="cat_name" id="name" value="<?php echo $category['name'] ?>"  placeholder="Category Name" required>
                                    </div>
                                    <div class="box-footer">
                                        <input type="submit" name="upd_category" value="Submit" class="btn btn-primary">
                                    </div>
									<?php
									}
									else
									{
									?>
									<div class="form-group">
										<label for="exampleInputEmail1">Category Name</label>
										<input type="text"  class="form-control" name="cat_name" id="name"  placeholder="Category Name" required>
                                    </div>
                                    <div class="box-footer">
                                        <input type="submit" name="add_category" value="Submit" class="btn btn-primary">
                                    </div>
									<?php
									}
									?>
									
                                    </div><!-- /.box-body -->
								
									</div>

                                    
                                </form>
                            </div><!-- /.box -->
                                
                       </div><!-- /.box -->
					 </div>
                        
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

       <!--PAGE CONTENT END-->

<?$this->layout->block('currentPageJS')?>

<?$this->layout->block()?>