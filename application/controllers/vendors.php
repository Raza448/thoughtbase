<?php

class Vendors extends CI_Controller {

    // Layout used in this controller

	public $layout_view = 'layout/default';

	

	function __construct() {

	      parent::__construct();

		  $this->load->library('layout');

		  $this->load->helper('url');
		  $this->load->model('client');
		  $this->load->library('session');

		  $this->lang->load('message', 'english');

		  $this->load->helper('event');

		  //checking user session if not redirect to login

		  if(!$this->session->userdata('vendorAuth')){

		    redirect('main/vendorLogin');

		  }

	}

 

	//edit client user profile

	public function profile() {
	
	      $this->load->model('vendor');

		  $vendor_data = $this->vendor->getVendorById($this->session->userdata('vendor_id'));

 		 if($this->input->post()){

		   //checking post for changepassword

		    if( $this->input->post('act') == 'changepassword' ){

			  	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

                if($this->form_validation->run() == FALSE){

				 //form validation failed         

				}else{

				  $this->vendor->updateVendorUser($this->session->userdata('vendor_id'),array('password'=>base64_encode(mysql_real_escape_string($this->input->post('password')))));

				  $this->session->set_flashdata('success',$this->lang->line('account_edit'));

				  redirect('vendors/profile');

				}

		    }

			

			if( $this->input->post('act') == 'editaccount' ){

				  $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');

				  $this->form_validation->set_rules('company', 'Company Name', 'trim|required');

				  $this->form_validation->set_rules('uen', 'Business Registration Number', 'trim|required');

				  $this->form_validation->set_rules('userName', 'Username', 'trim|required');

				if($this->form_validation->run() == FALSE){

				  //form validation failed   

				}else{

			      //check this email address exists

				   $res = $this->vendor->emailDuplication($this->session->userdata('vendor_id'),mysql_real_escape_string($this->input->post('email')));

				  if(count($res) > 0 ){

				    $this->session->set_flashdata('error',$this->input->post('email')." - ".$this->lang->line('email_exists'));

				    redirect('clients/profile');

				  }else{
				 // echo $this->input->post('userName');

				   $this->vendor->updateVendor($this->session->userdata('vendor_id'),

				   array('contact_number'=>mysql_real_escape_string($this->input->post('contact_number')),'company_name'=>mysql_real_escape_string($this->input->post('company')),'uen'=>mysql_real_escape_string($this->input->post('uen')),'name'=>mysql_real_escape_string($this->input->post('userName')), 'fname'=>mysql_real_escape_string($this->input->post('fname')), 'lname'=>mysql_real_escape_string($this->input->post('lname')), 'city'=>mysql_real_escape_string($this->input->post('city')), 'state'=>mysql_real_escape_string($this->input->post('state')), 'zip'=>mysql_real_escape_string($this->input->post('zip')), 'country'=>mysql_real_escape_string($this->input->post('country')), 'addr'=>mysql_real_escape_string($this->input->post('addr'))));
				   
				   $this->vendor->updateVendorEmail($this->session->userdata('vendor_id'),mysql_real_escape_string($this->input->post('vendor_email')));
				   

				   $this->session->set_flashdata('success',$this->lang->line('account_edit'));

				   redirect('vendors/profile');

				  }

				}		

			}

		   //end of password change check

		  }

	      $this->layout->title('Edit Profile');

		  $this->layout->view('vendor_profile',array('result' => $vendor_data[0]));

	}

	

