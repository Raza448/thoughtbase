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
						if(isset($template))
						{
						?>
                        <li class="active">Edit Template</li>
						<?php
						}
						else
						{
						?>
						<li class="active">Add Template</li>
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
									if(isset($template))
									{
										echo 'Edit Template';
									}
									else
									{
										echo 'Add Template';
									}
									?>
									</h3>
                                </div><!-- /.box-header -->
								
								<div class="box box-primary">
                               
                                <!-- form start -->
                                <form action="" method="post" role="form" id="<?php echo ((isset($_GET['id']))?'modify_template-form':'add_template-form') ?>" novalidate="novalidate">
								
                                    <div class="box-body">
									<?php
									if(isset($template))
									{
									?>
                                    <div class="form-group">
										<label for="exampleInputEmail1">Template</label>
										<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="temp_name" id="name" value="<?php echo $template['name'] ?>" >
										<div id="errorcontainer-name" class='errorDiv'></div>
                                    </div>
									
									<?php /*if($template['ans_type'] != 2){ ?>
									<div class="row">
									<div class="col-xs-10">
										<label for="exampleInputEmail1" style="width:100%;">Answers</label>
										<?php
										if(isset($answers))
										{
											foreach($answers as $row)
											{
											?>
											<div style="width:80%;float:left;">
											<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="answer[]" id="name" value="<?php echo $row['answer'] ?>" required></div>
											<div style="width:20%;float:left;"><a class="delete_ques" title="Remove" n="<?php echo $row['answer'] ?>" m="<?php echo $row['template_id'] ?>" style="cursor:pointer;"> &nbsp; x </a></div>
											<?php
											}
											echo '<div class="input_fields_wrap"></div>
												<a class="add_field_button" style="cursor:pointer;width:100%;float:left;">Add More Fields</a>';
										}
										?>
                                    </div>
									</div>
									<?php }*/ ?>
                                    <div class="box-footer">
                                        <input type="submit" name="upd_template" value="Submit" class="btn btn-primary">
                                    </div>
									<?php
									}
									else
									{
									?>
									<div class="form-group">
										<label for="exampleInputEmail1">
										<input type="radio" class="form-control question_category" name="type" value="0" checked> Existing Product</label>
										<label for="exampleInputEmail1" id="category">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" class="form-control question_category" name="type" value="3"> New Product</label>
                                    </div>
									<div class="form-group">
										<label for="exampleInputEmail1">Category Name</label>
										<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="title" id="name"  placeholder="Category Name" >
										<div id="errorcontainer-name" class='errorDiv'></div>
                                    </div>
                                    <div class="box-footer">
                                        <input type="submit" name="add_template" value="Submit" class="btn btn-primary">
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