		<header id="header">
			<div class="container">
				<h1 class="logo">
					<a href="<?=site_url() ?>" style="text-decoration:none;">
					<img  data-sticky-width="100" data-sticky-height="96" src="<?php echo base_url(); ?>assets/img/new_logo.png" />
					</a>
				</h1>

				<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
					<i class="icon icon-bars"></i>
				</button>
			</div>
			<div class="navbar-collapse nav-main-collapse collapse">
				<div class="container">
					<nav class="nav-main mega-menu">
						<ul class="nav nav-pills nav-main" id="mainMenu">
						
							<li class="<?=($title_for_layout=='Home')?'active':'' ?>">
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
							</li>
							
								<?php  
								//check client session
							   $out_client = ($this->session->userdata('clientAuth') != FALSE) ? 1:0;
                               $out_vendor = ($this->session->userdata('vendorAuth') != FALSE) ? 1:0;
								
								if( $out_client == 0 && $out_vendor == 0){ ?>
								
								<li class="<?=($title_for_layout=='Login')?'active':'' ?>">
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
							    </li>								
								<?php 
								
								}else{ 
							     if($out_client == 1 ){
							   ?>
							   
							    <li class="<?=($title_for_layout=='My Posts'||$title_for_layout=='Post Details')?'active':'' ?>">
									<a href="<?=site_url('user/myQueries') ?>">Dashboard</a>
								</li>
								<li class="dropdown">
								<a class="dropdown-toggle" href="#">
									<i class="fa fa-user"></i> 
									My Account
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?=site_url('user/Profile'); ?>">Update Profile</a></li>
									<li><a href="<?=site_url('main/logout') ?>">Logout</a></li>
								</ul>
								</li> 	   
							   <?php }else if( $out_vendor == 1 ){ ?>
							     <li class="<?=($title_for_layout=='Dashboard'||$title_for_layout=='Dashboard')?'active':'' ?>">
									<a href="<?=site_url('business/dashboard') ?>">Dashboard</a>
								</li>
								<li class="dropdown">
								<a class="dropdown-toggle" href="#">
									<i class="fa fa-user"></i> 
									My Account
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?=site_url('business/profile'); ?>">Update Account</a></li>
									<li><a href="<?=site_url('main/logout') ?>">Logout</a></li>
								</ul>
								</li> 
							   
							   
							   <?php }} ?>
								
						
							<li class="<?=($title_for_layout=='contact')?'active':'' ?>">
								<a href="<?=site_url() ?>">Contact</a>
							</li>
														
							  
						</ul>
					</nav>
				</div>
			</div>
		</header>