    public function dashboard(){

	    $this->load->model('vendor');

		$this->show = 1;

	    $vendor = $this->vendor->getVendorById($this->session->userdata('vendor_id'));

		if(!count($vendor) > 0 ){

		    redirect('main/index');

		}

		//get live campaigns

		$date = strtotime(date('Y-m-d'));

		$out = $this->db->query('select * from survey_temp where user_id ='.$this->session->userdata('vendor_id').' and paid=1 order by id desc limit 0,1')->result_array();

		$survey = array();

		if(count($out) > 0 ){

		  redirect('vendors/view_survey/'.$out[0]['id']);

		  $i =0;

		  foreach($out as $bro => $kar){

		    $survey[$i]['name'] =$kar['name'];

			$rtsz = 'SELECT * FROM clients_survey WHERE survey_id ='.$kar['id'];

		    $retp = $this->db->query($rtsz)->result_array();

			$survey[$i]['sent'] =count($retp);

			$rtsz1 = 'SELECT * FROM completed_survey WHERE survey_id ='.$kar['id'];

		    $retp1 = $this->db->query($rtsz1)->result_array();

			$survey[$i]['attended'] =count($retp1);

			if($survey[$i]['attended'] > 0 ){

			  $survey[$i]['per'] = ($survey[$i]['sent']/$survey[$i]['attended'])*100;

			}else{

			  $survey[$i]['per'] = 0;

			}

			

			//calculating male percantage

			

			

			

			

			

		  }

		  $i++;

		}

		

		$this->load->model('event');

		$data['data'] = $this->event->loadPosts();

	    $this->layout->title('My Dashboard');

	    $this->layout->view('vendor_only/vendor_dashboard',array('profile'=>$vendor[0],'result' => $data['data'],'survey' => $survey )); 

    }	

	

	public function vendorProfile(){

	    $this->load->model('vendor');

	    $vendor = $this->vendor->getVendorById($this->session->userdata('vendor_id'));

		if(!count($vendor) > 0 ){

		    redirect('main/index');

		}

		

		$vct = $this->vendor->vendorCatType();

		$vc  = $this->vendor->vendorCat();

				

	    $this->layout->title('Profile');

	    $this->layout->view('vendor_only/vendor_profile',array('profile'=>$vendor[0],'ctype'=>$vct,'cat'=>$vc)); 

    }	

	

	public function logoupload(){

	  if(isset($_POST['act']) && $_POST['act'] == 'logo'){

	     if(isset($_FILES['logo']['name']) && $_FILES['logo']['name']!="" ){

		    $ext = strtolower(end(explode('.',$_FILES['logo']['name'])));

			$et  = array('png','gif','jpg','jpeg');

		    if(!in_array($ext,$et))

			{

			    $this->session->set_flashdata('error',$this->lang->line('image_empty'));

			    redirect('vendors/vendorProfile');

			}

			else

			{

			   if( $_POST['pre_logo'] !=""){

			     @unlink(SITE_ROOT.'/uploads/vendor/'.$_POST['pre_logo']);

			   }

			   $name = time().$_FILES['logo']['name'];

			   $this->load->model('vendor');

			   $this->vendor->updateVendor($this->session->userdata('vendor_id'),array('logo' => $name ));

			   move_uploaded_file($_FILES["logo"]["tmp_name"], SITE_ROOT.'/uploads/vendor/'.$name );

			   $this->session->set_flashdata('success',$this->lang->line('image_upload'));

			   redirect('vendors/vendorProfile');   

			}	 

		 }

		 else

		 {

		    $this->session->set_flashdata('error',$this->lang->line('image_empty'));

			redirect('vendors/vendorProfile');

		 

		 }

		 

		 

		 

		 

	  }  

	}

	

	public function updatepro(){

	  if(isset($_POST)){

	  

	     if($_POST['catType']=="" || (!isset($_POST['cat'])) || (isset($_POST['cat'][0]) && $_POST['cat'][0] ==""  )  ){

		   $this->session->set_flashdata('error',$this->lang->line('vendor_cat_mess'));

		   redirect('vendors/vendorProfile');

		   exit;

		 }

	  

	     $this->load->model('vendor');

		 $vendor_cat_type = $_POST['catType'];

		 $vendor_cat = $_POST['cat'];

		 

		 $this->vendor->deleteVendorCatList($this->session->userdata('vendor_id'));

		 

     	 foreach($vendor_cat as $row => $val ){

		   

		   $this->vendor->insertVendorCatList(array('vendor_id'=> $this->session->userdata('vendor_id'),'category_id' => $val ));

		 }

		 

		 unset($_POST['catType']);

		 unset($_POST['cat']);

		 

		 $this->vendor->updateVendor($this->session->userdata('vendor_id'),$_POST);

	     $this->session->set_flashdata('success',$this->lang->line('image_empty'));

		}	

		redirect('vendors/vendorProfile');

			

	}

	

	

