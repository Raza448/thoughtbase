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
                        <li class="active">Edit Question</li>
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
                                <form action="" method="post" role="form" id="template-form" novalidate="novalidate">
								
                                    <div class="box-body">
									<div class="form-group">
										<label for="exampleInputEmail1">
										<input type="radio" class="form-control question_category" name="question_category" value="0" <?php echo ($_GET['type']==0 ? 'checked':'disabled') ?>> Existing Product</label>
										<label for="exampleInputEmail1" id="category">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" class="form-control question_category" name="question_category" value="3" <?php echo ($_GET['type']==3 ? 'checked':'disabled') ?>> New Product</label>
                                    </div>
                                    <div class="form-group ques_cat">
										<label for="exampleInputEmail1"><?php echo get_social_icon('general_question') ?></label>
										<select class="form-control" name="question_cat" id="ques_cat">
											<option value=""> --select-- </option>
											<option value="1"> Yes </option>
											<option value="2"> No </option>
										</select>
										<div id="errorcontainer-ques_cat" class='errorDiv'></div>
                                    </div>
									<div class="row">
                                        <div class="col-xs-3">
											<label for="exampleInputEmail1">Question Type</label>
                                            <select class="form-control" name="ans_type" id="ques_type">
												<option value=""> --select-- </option>
												<option value="1"> Radio </option>
												<option value="2"> Text </option>
											</select>
											<div id="errorcontainer-ques_type" class='errorDiv'></div>
                                        </div>
                                        <div class="col-xs-7 add_ques" style="display:none;">
											<label for="exampleInputEmail1">Enter Question</label>
                                            <input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="ques" id="ques" placeholder="Enter Question" required />
											<div id="errorcontainer-ques" class='errorDiv'></div><br />
											
											<label for="exampleInputEmail1">Enter Answers</label>
											<?php for($i=0;$i<4;$i++){ ?>
                                            <input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="answer[]" id="answer<?php echo $i ?>" placeholder="Enter Answers" />
											<div id="errorcontainer-answer<?php echo $i ?>" class='errorDiv'></div>
											<?php } ?>
                                        </div>
										<div class="col-xs-7 add_ques_text" style="display:none;">
											<label for="exampleInputEmail1">Enter Question</label>
                                            <input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="text_ques" id="text_ques" placeholder="Enter Question" required><br />
											<div id="errorcontainer-text_ques" class='errorDiv'></div>
                                        </div>
                                    </div>
									
									
                                    <div class="box-footer">
										<input type="hidden" value="<?php echo $_GET['id'] ?>" name="survey_id"/>
                                        <input type="submit" name="add_question" value="Submit" class="btn btn-primary">
                                    </div>
									
                                    </div><!-- /.box-body -->
								
									
                                    
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
$(document).ready(function(){
	
	var a = $('.question_category:checked').val();
	//alert(a);
	if(a == 3){
		$('.ques_cat').hide();
	}else{
		$('.ques_cat').show();
	}
	$("#ques_type").change(function(){
		var cat = $(this).val();
		if(cat == 1)
		{
			$(".add_ques").show();
			$(".add_ques_text").hide();
			$(".add_ques_text textarea").prop('disabled', true);
			$(".add_ques input[type=text]").prop('disabled', false);
		}
		else if(cat == 2)
		{
			$(".add_ques_text").show();
			$(".add_ques").hide();
			$(".add_ques_text textarea").prop('disabled', false);
			$(".add_ques input[type=text]").prop('disabled', true);
		}
		else
		{
			$(".add_ques").hide();
			$(".add_ques_text").hide();
			$(".add_ques_text textarea").prop('disabled', true);
			$(".add_ques input[type=text]").prop('disabled', true);
		}
	});
});
</script>
<?$this->layout->block()?>