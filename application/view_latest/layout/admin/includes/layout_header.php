<header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Thoughtbase
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        
                       
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span> Welcome 
								<?php 
								if($this->session->userdata('admin'))
								{
								$data = $this->session->userdata('admin'); 
									foreach($data as $row)
									{
										echo ucfirst($row->nickname);
									}
								}
								
								?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <!--<li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Jane Doe - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>-->
                                <!-- Menu Body -->
                               <!-- <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!--<div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>-->
                                    <div class="pull-right">
                                        <a href="<? echo site_url() ?>/admin/home/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
		<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                   
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="../home">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
						
						<li <?php echo (basename($_SERVER['PHP_SELF']) == 'users' ? 'class="active"':'') ?>>
                            <a href="<? echo site_url() ?>/admin/main/users">
                                <i class="fa fa-th"></i> <span>Users</span>
                            </a>
                        </li>
                        <li <?php echo ((basename($_SERVER['PHP_SELF']) == 'categories') || (basename($_SERVER['PHP_SELF']) == 'edit_category')? 'class="active treeview"':'class="treeview"') ?>>
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Manage Categories</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<? echo site_url() ?>/admin/main/edit_category"><i class="fa fa-angle-double-right"></i> Add Categories</a></li>
                                <li><a href="<? echo site_url() ?>/admin/main/categories"><i class="fa fa-angle-double-right"></i> Edit Categories</a></li>
                            </ul>
                        </li>
						<li <?php echo (basename($_SERVER['PHP_SELF']) == 'templates' ? 'class="active"':'') ?>>
                            <a href="<? echo site_url() ?>/admin/main/templates">
                                <i class="fa fa-th"></i> <span>Templates</span>
                            </a>
                        </li>
						<li <?php echo (basename($_SERVER['PHP_SELF']) == 'site_settings' ? 'class="active"':'') ?>>
                            <a href="<? echo site_url() ?>/admin/main/site_settings">
                                <i class="fa fa-th"></i> <span>Settings</span>
                            </a>
                        </li>
						<!--<li <?php echo ((basename($_SERVER['PHP_SELF']) == 'survey_questions') || (basename($_SERVER['PHP_SELF']) == 'edit_question')? 'class="active treeview"':'class="treeview"') ?>>
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Survey Questions</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<? echo site_url() ?>/admin/main/edit_questions"><i class="fa fa-angle-double-right"></i> Add Questions</a></li>
                                <li><a href="<? echo site_url() ?>/admin/main/survey_questions"><i class="fa fa-angle-double-right"></i> Manage Questions</a></li>
                            </ul>
                        </li>-->
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>