	 public function ajaxSubCat(){

 		  $options ='<option value=""></option>';

	      if(isset($_POST['id'])  && $_POST['id'] > 0  ){

		     $this->load->model('vendor');

		     $sub_events = $this->vendor->vendorCatId($_POST['id']);

			 

			  $this->load->database();

			  $out = $this->db->query('select vendor_cat_list.*,vendor_categories.*,vendor_category_types.* from vendor_cat_list 

			  left join vendor_categories on category_id = vc_id

			  left join vendor_category_types on vc_parent = cat_id

			  where vendor_id='.$this->session->userdata('vendor_id'));

			  $res = $out->result_array();

			  $dim =array();

			  if(count( $res > 0 )){

			    if(isset($res[0]['vc_parent']) == $_POST['id'] ){

				  foreach($res as $key => $val ){

				    $dim[] = $val['vc_id'];

                  }				  			

				}

			  }

			  

			 

			 if(count($sub_events) > 0 ){

			   foreach($sub_events as $row => $val){

			     if(in_array($val['vc_id'],$dim)){

				  $options .='<option value="'.$val['vc_id'].'" selected >'.$val['vc_name'].'</opion>';

				 }else{

			      $options .='<option value="'.$val['vc_id'].'">'.$val['vc_name'].'</opion>';

				}

			   }

			 }

		  }

		  echo $options;

	   }

	   

	   

	   

	  public function glogoupload(){

	  if(isset($_POST['act']) && $_POST['act'] == 'logo'){

	   

	     

	  

	  

	     if(isset($_FILES['logo']['name']) && count($_FILES['logo']['name']) > 0 ){

		 

		    for($i=0;$i< count($_FILES['logo']['name']) ; $i++ ){

		 

		    $ext = strtolower(end(explode('.',$_FILES['logo']['name'][$i])));

			$et  = array('png','gif','jpg','jpeg');

		    if(!in_array($ext,$et))

			{

			   

			}

			else

			{

			   $name = time().$_FILES['logo']['name'][$i];

			   $this->load->model('vendor');

			   $this->vendor->updateVendorImages( array('vendor_id'=>$this->session->userdata('vendor_id'),'image' => $name ));

			   move_uploaded_file($_FILES["logo"]["tmp_name"][$i], SITE_ROOT.'/uploads/vendor/'.$name );

			     

			}	



         

          }//end of loop

		       $this->session->set_flashdata('success',$this->lang->line('image_upload'));

			   redirect('vendors/vendorProfile');

			

		 }

		 else

		 {

		    $this->session->set_flashdata('error',$this->lang->line('image_empty'));

			redirect('vendors/vendorProfile');

		 

		 }

		 

		 

		 

		 

	  } else{

	    	redirect('vendors/vendorProfile');

	  } 

	}

	

	public function delimg($id=0){

	  if($id > 0){

	    $this->load->model('vendor');

		$out = $this->vendor->getVendorImages($this->session->userdata('vendor_id'),$id);

		if(isset($out[0]['image']) && $out[0]['image'] !="" ){

		  @unlink(SITE_ROOT.'/uploads/vendor/'.$out[0]['image']);

		}

		

		

		$this->vendor->deleteVendorImages($this->session->userdata('vendor_id'),$id);

		$this->session->set_flashdata('success',$this->lang->line('image_deleted'));

	    redirect('vendors/vendorProfile');

	  }else{

	    redirect('vendors/vendorProfile');

	  }

	}

	

	

	

	

	 public function deactivate(){

	       

		/*--------------------------------------------------------------------------------------------------------------*/

			         $this->load->model('vendor');

		             $res = $this->vendor->getVendorById($this->session->userdata('vendor_id'));

					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $res[0]['email'];

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage =  $this->load->view('deact_message',array('name'=>$res[0]['name']), true );

	                 $mail = new PHPMailer();

	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = 'Thoughtbase.com - Your Account Deactivated successfully';

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();					 

		/*--------------------------------------------------------------------------------------------------------------*/

		   

		   $this->db->query('update  users set disable_flag = 1, deact=1 where id='.$this->session->userdata('vendor_id'));

		   $this->session->sess_destroy();

		   $this->session->set_flashdata('success','Your account deactivated successfully');

		   redirect('main/clientLogin');

	  }

	  

	  public function create(){
	  
	    $check_fields = $this->db->query('select * from site_meta_setting where meta_key="validate_fields"')->row_array();
		$text = $check_fields['meta_value'];
		
		$val_fields = $this->session->set_userdata('check_text', $text);

	    //create survey 1
		
		//print_r($this->session->all_userdata());
		
   	    $this->form_validation->set_rules('title', 'Query title', 'trim|required');

		$this->form_validation->set_rules('description', 'description', 'trim|required');

		if($this->form_validation->run() == FALSE){

		//form validation failed   

		}else{

		

   

		   if($this->session->userdata('survey_id')){

		     $survey_id = $this->session->userdata('survey_id');

			 $this->db->query('update survey_temp set name= "'.mysql_real_escape_string($this->input->post('title')).'",description ="'.mysql_real_escape_string($this->input->post('description')).'" where id ='.$survey_id);

		   }else{

		     $this->db->query('insert into survey_temp (id,name,description,user_id) values(null,"'.mysql_real_escape_string($this->input->post('title')).'","'.mysql_real_escape_string($this->input->post('description')).'",'.$this->session->userdata('vendor_id').')');

		     $survey_id = $this->db->insert_id();		   

		   }

		   

		   $this->db->query('update survey_images set survey ='.$survey_id.' where token ="'.$this->input->post('token').'"');

		   $this->session->set_userdata(array('step1'=>'1','survey_id'=>$survey_id));

		   //set session for step 1 completion & survey id

		   //redirect(site_url('vendors/create_step2'));
		   
		   if(isset($_POST['template']) && $_POST['template'] !="" ){

		  $this->form_validation->set_rules('template', 'template', 'trim|required');

		  if( $_POST['template']  == 4 ){

		    $this->db->query('update survey_temp set template= "'.mysql_real_escape_string($this->input->post('template')).'" , question="'.mysql_real_escape_string($this->input->post('question')).'" where id ='.$this->session->userdata('survey_id'));

		    $this->form_validation->set_rules('question', 'question', 'trim|required');

		  }

		  if($this->form_validation->run() == FALSE){

		    //form validation failed   

		    	  

		  }else{

		    $this->db->query('update survey_temp set template= "'.mysql_real_escape_string($this->input->post('template')).'"   where id ='.$this->session->userdata('survey_id'));

		    $this->session->set_userdata(array('step1'=>'1'));

		    //set session for step 1 completion & survey id

		    redirect(site_url('vendors/create_step3'));

		  }

		  

		  

		  }

		}
		$out = $this->db->query('select * from survey_category')->result_array();

		   if(count($out) == 0 ){

		     redirect(base_url());

           }	

		$this->layout->title('Create Query - Step 1');

	    $this->layout->view('vendor_only/create1', array('result'=>$out));

	  }

	  

	  

	  public function create_step2(){

	    if($this->session->userdata('step1')){

		

		  if(isset($_POST['template']) && $_POST['template'] !="" ){

		  $this->form_validation->set_rules('template', 'template', 'trim|required');

		  if( $_POST['template']  == 4 ){

		    $this->db->query('update survey_temp set template= "'.mysql_real_escape_string($this->input->post('template')).'" , question="'.mysql_real_escape_string($this->input->post('question')).'" where id ='.$this->session->userdata('survey_id'));

		    $this->form_validation->set_rules('question', 'question', 'trim|required');

		  }

		  if($this->form_validation->run() == FALSE){

		    //form validation failed   

		    	  

		  }else{

		    $this->db->query('update survey_temp set template= "'.mysql_real_escape_string($this->input->post('template')).'"   where id ='.$this->session->userdata('survey_id'));

		    $this->session->set_userdata(array('step2'=>'1'));

		    //set session for step 1 completion & survey id

		    redirect(site_url('vendors/create_step3'));

		  }

		  

		  

		  }

		  //fetching survey categories

		   $out = $this->db->query('select * from survey_category')->result_array();

		   if(count($out) == 0 ){

		     redirect(base_url());

           }		   

		  

		   $this->layout->title('Create Query - Step 2');

	       $this->layout->view('vendor_only/create2',array('result'=>$out));

		}else{

		  redirect('vendors/create');

		}

	  }

	  

	  

	  

	  public function create_step3(){
		
	     if($this->session->userdata('step1')){

		   //checking post 

		   if(isset($_POST['step3']) && $_POST['step3'] == 'step3' ){
		   
		   if($_POST['custom_users'] == 2)
		   {
				
				$this->session->set_userdata(array('emails' => $_POST['description']));
				
				$custom_amount      = mysql_real_escape_string($_POST['custom_kk_am']);

				$custom_user_amount = mysql_real_escape_string($_POST['custom_kk_am_user']);
				
				$this->session->set_userdata(array('amount' => $_POST['custom_kk_am']));
				
				$this->db->query("update survey_temp set age='".$age."',gender='".$gender."',miles='".$miles."',zipcode='".$zipcode."' ,amount='".$custom_amount."', user_amount='".$custom_user_amount."', created_on='".date('Y-m-d')."' , interest='".$interest."' where id =".$this->session->userdata('survey_id'));
				
				$this->session->set_userdata(array('step2'=>'1'));  
				redirect('vendors/create_step4');
				
		   }
		   else
		   {

		    $age         = mysql_real_escape_string($_POST['age']);

			$gender      = mysql_real_escape_string($_POST['gender']);

			$miles       = mysql_real_escape_string($_POST['miles']);

			$zipcode     = mysql_real_escape_string($_POST['zipcode']);

			$amount      = mysql_real_escape_string($_POST['kk_am']);

			$user_amount = mysql_real_escape_string($_POST['kk_am_user']);

			if( isset($_POST['interest']) && count($_POST['interest']) > 0 ){

			  $interest  = implode('#',$_POST['interest']);

		    }else{

			  $interest  = '';

			}

			 $this->db->query("update survey_temp set age='".$age."',gender='".$gender."',miles='".$miles."',zipcode='".$zipcode."' ,amount='".$amount."', user_amount='".$user_amount."', created_on='".date('Y-m-d')."' , interest='".$interest."' where id =".$this->session->userdata('survey_id'));

             $this->session->set_userdata(array('step2'=>'1'));  

		     redirect('vendors/create_step4');

		   }
		  }

	 

    	  $this->layout->title('Create Query - Step 2');

		  $out = $this->db->query('select users.id as uid,user_interest.user_id as did,user_interest.interest from users left join user_interest on user_interest.user_id = users.id where isadv = 0 and disable_flag = 0 group by users.id')->result_array();

	      $this->layout->view('vendor_only/create3',array('tot'=>count($out)));	 

		 }else{

		  redirect('vendors/create_step2');

		}

	  }







	   public function create_step4(){

	   	  $this->error  ='';

	     if($this->session->userdata('step2')){

	 	   

          if(isset($_POST['step4']) && $_POST['step4'] == 'step4' ){
		  
			if($this->session->userdata('emails')) {
				
				$email_data = $this->session->userdata('emails');
			
				$desc = explode("\n", $email_data);
				$emails = count($desc);
				$clients = "";
				for($i=0;$i<$emails;$i++)
				{
					$check_email = trim($desc[$i]);
					$token = $desc[$i];
					$date = date('Y-m-d H:i:s');
					/* $username = explode("@", $check_email);
					$pass = base64_encode($r); */
					if($check_email != "")
					{
					  $sql = "SELECT * FROM users WHERE email='".$check_email."'";
					  $out_email = $this->db->query($sql)->row_array();
					  if($out_email){
						// existing customer ids
					    $uid = $out_email['id'];
					    $clients[] = array("uid" => $uid);
					}else{
					    
						$ins_user = "INSERT INTO users SET email='$check_email', register_date='$date', token='$token', isadv='0', disable_flag='0', profile='0'";
						$this->db->query($ins_user);
						
						// new customer ids
						$uid = $this->db->insert_id();
						
						$clients[] = array("uid" => $uid);
						$clientData = array('user_id'=>$uid);

						$this->client->insertClientTable($clientData);
					}
					}
					
					// store in session in json string to use in step4
				}
				$this->session->set_userdata(array('clients' => json_encode($clients)));
				
				$this->session->unset_userdata('emails');
				$this->session->unset_userdata('amount');
				
			}

				$this->form_validation->set_rules('customer_first_name', 'first name', 'trim|required');

				$this->form_validation->set_rules('customer_last_name', 'Last name', 'trim|required');

				$this->form_validation->set_rules('customer_credit_card_type', 'Card Type', 'trim|required');

				$this->form_validation->set_rules('customer_credit_card_number', 'Card number', 'trim|required');

				$this->form_validation->set_rules('cc_expiration_month', 'Expiration Year', 'trim|required');

				$this->form_validation->set_rules('cc_expiration_year', 'Expirtaon Year', 'trim|required');

				$this->form_validation->set_rules('cc_cvv2_number', 'CVV number', 'trim|required');

				$this->form_validation->set_rules('customer_address1', 'Address', 'trim|required');

				$this->form_validation->set_rules('customer_city', 'City', 'trim|required');

				$this->form_validation->set_rules('customer_state', 'State', 'trim|required');

				$this->form_validation->set_rules('customer_zip', 'zipcode', 'trim|required');

				$this->form_validation->set_rules('customer_country', 'Country', 'trim|required');

				$this->form_validation->set_rules('example_payment_amuont', 'Amount', 'trim|required');

				

                if($this->form_validation->run() == FALSE){

				 //form validation failed         

				}else{
				
				$paymentType = urlencode('Sale');				// 'Authorization' or 'Sale'

				$firstName = urlencode($_POST['customer_first_name']);

				$lastName         = urlencode($_POST['customer_last_name']);

				$creditCardType   = urlencode($_POST['customer_credit_card_type']);

				$creditCardNumber = urlencode($_POST['customer_credit_card_number']);

				$expDateMonth = $_POST['cc_expiration_month'];

				//Month must be padded with leading zero

				$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));

				$expDateYear  = urlencode($_POST['cc_expiration_year']);

				$cvv2Number   = urlencode($_POST['cc_cvv2_number']);

				$address1     = urlencode($_POST['customer_address1']);

				//$address2 = urlencode($_POST['customer_address2']);

				$city       = urlencode($_POST['customer_city']);

				$state      = urlencode($_POST['customer_state']);

				$zip        = urlencode($_POST['customer_zip']);

				$country    = urlencode($_POST['customer_country']);// US or other valid country code

				$amount     = urlencode($_POST['example_payment_amuont']);

				$currencyID = urlencode('USD');	

				//Add request-specific fields to the request string.

				$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".

							"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".

							"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";

				// Execute the API operation; see the PPHttpPost function above.

				$httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);


				if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

					//direct to dashboard

					$this->session->unset_userdata('step1');

					$this->session->unset_userdata('step2');

					$this->session->unset_userdata('step3');                

                    //insert surve details

                   	$this->db->query("update survey_temp set paid=1 where id =".$this->session->userdata('survey_id'));

            		$this->session->set_flashdata('success','Your payment was successfull and your query created successfully');

                    //inserting in to client survey table
					//$cout = $this->db->query($this->session->userdata('sql'))->result_array();
					$cout = json_decode($this->session->userdata('clients'),true);
					
					$business = $this->db->query("select * from vendors where user_id='".$this->session->userdata('vendor_id')."'")->row_array();
		
					$name =  $business['name'];
					
					if(count($cout) > 0){

					  foreach($cout as $row => $kavl){
					  
					   $this->db->query('insert into clients_survey(id,user_id,survey_id,created_on) values(null,'.$kavl['uid'].','.$this->session->userdata('survey_id').',"'.date('Y-m-d').'")'); 

					   $user_out = $this->db->query("select * from users where id='".$kavl['uid']."' and isadv='0'")->row_array();
					 
					 
					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = mysql_real_escape_string($user_out['email']);

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;
					 
					 $bodyOfMessage = $this->load->view( 'survey_message', array('name'=>$name, 'id'=>$kavl['uid']), true );
	                 
					 $mail = new PHPMailer();

	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "New Query from ". $name."";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

					  }

					}

					$this->session->unset_userdata('survey_id');

                    redirect('vendors/dashboard');

 				}else{

					$this->error = urldecode($httpParsedResponseAr['L_LONGMESSAGE0']);

				}
			 }
  }

    	   $this->layout->title('Create Query - Step 3');   	   

	       $this->layout->view('vendor_only/create4');	 

		 }else{

		  redirect('vendors/create_step3');

		}

	  }

	  public function remove_image($id=0){

	    if( $id > 0 ){

		 //check

		  $data_img = $this->db->query('select * from survey_images where id ='.$id)->result_array();  

		  if( count($data_img) > 0 ){

		    if($data_img[0]['survey'] == $this->session->userdata('survey_id') ){

			  $this->db->query('delete from survey_images where  id ='.$id);

			  @unlink(SITE_ROOT.'assets/fineupload/server/files/'.$data_img[0]['folder'].'/'.$data_img[0]['image']);

			  $this->session->set_flashdata('success','Image deleted successfully');		

			}

		  }

		}

		redirect('vendors/create');

	  }

	  function PPHttpPost($methodName_, $nvpStr_) {

	  global $environment;

	  // Set up your API credentials, PayPal end point, and API version.

	  //$API_UserName  = urlencode('sdk-three_api1.sdk.com');//set your spi username

	  //$API_Password  = urlencode('QFZCWN5HZM8VBG7Q');//set your spi password

	  //$API_Signature = urlencode('A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI'); //set your spi Signature

	  $API_UserName  = urlencode('testerz_api1.gmail.com');//set your spi username

	  $API_Password  = urlencode('GY95C8GTDKCE2LKC');//set your spi password

	  $API_Signature = urlencode('Ah5uOOkZ9rndm3rkroenMoLxt4VbA.Ks.JOalqVSgPP.wXsancsbylXe'); //set your spi Signature

	

	  $API_Endpoint = "https://api-3t.paypal.com/nvp";

      $API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";



	  $version = urlencode('51.0');

	  // Set the curl parameters.

	  $ch = curl_init();

	  curl_setopt($ch, CURLOPT_URL, $API_Endpoint);

	  curl_setopt($ch, CURLOPT_VERBOSE, 1);

	  // Turn off the server and peer verification (TrustManager Concept).

	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	  curl_setopt($ch, CURLOPT_POST, 1);

	  // Set the API operation, version, and API signature in the request.

	  $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

	  // Set the request as a POST FIELD for curl.

      curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

	  // Get response from the server.

	  $httpResponse = curl_exec($ch);

	  if(!$httpResponse) {

		exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');

	  }

	  // Extract the response details.

	  $httpResponseAr = explode("&", $httpResponse);

	  $httpParsedResponseAr = array();

	  foreach ($httpResponseAr as $i => $value) {

		$tmpAr = explode("=", $value);

		if(sizeof($tmpAr) > 1) {

			$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];

		}

	  }

 

	  if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {

		exit("There was an error processing your payment <a href='".site_url('vendors/create_step4')."'>Click here</a>");

	  }

	  return $httpParsedResponseAr;

     }

	 

	 

	 public function view_survey($id=0){
	 
		$check_fields = $this->db->query('select * from site_meta_setting where meta_key="validate_fields"')->row_array();
		$text = $check_fields['meta_value'];
		$val_fields = $this->session->set_userdata('check_text', $text);

	    $this->id = $id;

		$this->show  = '1';

	    $this->load->model('vendor');

	    $vendor = $this->vendor->getVendorById($this->session->userdata('vendor_id'));



		$rtsz =   'SELECT * FROM clients_survey WHERE survey_id ='.$id;

		$retp =   $this->db->query($rtsz)->result_array();

		$this->sent =   count($retp);

		$rtsz1 =  'SELECT * FROM completed_survey WHERE survey_id ='.$id;

		$retp1 =  $this->db->query($rtsz1)->result_array();

		$this->attended = count($retp1);

		if($this->attended > 0 ){

		  $this->per = ($this->sent/$this->attended)*100;

		}else{

		  $this->per = 0;

		}

		

		if(!count($vendor) > 0 ){

		    redirect('main/index');

		}

		//pull survey details

		$zz_res = $this->db->query('select * from survey_temp where id='.$id.' and user_id ='.$this->session->userdata('vendor_id'))->result_array();

		if( count($zz_res) == 0 ){

		   redirect('main/index');

		}

	    $this->layout->title('My Campaigns');

	    $this->layout->view('vendor_only/campaign',array('result' => $zz_res[0] )); 	 

	 }

	 

	 

	 public function back(){

		$this->session->unset_userdata('step1');

		$this->session->unset_userdata('step2');

		$this->session->unset_userdata('step3');                

		$this->session->unset_userdata('survey_id');

        redirect('vendors/dashboard'); 

	 }
}