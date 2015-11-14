<style>
.col-md-6 {
	margin:0 auto;
	float:none !important;
}
.alert{
	margin-left:0;
	padding-left:15px;
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
									Change Password
									</h3>
                                </div><!-- /.box-header -->
								
								<div class="box box-primary box-body">
                               <?php $this->load->view('components/flash_msg'); ?>	
                                <!-- form start -->
                                <form action="" method="post" role="form" id="password-form" novalidate="novalidate" >
										<div class="form-group">
											<input type="password"  autocorrect="off" autocapitalize="none" name="current_password" id="current_password" class="form-control" placeholder="Current Password"/>
											<div id="errorcontainer-current_password" class='errorDiv'></div>
										</div>
										<div class="form-group">
											<input type="password"  autocorrect="off" autocapitalize="none" name="new_password" id="new_password" class="form-control" placeholder="New Password"/>
											<div id="errorcontainer-new_password" class='errorDiv'></div>
										</div>
										<div class="form-group">
											<input type="password"  autocorrect="off" autocapitalize="none" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password"/>
											<div id="errorcontainer-confirm_password" class='errorDiv'></div>
										</div>
									<div class="form-group">
										<input type="submit" name="pass" value="Change Password" class="btn bg-olive btn-block">
										<!--<a href="register.html" class="text-center">Register a new membership</a>-->
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