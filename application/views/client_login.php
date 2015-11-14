<?$this->layout->block('currentPageCss')?>
<!--define current page css-->
<?$this->layout->block()?>
<?$this->layout->block('breadcrumbs')?>
	<section class="page-top">
			<div class="container">
							<div class="row">
								<div class="col-md-12">
									<ul class="breadcrumb">
										<li><a href="<?=site_url() ?>">Home</a></li>
										<li class="active">Login</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Login</h2>
								</div>
							</div>
			</div>
	</section>
<?$this->layout->block()?>
	<div class="container">
			<div class="row">
				<div class="col-md-12">
						<?php $this->load->view('components/flash_msg'); ?>	
						<?php $this->load->view('components/form_message'); ?>	
						<?php 
						if(isset($error))
						{
						?>
						<div class="alert alert-danger">
						<strong>Error!</strong> <?php echo $error; ?>
						</div>
						<?php
						}
						?>
						
						
				</div>
			</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row featured-boxes login">
									<div class="col-md-6">
										<div class="featured-box featured-box-secundary default info-content">
											
											<div class="box-content">
												<?php
												$x1 ="";
												$y1 ="";
												$ter1 = set_value('username');
												if($ter1 ==""){									    
												//checking for cookie set										
												$x1 = get_cookie('kk_username');										
												if ($x1 !="") {											
												$ter1 = $x1;										
												}									 
												}									 
												$pass1 = set_value('password');									  
												if($pass1 ==""){									    
												$y1 = get_cookie('kk_password');									    //checking for cookie set										
												if($y1 !=""){									      
												$pass1 = $y1;										
												}									  
												}									
												?>					
												<form action="<?=site_url('main/userLogin') ?>" id="login" novalidate="novalidate" method="post" >
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<label>Username</label>
																<input name="username" type="text"  value="<?php echo $ter1; ?>" class="form-control input-lg" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-group">
															<div class="col-md-12">
																<a class="pull-right" href="<?php echo site_url('main/forgot_password'); ?>">(Forgot Password?)</a>
																<label>Password</label>
																<input name="password" type="password"  autocorrect="off" autocapitalize="none" value="<?php echo $pass1; ?>" class="form-control input-lg" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-7">
															<span class="remember-box checkbox">
																	<input type="checkbox" <?php if($x1 !=""){ ?>  checked <?php } ?> id="rememberme" name="rem"><label for="rememberme"><span><span></span></span>Remember Me
																</label>
															</span>
														</div>
														<div class="col-md-5">
															<input type="submit" value="Login" class="btn btn-default pull-right push-bottom" data-loading-text="Loading...">
														</div>
													</div>
													
												</form>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
<?$this->layout->block('currentPageJS')?>
		<!-- Current Page JS -->
<script type="text/javascript">
/**
  * Basic jQuery Validation Form Demo Code
  * Copyright Sam Deering 2012
  * Licence: http://www.jquery4u.com/license/
  */
(function($,W,D)
{
    var form_validate = {};

    form_validate =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#login").validate({
                rules: {
                    username: "required",
					password : "required"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        form_validate.setupFormValidation();
    });

})(jQuery, window, document);

</script>
<?$this->layout->block()?>