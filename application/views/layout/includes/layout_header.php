		<header id="header">
			<img data-sticky-width="100" data-sticky-height="100" class="beta" src="<?php echo base_url('assets/img/beta-tag.png') ?>"> 
			
			<div class="container">
			<?php 
			 if($this->session->userdata('client_id')){
			 ?>
			<!--<div class="pull-right welcome">
					<?php
					$this->db->select("*");
					$this->db->from('users');
					$this->db->where('id', $this->session->userdata('client_id'));
					
					$query = $this->db->get();
					if($query->num_rows() > 0)
					{
						$data = $query->row();
						$name = explode("@",$data->email);
						echo "Welcome ". $name[0];
					}
			?>
			</div>-->
			<?php
			}
			$logo = $this->db->query('select * from site_meta_setting where meta_key="logo"')->row_array();
			?>
			
				<h1 class="logo">
					<a href="<?=site_url() ?>" style="text-decoration:none;">
					<img  data-sticky-width="100" data-sticky-height="100" src="<?php echo base_url(); ?>/<?php echo$logo['meta_value'] ?>" />
					</a>
				</h1>
				<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
					<i class="fa fa-bars"></i></i>
				</button>
			<div class="navbar-collapse nav-main-collapse collapse pad-0">
					<nav class="nav-main mega-menu">
					<div style="min-height:10px;">
					<div>
						<div class="error" style="display:none;">
							<div class="alert alert-danger">
								<strong>Error!</strong> <span></span>
							</div>
						</div>
					</div>
							<!--<li class="<?=($title_for_layout=='Home')?'active':'' ?>">
								<a href="<?=site_url() ?>">Home</a>
							</li>
							
							<li class="<?=($title_for_layout=='about')?'active':'' ?>">
								<a href="#">About</a>
							</li>
				
					
							<li class="<?=($title_for_layout=='contact')?'active':'' ?>">
								<a href="#">How it works</a>
							</li>
							<li class="<?=($title_for_layout=='contact')?'active':'' ?>">
								<a href="#">FAQ</a>
							</li>-->
							
								<?php  
								//check client session
							   $out_client = ($this->session->userdata('clientAuth') != FALSE) ? 1:0;
                               $out_vendor = ($this->session->userdata('vendorAuth') != FALSE) ? 1:0;
								
								if( $out_client == 0 && $out_vendor == 0){ ?>
								<ul class="nav nav-pills nav-main" id="mainMenu">
								<form action="<?=site_url('main/userLogin') ?>" method="post" class="form-inline login" id="top_login" novalidate="novalidate">
								<span>
								 <div class="form-group">
									<label class="sr-only" for="exampleInputEmail3">Email address</label>
									<?php 
									 $x ="";	
									 $y ="";
									 $ter = set_value('username');
									 if($ter ==""){
									    //checking for cookie set
										$x = get_cookie('kk_username');
										if ($x !="") {
											$ter = $x;
										}
									  }
									  $pass = set_value('password');
									  if($pass ==""){
									    $y = get_cookie('kk_password');
									    //checking for cookie set
										if($y !=""){
									       $pass = $y;
										}
									  }
									?>									
									<input name="username" autocorrect="off" autocapitalize="none" value="<?php echo $ter; ?>" class="form-control" id="top_username" placeholder="Username" >
									<div id="errorcontainer-top_username" class='errorDiv'></div>
								  </div>
								  <div class="form-group password_box">
									<label class="sr-only" for="exampleInputPassword3">Password</label>
									<input name="password" type="password"  autocorrect="off" autocapitalize="none" value="<?php echo $pass; ?>" id="top_password" class="form-control" placeholder="Password" />
									<div id="errorcontainer-top_password" class='errorDiv'></div>
									<div class="checkbox rem">
									<label>
									  <input <?php if($x !=""){ ?>  checked <?php } ?> type="checkbox" name="rem"  value="1"><div><span><span></span></span>&nbsp;Remember Me</div>
									  </label>
									</div>
									<div class="checkbox forgot_pass">
										<a class="forgot_pass" href="<?php echo site_url('main/forgot_password'); ?>" style="color:#fff;padding:1px 5px;">Forgot Password?</a>
									</div>
								  </div><br />
							</span>					   
								  <div class="form-group">
								  <input type="submit" class="btn btn-default sign_in" value="LOGIN"><br />
								  <!--<a class="forgot_pass" href="<?php echo site_url('main/forgot_password'); ?>" style="color:#fff;padding:1px 5px;">Forgot Password?</a>-->
								  </div>
								</form>
								
								<!--<li class="<?=($title_for_layout=='Login')?'active':'' ?>">
								   <a href="<?=site_url('main/userLogin') ?>">Login</a>
							     </li>
								 
								 <li class="dropdown">
									<a class="dropdown-toggle" href="#">
									Users
									<i class="fa fa-angle-down"></i>
								</a>
							
								<ul class="dropdown-menu">
									
									<li><a href="<?=site_url('main/userRegister') ?>">Register</a></li>
								</ul>
							    </li>
								<li class="dropdown">
									<a class="dropdown-toggle" href="#">
									Advertisers 
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									
									<li><a href="<?=site_url('main/businessRegister')?>">Register</a></li>
								</ul>
							    </li>-->
									</ul>
								<?php 
								}else{
								
								?>
								
								<?php
							     if($out_client == 1 ){ ?>
								 <ul class="nav nav-pills nav-main user_menu" id="mainMenu">
								 <?php
									$query ="SELECT clients_survey.user_id as suid,clients_survey.survey_id,clients_survey.created_on,clients_survey.completed,
									survey_temp.* from clients_survey left join survey_temp
									on clients_survey.survey_id=survey_temp.id 
									where clients_survey.user_id =".$this->session->userdata('client_id')." and clients_survey.completed = 0 and clients_survey.created_on >= '".date('Y-m-d', strtotime('-2 days', time()))."' order by clients_survey.survey_id desc";
									$gim = $this->db->query($query)->result_array();
								 if(count($gim) > 0 ){
							   ?>
							   
								<!--<li>
								<a href="<?=site_url('user/myQueries') ?>"><i class="fa fa-inbox"></i>&nbsp;New query (<?php echo count($gim); ?>)</a>
								</li>-->
							   <?php } ?>
								<li><a href="<?php echo site_url('user/myQueries'); ?>">Dashboard</a></li>
								<li><a href="<?php echo site_url('user/myEarnings'); ?>">History</a></li>
							    <!--<li class="<?=($title_for_layout=='My Posts'||$title_for_layout=='Post Details')?'active':'' ?>">
									<a href="<?=site_url('user/myQueries') ?>">Dashboard</a>
								</li>-->
								<li><a href="<?=site_url('user/Profile'); ?>">Edit Profile</a></li>
								<li><a href="<?=site_url('main/logout') ?>">Logout</a></li>
							   <?php }else if( $out_vendor == 1 ){ ?>
							     <!--<li class="<?=($title_for_layout=='Dashboard'||$title_for_layout=='Dashboard')?'active':'' ?>">
									<a href="<?=site_url('business/dashboard') ?>">Dashboard</a>
								</li>-->
								<ul class="nav nav-pills nav-main btn btn-default business_menu" id="mainMenu">
								<li class="dropdown">
								<a class="dropdown-toggle" >
									<?php
									$id = $this->session->userdata('vendor_id');
									$this->db->select("*");
									$this->db->from('vendors');
									$this->db->where('user_id', $id);
									
									$query = $this->db->get();
									if($query->num_rows() > 0)
									{
										$data = $query->row();
										$name = $data->name;
										echo stripslashes($name);
									}
									?>
									<i class="fa down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?=site_url(); ?>">Dashboard</a></li>
									<li><a href="<?=site_url('business/profile'); ?>">Edit Profile</a></li>
									<li><a href="<?=site_url('main/logout') ?>">Logout</a></li>
								</ul>
								</li> 
							   
							   
							   <?php } ?>
							   </ul>
							   <?php
							   } ?>
								
						
							<!--<li class="<?=($title_for_layout=='contact')?'active':'' ?>">
								<a href="<?=site_url() ?>">Contact</a>
							</li>-->
						
					</nav>
			</div>
		<div class="divider">
			<div class="container">
				<img src="<?php echo base_url('assets/img/divider.png') ?>" />
			</div>
		</div>
	
			</div>
		</div>
		</header>
		