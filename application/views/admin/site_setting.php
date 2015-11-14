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
                        <li class="active">Edit User</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                    <!-- Main row -->
                    <div class="row">
					 <div class="col-md-6">
                       <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Edit Site Setting</h3>
                                </div><!-- /.box-header -->
								
								<div class="box box-primary">
                               
                                <!-- form start -->
                                <form action="" method="post" role="form" id="setting-form" novalidate="novalidate" enctype="multipart/form-data">
								<?php 
								$this->db->set('val', $user_commission);
								$this->db->where('name', 'user_pay');
								$this->db->update('settings');
								
								$this->db->set('val', $site_commission);
								$this->db->where('name', 'percentage');
								$this->db->update('settings');
								?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Site Name</label>
                                            <input type="text"  class="form-control" name="site_name" id="site_name" value="<?php echo $site_name ?>" placeholder="Site Name">
											<div id="errorcontainer-site_name" class="errorDiv"></div>
                                        </div>
										 <div class="form-group">
                                            <label for="exampleInputEmail1">Site Url</label>
                                            <input type="text"  class="form-control" name="site_url" id="site_url" value="<?php echo $site_url ?>" placeholder="Site Url" >
											<div id="errorcontainer-site_url" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputFile">Logo</label><br />
											<img src="<?php echo base_url().$logo ?>" />
                                            <input type="file" name="logo" id="logo">
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">General Question</label>
                                            <input type="text"  class="form-control" name="general_question" id="general_question" value="<?php echo $general_question ?>" placeholder="General Question" >
											<div id="errorcontainer-general_question" class="errorDiv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Query Price Per User </label>
                                            <input type="text"  class="form-control" name="user_commission" id="user_commission" value="<?php echo $user_commission ?>" placeholder="Users Commission" >
											<div id="errorcontainer-user_commission" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Site Commission</label>
                                            <input type="text"  class="form-control" name="site_commission" id="site_commission" value="<?php echo $site_commission ?>" placeholder="Site Commission" >
											<div id="errorcontainer-site_commission" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Reply-To Email</label>
                                            <input type="text"  class="form-control" name="site_email" id="site_email" value="<?php echo $site_email ?>" placeholder="Admin Email" >
											<div id="errorcontainer-site_email" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Contact Email</label>
                                            <input type="text"  class="form-control" name="contact_email" id="contact_email" value="<?php echo $contact_email ?>" placeholder="Contact Email" >
											<div id="errorcontainer-contact_email" class="errorDiv"></div>
                                        </div>
										<hr>
										<hr>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Paypal Environment Mode</label>
                                            <label> <input type="radio" class="form-control env_mode" name="env_mode" id="env_mode_sandbox" value="0" <?php echo ($env_mode == 0)?"checked=checked": ""; ?> > Sandbox </label>
											
											<label><input type="radio" class="form-control env_mode" name="env_mode" id="env_mode_live" value="1"  <?php echo ($env_mode == 1)?"checked=checked": ""; ?> >   Live  </label>
										</div>
										<div class="env_mode_sandbox">
										<label for="exampleInputPassword1">Sandbox Mode Details</label>
										<hr />
										<div class="form-group">
                                            <label for="exampleInputPassword1">Paypal Email</label>
                                            <input type="text"  class="form-control" name="sandbox_payment_email" id="sandbox_payment_email" value="<?php echo $sandbox_payment_email ?>" placeholder="Payment Email">
											<div id="errorcontainer-sandbox_payment_email" class="errorDiv"></div>
                                        </div>
										
										<div class="form-group">
                                            <label for="exampleInputPassword1">API Username</label>
                                            <input type="text"  class="form-control" name="sandbox_api_username" id="sandbox_api_username" value="<?php echo $sandbox_api_username ?>" placeholder="API Username" >
											<div id="errorcontainer-sandbox_api_username" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">API Password</label>
                                            <input type="text"  class="form-control" name="sandbox_api_password" id="sandbox_api_password" value="<?php echo $sandbox_api_password ?>" placeholder="API Password" >
											<div id="errorcontainer-sandbox_api_password" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">API Signature</label>
                                            <input type="text"  class="form-control" name="sandbox_api_signature" id="sandbox_api_signature" value="<?php echo $sandbox_api_signature ?>" placeholder="API Signature" >
											<div id="errorcontainer-sandbox_api_signature" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">App Id</label>
                                            <input type="text"  class="form-control" name="sandbox_app_id" id="sandbox_app_id" value="<?php echo $sandbox_app_id ?>" placeholder="App Id" required>
											<div id="errorcontainer-sandbox_app_id" class="errorDiv"></div>
                                        </div>
										</div>
										<div class="env_mode_live" style="display:none;">
										<label for="exampleInputPassword1">Live Mode Details</label>
										<hr />
										<div class="form-group">
                                            <label for="exampleInputPassword1">Paypal Email</label>
                                            <input type="text"  class="form-control" name="live_payment_email" id="live_payment_email" value="<?php echo $live_payment_email ?>" placeholder="Payment Email" >
											<div id="errorcontainer-live_payment_email" class="errorDiv"></div>
                                        </div>
										
										<div class="form-group">
                                            <label for="exampleInputPassword1">API Username</label>
                                            <input type="text"  class="form-control" name="live_api_username" id="live_api_username" value="<?php echo $live_api_username ?>" placeholder="API Username" >
											<div id="errorcontainer-live_api_username" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">API Password</label>
                                            <input type="text"  class="form-control" name="live_api_password" id="live_api_password" value="<?php echo $live_api_password ?>" placeholder="API Password" >
											<div id="errorcontainer-live_api_password" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">API Signature</label>
                                            <input type="text"  class="form-control" name="live_api_signature" id="live_api_signature" value="<?php echo $live_api_signature ?>" placeholder="API Signature" >
											<div id="errorcontainer-live_api_signature" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">App Id</label>
                                            <input type="text"  class="form-control" name="live_app_id" id="live_app_id" value="<?php echo $live_app_id ?>" placeholder="App Id" >
											<div id="errorcontainer-live_app_id" class="errorDiv"></div>
                                        </div>
										</div>
										<hr>
										<hr>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Twitter</label>
                                            <input type="text"  class="form-control" name="twitter" id="twitter" value="<?php echo $twitter ?>" placeholder="Twitter" >
											<div id="errorcontainer-twitter" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Facebook</label>
                                            <input type="text"  class="form-control" name="facebook" id="facebook" value="<?php echo $facebook ?>" placeholder="Facebook">
											<div id="errorcontainer-facebook" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Linkedin</label>
                                            <input type="text"  class="form-control" name="linkedin" id="linkedin" value="<?php echo $linkedin ?>" placeholder="Linkedin" >
											<div id="errorcontainer-linkedin" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Footer Copyright</label>
                                            <input type="text"  class="form-control" name="footer_copyright" id="footer_copyright" value="<?php echo $footer_copyright ?>" placeholder="Footer Copyright">
											<div id="errorcontainer-footer_copyright" class="errorDiv"></div>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Spam Words</label>
                                            <textarea  class="form-control" name="validate_fields" rows="4" id="validate_fields" value placeholder="Validate Fields"><?php echo set_value('validate_fields',(isset($validate_fields) ? stripslashes($validate_fields):'')); ?></textarea>
											<div id="errorcontainer-validate_fields" class="errorDiv"></div>
                                        </div>
									
                                    </div><!-- /.box-body -->
								
									</div>

                                    <div class="box-footer">
                                        <input type="submit" name="upd_site" value="Submit" class="btn btn-primary">
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
$(document).ready(function(){
	var b = $('input[type=radio]:checked').val();
	if(b == 0){
	 $('.env_mode_live').hide();
	 $('.env_mode_sandbox').show();
	}else{
	 $('.env_mode_live').show();
	 $('.env_mode_sandbox').hide();
	}
	$('.env_mode').click(function(){
		var a = $(this).val();
		if(a == 0){
		 $('.env_mode_live').hide();
		 $('.env_mode_sandbox').show();
		 $('.env_mode_sandbox input[type=text]').attr('disabled', false);
		 $('.env_mode_live input[type=text]').attr('disabled', true);
		}else{
		 $('.env_mode_live').show();
		 $('.env_mode_sandbox').hide();
		 $('.env_mode_sandbox input[type=text]').attr('disabled', true);
		 $('.env_mode_live input[type=text]').attr('disabled', false);	 
		}
	});
});
</script>
<?$this->layout->block()?>