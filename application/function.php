<?php
require('admin/database.php');
session_start();	
function head() {
	?>
	<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from templates.expresspixel.com/bootlistings/listings.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 09 Jan 2015 16:00:20 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="css/images/favicon.ico">

        <title>Discounts Wale</title>

        <!-- Bootstrap core CSS -->
        <link id="switch_style" href="css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="css/jquery.bxslider.css" media="screen" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="css/theme.css" rel="stylesheet">
        <link href="css/dropzone.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox8cbb.css?v=2.1.5" media="screen" />
        <link rel="stylesheet" type="text/css" href="js/fancybox/helpers/jquery.fancybox-buttons8cbb.css?v=2.1.5" media="screen" />
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/html5shiv.js"></script>
        <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

	<?php
}
function js() {
?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/dropzone.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="js/fancybox/jquery.fancybox8cbb.js?v=2.1.5"></script>
<script type="text/javascript" src="js/fancybox/helpers/jquery.fancybox-buttons8cbb.js?v=2.1.5"></script>
<script type="text/javascript" src="js/fancybox/helpers/jquery.fancybox-media8cbb.js?v=2.1.5"></script>
<script src="js/global.js"></script>

<?php
}
function main_header() 
{
?>
<nav class="navbar navbar-default" role="navigation">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a href="index.php" class="navbar-brand ">
                        <span class="logo"><img src="css/images/discount_logo.png" /></span>
                    </a>

                </div>



                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right visible-xs">
                        <li class="active"><a href="#">Home</a></li>
						<?php 
						if(isset($_SESSION['member_id']) or isset($_SESSION['user_id']))
						{
						?>
                        
						<?php
						}
						else
						{
						?>
						<li><a data-toggle="modal" data-target="#modalLogin" href="#">Login</a></li>
						<?php
						}
						?>
                        <li><a href="registration.php">Register</a></li>
                        <li><a href="#">Listings</a></li>
                        <li><a href="#">My account</a></li>
                        <li><a href="#">logout</a></li>
                    </ul> 
                    <div class="nav navbar-nav navbar-right hidden-xs">
                        <div class="row">

                            <div class="pull-right">

								<?php 
						if(isset($_SESSION['member_id']) or isset($_SESSION['user_id']))
						{
						?>
                         
						<?php
						}
						else
						{
						?>
                                <a data-toggle="modal" data-target="#modalLogin"  href="#">Login</a> | 
								<a href="registration.php">Register</a> | 
						<?php
						}
						?>
                                
                                 
								<?php 
								if(isset($_SESSION['member_id']) or isset($_SESSION['user_id']))
								{
								?>
                                <a href="my_account.php"> Welcome <?php echo $_SESSION['user'] ?></a> |
                                <a href="logout.php">logout</a>
								<?php
								}
								else
								{
								?>
								<a href="page.php?title=Become a Member">Become a Member</a> 
								<?php
								}
								?>

                            </div>	
                        </div>




                    </div>
					

                </div>
				
			<div class="col-sm-9" style="position:relative;left: 75px;">
			<?php //search(); ?>
				<form action="listing.php" method="get" class="form-vertical" style="float:left;width:100%;">
				
				<div class="form-group">
					<div class="col-sm-3" style="padding:0;margin-left:10px;">
							<select class="form-control" id="city" name="city">
									<option value=""> City </option>
									<?php
										$ob = new database();
										$ob->query("SELECT * FROM member_details Group By city");
										foreach($ob->rows() as $mc)
										{
										?>
										<option value="<?php echo $mc['city'] ?>"><?php echo $mc['city'] ?></option>
										<?php
										}
										?>
                                        
                                    </select>
									
						</div>
						<div class="col-sm-3" style="padding:0;margin-left:10px;">
							<select class="form-control" id="location" name="location">
									<option value=""> Locations </option>
									<?php
										$ob = new database();
										$ob->query("SELECT * FROM member_details Group by landmark");
										foreach($ob->rows() as $ms)
										{
										?>
										<option value="<?php echo $ms['landmark'] ?>"><?php echo $ms['landmark'] ?></option>
										<?php
										}
										?>
                                        
                                    </select>
									
								</div>
						<!--<div class="col-sm-3">
							<input type="text" class="form-control" id="location" name="location" placeholder="Location">
						</div>-->
						
						<div class="col-sm-3" style="padding:0;margin-left:10px;">
							<input type="text" class="form-control" id="search" name="search_val" placeholder="Search">
						</div>
						
						<div class="col-sm-3 srch" style="width:initial;padding:0">
							<input type="submit" Value="submit" class="btn btn-primary search-btn" style="border-radius:0;width:130px;"><i class="icon-search"></i>
						</div>
				
				</form>
				</div>
				</div>
		<div class="col-md-9" style="position: relative;left: 37px;">
			<div class="col-sm-5" style="padding:0;float:right;margin:10px 0;">
					<select class="form-control" id="shop" name="shop">
						<option value=""> All Shops </option>
						<?php
							$ob = new database();
							$ob->query("SELECT * FROM member_details Group by company_name");
							foreach($ob->rows() as $ms)
							{
							?>
							<option value="<?php echo $ms['id'] ?>"><?php echo $ms['company_name'] ?></option>
							<?php
							}
							?>
					</select>
				</div>
				<div class="col-sm-5" style="padding:0;margin: 10px 20px;float:right;">
					<select class="form-control" id="seasonal_head" name="seasonal">
						<option value=""> All Seasonal Offers </option>
						<?php
										$ob = new database();
										$ob->query("SELECT * FROM seasonal_offer");
										if ($ob->numRows() >= 1)
										{
											foreach($ob->rows() as $data)
											{
												if($data['shop_id'] != 0)
												{
												$ob->query("SELECT * FROM member_details WHERE id=$data[shop_id]");
												foreach($ob->rows() as $data1)
												{
												echo "<option value='",$data1['id'],"' n='0'>",$data1['company_name'],"</option>";
												}
												}
												else
												{
													echo "<option value='",$data['id'],"' n='1'>",$data['s_name'],"</option>";
												}
											}
											
										}
										else
										{
											echo "<option value=''>No Shops Available</option>";
										}
									?>
					</select>
				</div>
		</div>
			<script type="text/javascript">
			$('#shop').on('change', function() {
			var search = $(this).val();
			parent.location.assign("details.php?id="+search+"");
			});
			$('#seasonal_head').on('change', function() {
			var search = $(this).val();
			var m_name = $(this).find('option:selected').attr('n');
			
			//alert(m_name);
			if(m_name == 0)
			{
				parent.location.assign("seasonal_offer.php?id="+search+"");
			}
			else if(m_name == 1)
			{
			parent.location.assign("seasonal_offer.php?s_id="+search+"");
			}
			});
			/* $('#city').on('change', function() {
			var search = $(this).val();
			parent.location.assign("listing.php?search="+search+"");
			}); */
			</script>





            </nav>			 <hr class="topbar"/>
<?php
}
function search()
{
	
		$city = $_GET['city'];
		$location = $_GET['location'];
		$search = $_GET['search_val'];
		
		//echo '<script>parent.location.assign("listing.php?city='.$city.'&location='.$location.'$search_val='.$search.'")</script>';
		
		/* $ob = new database();
		$q = "SELECT member_details.*,cat.name as cat_name,dish.name as scat_name,cat_handle.scat,catalogue.* from member_details";
		$q .= " INNER JOIN catalogue on member_details.id = catalogue.shop_id";
		$q .= " INNER JOIN cat_handle on member_details.id = cat_handle.shop_id";
		$q .= " INNER JOIN dish on dish.id = cat_handle.scat";
		$q .= " INNER JOIN cat on cat.id = dish.cat";
		//$q .= " WHERE 1 group by company_name";
		
		//echo $q;
		if($city != "")
		{
			$q .= " and city='$city'";
		}
		
		if($location != "")
		{
			$q .= " and landmark='$location'";
		}
		if($search != "")
		{
			$q .= " and catalogue.name LIKE '$search%'";
		}
		$q .= " group by company_name";
		
		$data = $ob->query($q);
		foreach($ob->rows() as $data)
		{
			echo $data['company_name'];
		} */
		
		
		
		
		/* $search = $_POST['search_val'];
		$location = $_POST['location'];
		
		$ob = new database();
		if(($search != "") && ($location!=""))
		{
			$ob->query("SELECT * FROM member_details WHERE contact_person LIKE '$search%' or address='$search' or landmark='$search' or company_name='$search' or city='$search' or mobile='$search' or postcode='$search' or state='$search' or address='$location' or landmark='$location' or city='$location'");
			if($ob->numRows() >= 1)
			{
				echo '<script>parent.location.assign("listing.php?search='.$search.'&location='.$location.'")</script>';
			 }
			 else
			 {
				
				echo '<script>alert("No Search Criteria Matched.\n")</script>';
			 }
		 }
		 else if($search != "")
		 {
			$ob->query("SELECT * FROM member_details WHERE contact_person LIKE '$search%' or address='$search' or landmark='$search' or company_name='$search' or city='$search' or mobile='$search' or postcode='$search' or state='$search' ");
			if($ob->numRows() >= 1)
			{
				
				echo '<script>parent.location.assign("listing.php?search='.$search.'")</script>';
			 }
			 else
			 {
				$ob->query("SELECT * FROM catalogue WHERE name LIKE '$search%'");
				if($ob->numRows() >= 1)
				{
					
					echo '<script>parent.location.assign("listing.php?search='.$search.'")</script>';
				 }
				 else
				 {
					echo '<script>alert("No Search Criteria Matched.\n")</script>';
				 }
			}
		 }
		 else if($location != "")
		 {
			$ob->query("SELECT * FROM member_details WHERE  landmark='$location' or city='$location'");
			if($ob->numRows() >= 1)
			{
				echo '<script>parent.location.assign("listing.php?location='.$location.'")</script>';
			 }
			 else
			 {
				echo '<script>alert("No Search Criteria Matched.\n")</script>';
			 }
		 } */
	
}
function login()
{
	if(isset($_POST['login']))
	{
		$username = $_POST['email'];
		$password = md5($_POST['password']);
		$id = $_POST['shop_id'];
		
		$ob = new database();
		if(!empty($id))
		{
			$ob->query("SELECT * FROM user WHERE email_id='$username' and password='$password' and flag=1");
			if ($ob->numRows() >= 1)
			{
				foreach($ob->rows() as $data1)
				{
					$_SESSION['user_id'] = $data1['id'];
					$_SESSION['user'] = $data1['fname'];
				}
				
				echo '<script>parent.location.assign("details.php?id='.$id.'")</script>';
			}
			else
			{
				echo '<script>alert("Invalid Username and Password.\n")</script>';
				echo '<script>parent.location.assign("details.php?id='.$id.'")</script>';
			}
		}
		else
		{
		$ob->query("SELECT * FROM member WHERE email_id='$username' and password='$password'");
		if ($ob->numRows() >= 1)
		{
			foreach($ob->rows() as $data)
			{
				$_SESSION['member_id'] = $data['id'];
				$_SESSION['m_user'] = $data['name'];
			}
			echo '<script>parent.location.assign("index.php")</script>';
		}
		else
		{
			$ob->query("SELECT * FROM user WHERE email_id='$username' and password='$password' and flag='1'");
			if ($ob->numRows() >= 1)
			{
				foreach($ob->rows() as $data1)
				{
					$_SESSION['user_id'] = $data1['id'];
					$_SESSION['user'] = $data1['fname'];
				}
				echo '<script>parent.location.assign("index.php")</script>';
			}
			else
			{
				echo '<script>alert("Invalid Username and Password.\n")</script>';
			}
		}
		}
	}
}
function login_check()
{
	if ((empty($_SESSION['member_id'])) and (empty($_SESSION['user_id'])))
	{
		session_destroy();
		header('Location:index.php');
	}
}
function logout()
{
	session_destroy();
	mysql_close();
	echo '<script>parent.location.assign("index.php")</script>';
}
/* function create_member()
{
	if(isset($_POST['create_member']))
	{
		$shop_name = $_POST['shop_name'];
		$contact_person = $_POST['name'];
		$about_shop = $_POST['about'];
		$address = $_POST['address'];
		$landmark = $_POST['landmark'];
		$post_code = $_POST['postcode'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$location = $_POST['location'];
		$email_id = $_POST['email'];
		$password = md5($_POST['password']);
		$mobile = $_POST['mobile'];
		
		$target = 'upload/';
		if (!is_dir($target))
		{
			mkdir($target);
		}
		if(!empty($_FILES['logo']['name']))
		{
		
		$r = rand(0123456789,1234567890);
		echo $pic = $target.$r.$_FILES['logo']['name'];
		}
		else{
			$pic = "";
		}
		$ob = new database();
		$ob->query("INSERT INTO member_details SET contact_person = '$contact_person', company_name='$shop_name', about_company='$about_shop', address='$address', landmark='$landmark', postcode='$post_code', city='$city', state='$state', location='$location', email_id='$email_id', password='$password', mobile='$mobile', shop_logo='$pic'");
		move_uploaded_file($_FILES['logo']['tmp_name'], $pic);
		$n = mysql_insert_id();
		if (!empty($n))
		{
			echo '<script>alert("Profile Successfully Created.\nPlease Login to Continue.")</script>';
			echo '<script>parent.jQuery.fancybox.close()</script>';
			echo '<script>parent.location.assign("homepage.php")</script>';
			//echo '<script>parent.location.reload()</script>';
			
		}else{
			echo '<script>alert("Failed.\nTry Again.")</script>';
		} 
		
		
	}
}
function create_ad()
{
	if(isset($_POST['publish_ad']))
	{
		echo $scat = $_POST['scat'];
		echo $title = $_POST['title'];
		echo $desc = mysql_real_escape_string($_POST['desc']);
		echo $price = $_POST['price'];
		echo $shop_id = $_SESSION['member_id'];
		$target = 'upload/';
		if (!is_dir($target))
		{
			mkdir($target);
		}
		if(!empty($_FILES['image']['name']))
		{
		
		$r = rand(0123456789,1234567890);
		echo $pic = $target.$r.$_FILES['image']['name'];
		}
		else{
			$pic = "";
		}
		$ob = new database();
		$ob->query("INSERT INTO posted_ad SET shop_id='$shop_id', scat='$scat', title='$title', description='$desc', price='$price', image='$pic'");
		move_uploaded_file($_FILES['image']['tmp_name'], $pic);
		$n = mysql_insert_id();
		if (!empty($n))
		{
			echo '<script>alert("Ad Posted Succesfully.")</script>';
			echo '<script>parent.jQuery.fancybox.close()</script>';
			echo '<script>parent.location.assign("products.php")</script>';
		}else{
			echo '<script>alert("Failed.\nTry Again.")</script>';
		} 
		
		
	}
}
function edit_member()
{
	if(isset($_POST['edit_member']))
	{
		$shop_name = $_POST['shop_name'];
		$contact_person = $_POST['name'];
		$about_shop = $_POST['about'];
		$address = $_POST['address'];
		$landmark = $_POST['landmark'];
		$post_code = $_POST['postcode'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$location = $_POST['location'];
		$email_id = $_POST['email'];
		$mobile = $_POST['mobile'];
		
		$target = 'upload/';
		if (!is_dir($target))
		{
			mkdir($target);
		}
		$ob = new database();
		if(!empty($_FILES['logo']['name']))
		{
			$r = rand(0123456789,1234567890);
			$pic = $target.$r.$_FILES['logo']['name'];
			$ob->query("SELECT * FROM member_details where id='$_SESSION[member_id]'");
			foreach($ob->rows() as $data)
			{
				unlink($data['shop_logo']);
				$ob->query("UPDATE member_details SET shop_logo='$pic' WHERE id='$_SESSION[member_id]'");
				move_uploaded_file($_FILES['logo']['tmp_name'], $pic);
			} 
		}
		$ob->query("UPDATE member_details SET contact_person = '$contact_person', company_name='$shop_name', about_company='$about_shop', address='$address', landmark='$landmark', postcode='$post_code', city='$city', state='$state', location='$location', email_id='$email_id', mobile='$mobile' WHERE id='$_SESSION[member_id]'");

	
			echo '<script>alert("Profile Successfully Updated")</script>';
			echo '<script>parent.jQuery.fancybox.close()</script>';
			echo '<script>parent.location.assign("account.php")</script>';
			
		
		
	}
} */

