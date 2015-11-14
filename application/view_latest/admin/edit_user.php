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
                                    <h3 class="box-title">Edit User</h3>
                                </div><!-- /.box-header -->
								
								<div class="box box-primary">
                               
                                <!-- form start -->
                                <form action="" method="post" role="form">
								
                                    <div class="box-body">
									<?php
									if(isset($user))
									{
									//print_r($user);
									?>
                                       <!-- <div class="form-group">
                                            <label for="exampleInputEmail1">Contact Name</label>
                                            <input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="contact_name" id="name" value="<?php echo $user['contact_name'] ?>" placeholder="Contact Name" >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Contact Number</label>
                                            <input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="contact_number" id="number" value="<?php echo $user['contact_number'] ?>" placeholder="Contact Number" >
                                        </div>-->
										<div class="form-group">
                                            <label for="exampleInputPassword1">Age Range</label>
                                            <select class="form-control" name="age" id="age">
                                                <!--<option value="1" <?php if($user['age'] == 1  ){ ?> selected <?php } ?>  >12 - 17</option>-->
												<option value="2" <?php if($user['age'] == 2  ){ ?> selected <?php } ?> >18 - 24</option>
												<option value="3" <?php if($user['age'] == 3  ){ ?> selected <?php } ?> >25 - 34</option>
												<option value="4" <?php if($user['age'] == 4  ){ ?> selected <?php } ?> >35 - 44</option>
												<option value="5" <?php if($user['age'] == 5 ){ ?> selected <?php } ?> >45 - 54</option>
												<option value="6" <?php if($user['age'] == 6  ){ ?> selected <?php } ?> >55 - 64</option>
												<option value="7" <?php if($user['age'] == 7  ){ ?> selected <?php } ?> >65+</option>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Gender</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Zipcode</label>
                                            <input type="text" autocorrect="off" autocapitalize="none" class="form-control" name="zipcode" id="zipcode" value="<?php echo $user['zipcode'] ?>" placeholder="Zipcode" required>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputPassword1">Paypal E-mail Address</label>
                                            <input type="email" autocorrect="off" autocapitalize="none" class="form-control" name="email" id="email" value="<?php echo $user['email'] ?>" placeholder="Paypal E-mail" required>
                                        </div>
                                        
										<div class="form-group">
										<label for="exampleInputPassword1">Interests</label>
										
                                        <div class="checkbox">
										<?php
										$query = "select * from interests";

						    $out   = $this->db->query($query);

							$z     = $out->result_array();

							$query2 = "select * from user_interest where user_id =".$_GET['id'];

						    $out2   = $this->db->query($query2);

							$z2     = $out2->result_array();

							$pk     = array();

							if(count($z2) > 0 ){

							 foreach( $z2 as $rows => $vals ){

							   $pk[] = $vals['interest'];

							 }

							}

						    if(count($z)>0){

							$i=0;

							foreach($z as $ry => $y ){

						  ?>

						    <input  style="float:left" name="interest[<?php echo $i; ?>]" <?php if( in_array($y['id'],$pk)){  ?> checked <?php } ?>  type="checkbox" value="<?php echo $y['id'];  ?>"><?php echo $y['name']." &nbsp;"; ?>

						  <?php 

						   $i++;}}

						  ?> 
                                        </div>
									<div class="box-footer">
                                        <input type="submit" name="update_user" value="Submit" class="btn btn-primary">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button name="cancel" class="btn btn-warning" onclick="goBack()">Cancel</button>
                                    </div>
									<?php
									}else{ ?>
							<div class="form-group">
									<label>Company Name <span class="mandatory">*</span></label>
									<input name="company_name" type="text" autocorrect="off" autocapitalize="none" id="company" value="<?php echo $vendor['company_name'] ?>" class="form-control " />
									<div id="results-company" class="results error"></div>
									<div id="errorcontainer-company" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>Company Description <span class="mandatory">*</span></label>
									<textarea autocorrect="off" autocapitalize="none" name="description" id="company_desc" class="form-control "><?php echo $vendor['description'] ?></textarea>
									<div id="results-company_desc" class="results error"></div>
									<div id="errorcontainer-company_desc" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>First Name <span class="mandatory">*</span></label>
									<input name="fname" type="text" autocorrect="off" autocapitalize="none" id="fname" value="<?php echo $vendor['fname'] ?>" class="form-control " />
									<div id="results-fname" class="results error"></div>
									<div id="errorcontainer-fname" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>Last Name <span class="mandatory">*</span></label>
									<input name="lname" type="text" autocorrect="off" autocapitalize="none" id="lname" value="<?php echo $vendor['lname'] ?>" class="form-control " />
									<div id="results-lname" class="results error"></div>
									<div id="errorcontainer-lname" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>Address Line 1 <span class="mandatory">*</span></label>
									<textarea autocorrect="off" autocapitalize="none" name="uen" id="addr1" class="form-control "><?php echo $vendor['uen'] ?></textarea>
									<div id="results-addr1" class="results error"></div>
									<div id="errorcontainer-addr1" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>Address Line 2</label>
									<textarea autocorrect="off" autocapitalize="none" class="form-control " id="addr2" name="addr"><?php echo $vendor['addr'] ?></textarea>
									<div id="results-addr2" class="results error"></div>
									<div id="errorcontainer-addr2" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>City <span class="mandatory">*</span></label>
									<input name="city" type="text" autocorrect="off" autocapitalize="none" id="city" value="<?php echo $vendor['city'] ?>" class="form-control " />
									<div id="results-city" class="results error"></div>
									<div id="errorcontainer-city" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>State <span class="mandatory">*</span></label>
									<input name="state" type="text" autocorrect="off" autocapitalize="none" id="state" value="<?php echo $vendor['state'] ?>" class="form-control " />
									<div id="results-state" class="results error"></div>
									<div id="errorcontainer-state" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>Zip <span class="mandatory">*</span></label>
									<input type="number" name="zip" id="zip" value="<?php echo $vendor['zip'] ?>" class="form-control " />
									<div id="results-zip" class="results error"></div>
									<div id="errorcontainer-zip" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>Country <span class="mandatory">*</span></label>
									<?php $vvk = $vendor['country']; ?>
									<select name="country" class="form-control ">
										<?php
											$jm = $this->db->query('select * from countries')->result_array();
											foreach($jm as $re => $pp ){
										 ?>
											  <option   <?php if( $vvk == $pp['country_code'] ){ ?>  selected <?php } ?>   value="<?php echo $pp['country_code']; ?>"><?php echo $pp['country_name']; ?></option>
										 <?php } ?>
									</select>
							</div>
							<div class="form-group">
									<label>Contact Number <span class="mandatory">*</span></label>
									<input name="contact_number" type="text" autocorrect="off" autocapitalize="none" id="contact_number" data-inputmask="'mask': ['(999)-999-9999']" value="<?php echo $vendor['contact_number'] ?>" class="form-control " required />
									<div id="errorcontainer-contact_number" class='errorDiv'></div>
							</div>
							<div class="form-group">
									<label>E-mail Address <span class="mandatory">*</span></label><br />
									<input name="vendor_email" type="email" autocorrect="off" autocapitalize="none" id="email" value="<?php echo $vendor['email'] ?>" class="form-control " />
									<div id="results-email" class="results error"></div>
									<div id="errorcontainer-email" class='errorDiv'></div>
							</div>
							 <div class="box-footer">
								<input type="submit" name="update_vendor" value="Submit" class="btn btn-primary">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button name="cancel" class="btn btn-warning" onclick="goBack()">Cancel</button>
							</div>
							<?php
							}
							?>
									</div><!-- /.box-body -->
								
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
function goBack() {
    window.history.back();
}
</script>
<?$this->layout->block()?>