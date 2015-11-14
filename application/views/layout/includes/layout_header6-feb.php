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
								<form action="<?=site_url('main/userLogin') ?>" method="post" class="form-inline login">
								  <div class="form-group">
									<label class="sr-only" for="exampleInputEmail3">Email address</label>
									<input name="email" type="email" autocorrect="off" autocapitalize="none"  value="<?php echo set_value('email'); ?>" class="form-control" id="exampleInputEmail3" placeholder="EMAIL" required>
								  </div>
								  <div class="form-group">
									<label class="sr-only" for="exampleInputPassword3">Password</label>
									<input name="password" type="password"  autocorrect="off" autocapitalize="none" value="<?php echo set_value('password'); ?>" class="form-control" id="exampleInputPassword3" placeholder="PASSWORD" required><br />
									<a class="pull-left" href="<?php echo site_url('main/forgot_password'); ?>" style="color:#fff;padding:5px 0;">Forgot Password?</a>
								  </div>
								   <div class="form-group">
								  <input type="submit" class="btn btn-default" value="LOGIN">
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
								<ul class="nav nav-pills nav-main" id="mainMenu" style="padding:0 0 20px;">
								<?php
							     if($out_client == 1 ){
							   ?>
							   
							    <!--<li class="<?=($title_for_layout=='My Posts'||$title_for_layout=='Post Details')?'active':'' ?>">
									<a href="<?=site_url('user/myQueries') ?>">Dashboard</a>
								</li>-->
								<li class="dropdown">
								<a class="dropdown-toggle" href="#">
									<i class="fa fa-user"></i> 
									<?php
									$this->db->select("*");
									$this->db->from('users');
									$this->db->where('id', $this->session->userdata('client_id'));
									
									$query = $this->db->get();
									if($query->num_rows() > 0)
									{
										$data = $query->row();
										$name = explode("@",$data->email);
										echo $name[0];
									}
									?>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?=site_url('user/Profile'); ?>">My Account</a></li>
									<li><a href="<?=site_url('main/logout') ?>">Logout</a></li>
								</ul>
								</li> 	   
							   <?php }else if( $out_vendor == 1 ){ ?>
							     <!--<li class="<?=($title_for_layout=='Dashboard'||$title_for_layout=='Dashboard')?'active':'' ?>">
									<a href="<?=site_url('business/dashboard') ?>">Dashboard</a>
								</li>-->
								<li class="dropdown">
								<a class="dropdown-toggle" href="#">
									<i class="fa fa-user"></i> 
									<?php
									$id = $this->session->userdata('vendor_id');
									$this->db->select("*");
									$this->db->from('users');
									$this->db->where('id', $id);
									
									$query = $this->db->get();
									if($query->num_rows() > 0)
									{
										$data = $query->row();
										$name = explode("@",$data->email);
										echo $name[0];
									}
									?>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?=site_url('business/profile'); ?>">My Account</a></li>
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
			</div>
		</header>