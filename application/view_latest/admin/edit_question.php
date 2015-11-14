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
						if(isset($question))
						{
						?>
                        <li class="active">Edit Queston</li>
						<?php
						}
						else
						{
						?>
						<li class="active">Add Question</li>
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
									if(isset($question))
									{
										echo 'Edit Question';
									}
									else
									{
										echo 'Add Question';
									}
									?>
									</h3>
                                </div><!-- /.box-header -->
								
								<div class="box box-primary">
                               
                                <!-- form start -->
                                <form action="" method="post" role="form" id="modify_question-form" novalidate="novalidate">
								
                                    <div class="box-body">
									<?php
									if(isset($question))
									{
									?>
                                    <div class="form-group">
										<label for="exampleInputEmail1">Question</label>
										<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="ques_name" id="name" value="<?php echo $question['question'] ?>" >
										<div id="errorcontainer-name" class='errorDiv'></div>
                                    </div>
									<?php if($question['ans_type'] != 2){ ?>
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
											<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="answer[]" id="answer" value="<?php echo $row['answer'] ?>" required>
											<div id="errorcontainer-answer" class='errorDiv'></div></div>
											<div style="width:20%;float:left;"><a class="delete_ques" title="Remove" n="<?php echo $row['answer'] ?>" m="<?php echo $row['question_id'] ?>" style="cursor:pointer;"> &nbsp; x </a></div>
											<?php
											}
											echo '<div class="input_fields_wrap"></div>
												<a class="add_field_button" style="cursor:pointer;width:100%;float:left;">Add More Fields</a>';
										}
										?>
                                    </div>
									</div>
									<?php } ?>
                                    <div class="box-footer">
                                        <input type="submit" name="upd_question" value="Submit" class="btn btn-primary">
                                    </div>
									<?php
									}
									else
									{
									?>
									<div class="form-group">
										<label for="exampleInputEmail1">Category Name</label>
										<input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="cat_name" id="name"  placeholder="Category Name" required>
										<div id="errorcontainer-name" class='errorDiv'></div>
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
<script type="text/javascript">
$(".delete_ques").click(function(){
	var answer = $(this).attr('n');
	var ques_id = $(this).attr('m');
	var type = "<?php echo $_GET['type'] ?>";
	
	parent.location.assign("<?php echo site_url(); ?>/admin/main/remove_answer?answer="+answer+"&ques_id="+ques_id+"&type="+type+"");
});
</script>
<?$this->layout->block()?>