function footer(){	

echo '<div class="footer" sty><div class="container">        
	<div class="row">            
		<div class="col-sm-4 col-xs-12">				
			<p class="footer-links">										
				<ul class="footer_menu">					
					<h3>Quick Pages</h3>					
					<li><a href="page.php?title=About Us" class="active">About Us</a>
					</li>					
					<li><a href="page.php?title=Advertise With Us" class="active">Advertise With Us</a></li>';
					if(isset($_SESSION['user_id']))
					{
						echo '';
					}
					else
					{
					
					echo '<li><a href="page.php?title=Become a Member" class="active">Get your Membership card</a></li>';
					}
					echo '</ul>                                    </p>            
		</div>				
		<div class="col-sm-4 col-xs-12">				
			<p class="footer-links">					
				<ul class="footer_menu">					
				<h3>Get to Know Us</h3>					
				<li><a href="page.php?title=FAQs" class="active">FAQs</a></li>					
				<li><a href="page.php?title=How Discountswale Works" class="active">How Discountswale Works</a></li>					
				<li><a href="contact_us.php" class="active">Contact Us</a></li>	
				<br />
				<li><a class="active">Current Website Users</a></li>	
				<li><div class="counter">
  <span>1</span>
  <span>2</span>
  <span>1</span>
  <span>6</span>
  <span>2</span>
  <span>2</span>
</div> </li>
					</ul>                                   
			</p>            
		</div>							
		
		<div class="col-sm-4 col-xs-12">				
			<p class="footer-links">					
				<ul class="footer_menu">					
					<h3>Terms & Policies</h3>					
					<li><a href="page.php?title=Privacy Policy" class="active">Privacy Policy</a></li>					<li><a href="page.php?title=Terms and Conditions" class="active">Terms & Conditions</a></li>										
				</ul> 
				<ul class="social">
				<li><a href="http://facebook.com/discountswale" target=_blank><img src="img/facebook.png" /></li>
					<li><a href="http://twitter.com/discountswale" target=_blank><img src="img/twitter.png" /></a></li>
					<li><a href="http://linkedin.com" target=_blank><img src="img/linked.png" /></a></li>
				</ul><br />
				<ul class="social">
				<li style="color:#fff;">&copy; Discountswale. All Rights Reserved.</a></li>
				</ul>
			</p>            
		</div>	        
	</div>    
</div></div>';
}
function login_model()
{
?>
<div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sign in to your account</h4>
            </div>
            <div class="modal-body">
                <p>If you have an account with us, please enter your details below.</p>
				<?php login(); ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" accept-charset="UTF-8" id="user-login-form" class="form ajax" data-replace=".error-message p">

                    <div class="form-group">
                        <input placeholder="Your username/email" class="form-control" name="email" type="text">                </div>

                    <div class="form-group">
                        <input placeholder="Your password" class="form-control" name="password" type="password" value="">                </div>

                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button type="submit" name="login" class="btn btn-primary pull-right">Login</button>
							<input type="hidden" name="shop_id" value="<?php echo $_GET['id'] ?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a data-toggle="modal" href="#modalForgot">Forgot your password?</a>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer" style="text-align: center">
                <div class="error-message"><p style="color: #000; font-weight: normal;">Don't have an account? <a class="link-info" href="registration.php">Create Account</a>&nbsp;</p></div>
            </div>

        </div><!-- /.modal-content -->
    </div>
<?php
}
function forgot_model()
{
?>
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot your password?</h4>
            </div>
            <div class="modal-body">
                <p>Enter your email to continue</p>

                <?php forgot_password(); ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Your email address" required />
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        </div><div class="col-md-6">
                        <input type="submit" name="forgot_password" class="btn btn-primary pull-right" value="Submit">
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
<?php
}
function sidebar_nav()
{
?>
<div class="sidebar-account">		
	<div class="row ">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">My account</div>
				<div class="panel-body">
					<ul class="nav">
								
						<!--<li>	
							<a class="active" href="account_profile.html">My profile</a>
						</li>-->
                         <li>
							<a class="active" href="my_account.php">Edit Profile</a>
						</li>
						<li>
							<a class="active" href="change_password.php">Change Password</a>
						</li>
						<!--<li>
							<a class="active" href="account_ads.html">Manage ads</a>
						</li>
						<li>
							<a class="active" href="ad_create.php">Create new ad</a>
						</li>-->
					</ul>

				</div>
			</div>
		</div>
	</div>

	<div class="row hidden-xs">

		</div>

</div>        
<?php
}
function contact()
{
	if(isset($_POST['contact_discount']))
	{
		 $name=$_POST['name'];
		 $phone=$_POST['phone'];
		 $location=$_POST['location'];
		 $city=$_POST['city'];
		 $email=$_POST['email_id'];
		 $feedback=$_POST['feedback'];
		 
		 
		 $msg="Name: ".$name."\r\n";
		 $msg.="Phone No.: ".$phone."\r\n";
		 $msg.="Location: ".$location."\r\n";
		 $msg.="City: ".$city."\r\n";
		 $msg.="E-mail ID: ".$email."\r\n";
		 $msg.="Feedback: ".$feedback."\r\n";
		 
		 $to = "contactdiscountswale@gmail.com";
	 
			$recipients = $to;
			$mailmsg = $msg;
			$subject = "Feedback"; 
			$headers["From"] = "info@discountwale.com";
			$headers["To"] = $recipients;
			$headers["Subject"] = $subject;
            $headers  = "MIME-Version: 1.0" . "\r\n";
			$headers["Content-Type"] = "text/HTML; charset=iso-8859-1";
		
		mail($recipients, $subject, $mailmsg);
		
		if(!mail)
		{
			echo "<script>alert('Message Sending Failed')</script>";
		}
		else
		{
		
			echo "<script>alert('Message Sent Succesfully')</script>";
		}
	}
	
}
function member_register()
{
	if(isset($_POST['member_register']))
	{
		 $name=$_POST['p_name'];
		 $dob=$_POST['dob'];
		 $contact=$_POST['contact'];
		 $card=$_POST['card_type'];
		 
		 $email=$_POST['email_id'];
		 $address=$_POST['address'];
		 $family_head=$_POST['family_head'];
		  
		 $ob = new database();
		 $ob->query("SELECT * FROM member WHERE email_id='$email'");
		 if($ob->numRows() >= 1)
		 {
			echo "<script>alert('Email Already Exist.Try another One.')</script>";
			echo "<script>parent.location.assign('page.php?title=Become a Member')</script>";
		 }
		 else
		 {
		 $ob->query("INSERT INTO member SET name='$name', dob='$dob', contact='$contact', email_id='$email', address='$address', card_type='$card', family_head='$family_head'");
		 
		 $n = mysql_insert_id();
		 if($n)
		 {
			$msg="Name: ".$name."\r\n";
			$msg.="Date Of Birth: ".$dob."\r\n";
			$msg.="Contact: ".$contact."\r\n";
			$msg.="Card: ".$card."\r\n";
			

			$msg.="E-mail ID: ".$email."\r\n";
			$msg.="Address: ".$address."\r\n";
			$msg.="Family Head: ".$family_head."\r\n";

			$to = "memberdiscountswale@gmail.com";
			$to .= ", ".$email;

			$recipients = $to;
			$mailmsg = $msg;
			$subject = "Membership Registration"; 
			$headers["From"] = "members@discountswale.com";
			$headers["To"] = $recipients;
			$headers["Subject"] = $subject;
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers["Content-Type"] = "text/HTML; charset=iso-8859-1";

			mail($recipients, $subject, $mailmsg);
			
			echo "<script>alert('Registered Succesfully.We will Contact You soon.')</script>";
			echo "<script>parent.location.assign('index.php')</script>";
		 }
		 else
		 {
			echo "<script>alert('Failed.Try Again.')</script>";
		 }
	
	}
	}
	
}
function register()
{
	if(isset($_POST['register']))
	{
		 $f_name=$_POST['f_name'];
		 $l_name=$_POST['l_name'];
		 $username=md5($_POST['username']);
		 $password=md5($_POST['password']);
		 
		 
		 $email=$_POST['email_id'];
		
		 
		 $ob = new database();
		 $ob->query("SELECT * FROM user WHERE email_id='$email'");
		 if($ob->numRows() >= 1)
		 {
			echo "<script>alert('Email Already Exist.Try another One.')</script>";
			echo "<script>parent.location.assign('registration.php')</script>";
		 }
		 else
		 {
		 $ob->query("INSERT INTO user SET fname='$f_name', lname='$l_name', username='$username', password='$password', email_id='$email'");
		 
		 $n = mysql_insert_id();
		 if($n)
		 {
			$msg="Please Click on the below link to Activate Your Account:\r\n";
			$msg.="http://discountswale.com/discount/activate_account.php?id=".base64_encode($n)."\r\n";
			
			$ob->query("SELECT * FROM user WHERE id='$n'");
			foreach($ob->rows() as $data)
			{
				$to = $data['email_id'];
				$recipients = $to;
			}
			

			
			$mailmsg = $msg;
			$subject = "Account Confirmation"; 
			$headers["From"] = "info@discountwale.com";
			$headers["To"] = $recipients;
			$headers["Subject"] = $subject;
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers["Content-Type"] = "text/HTML; charset=iso-8859-1";
		
			mail($recipients, $subject, $mailmsg);
			echo "<script>alert('Registered Succesfully.Please Check your Inbox or Spam Folder for Activation Link.')</script>";
			echo "<script>parent.location.assign('index.php')</script>";
		 }
		 else
		 {
			echo "<script>alert('Failed.Try Again.')</script>";
		 } 
	
	}
	}
}
function update_user()
{
	if(isset($_POST['update']))
	{
		 $f_name=$_POST['f_name'];
		 $l_name=$_POST['l_name'];
		 
		 $email=$_POST['email_id'];
		 
		 $ob = new database();
		 $ob->query("UPDATE user SET fname='$f_name', lname='$l_name', email_id='$email'");
		 
		 echo "<script>alert('Update Succesfully.')</script>";
		 
	}
}
function rating_login()
{
	if(isset($_POST['rating_login']))
	{
		$username = $_POST['email'];
		$password = md5($_POST['password']);
		$id = $_POST['shop_id'];
		
		$ob = new database();
		$ob->query("SELECT * FROM user WHERE email_id='$username' and password='$password' and flag=1");
		if ($ob->numRows() >= 1)
		{
			foreach($ob->rows() as $data1)
			{
				$_SESSION['user_id'] = $data1['id'];
				$_SESSION['user'] = $data1['fname'];
			}
			
			echo '<script>parent.location.assign("details.php?id='.$id.'")</script>';
		}
		else
		{
			echo '<script>alert("Invalid Username and Password.\n")</script>';
		}
	}
	
}
function rating()
{
	if(isset($_POST['rating_user']))
	{
		$id = $_POST['shop_id'];
		$rate = $_POST['rating'];
		
		$ob = new database();
		$ob->query("SELECT * FROM rating WHERE shop_id='$id' and user_id='$_SESSION[user_id]'");
		if($ob->numRows() >= 1)
		{
			foreach($ob->rows() as $data)
			{
				$ob->query("UPDATE rating SET rating='$rate' WHERE shop_id='$id' and user_id='$_SESSION[user_id]'");
			}
		}
		else
		{
		$ob->query("INSERT INTO rating SET rating='$rate', shop_id='$id', user_id='$_SESSION[user_id]'");
		}
		
		
		echo '<script>alert("Thank You for your Response.")</script>';
		echo '<script>parent.location.assign("index.php")</script>';
		
	}
}
function fancy()
{
	?>
	<!--<script type="text/javascript" src="admin/fancy/lib/jquery-1.9.0.min.js"></script>-->
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="admin/fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="admin/fancy/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="fancy/source/jquery.fancybox.css?v=2.1.4" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="admin/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="admin/fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="admin/fancy/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox({
				afterClose : function() {
					//location.reload();
					return;
					}
			});
			
			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					type : 'iframe',
					padding : 0,
				});
			});
			});
	</script>
	<?php
}
function change_password()
{
	if(isset($_POST['change_pass']))
	{
	$new_pass = md5($_POST['password']);
	$confirm_pass = $_POST['confirm_pass'];
	
	$ob = new database();
	$ob->query("UPDATE user SET password='$new_pass' WHERE id='$_SESSION[user_id]'");
	
	echo '<script>alert("Password Updated Succesfully.")</script>';
	}
}
function forgot_password()
{
	if(isset($_POST['forgot_password']))
	{
	$email = $_POST['email'];
	$ob = new database();
	$ob->query("SELECT * FROM user WHERE email_id='$email'");
	foreach($ob->rows() as $data)
	{
		$pass = base64_decode($data['password']);
		
	}
	
		$msg="Your Login Details: \r\n";
		$msg.="Username: ".$email."\r\n";
		$msg.="Password: ".$pass."\r\n";


		$to = $email;
	 
		$recipients = $to;
		$mailmsg = $msg;
		$subject = "Password Recovery"; 
		$headers["From"] = "info@discountswale.com";
		$headers["To"] = $recipients;
		$headers["Subject"] = $subject;
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers["Content-Type"] = "text/HTML; charset=iso-8859-1";
		
		mail($recipients, $subject, $mailmsg);
		
		if(!mail)
		{
			echo "<script>alert('Message Sending Failed')</script>";
		}
		else
		{
		
			echo "<script>alert('Password Sent Succesfully.Please Check Your E-mail.')</script>";
		}
	}
	
	
}
?>