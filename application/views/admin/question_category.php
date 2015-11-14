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
                        <li class="active">Question Category</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                    <!-- Main row -->
                    <div class="row">
					 <div class="col-md-6">
                       <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Select Answer</h3>
                                </div><!-- /.box-header -->
								
								<div class="box box-primary">
                               
                                <!-- form start -->
                                <form action="" method="post" role="form">
								
                                    <div class="box-body">
									
										<div class="form-group">
                                            <label for="exampleInputPassword1">Have you used this product / service before ?</label>
                                            <select class="form-control" name="question_cat" id="question_cat">
                                                <option value=""> --select-- </option>
                                                <option value="1"> Yes </option>
                                                <option value="2"> No </option>
                                            </select>
                                        </div>
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