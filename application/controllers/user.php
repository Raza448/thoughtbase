<?php
class User extends CI_Controller {
    // Layout used in this controller
	public $layout_view = 'layout/default';
	
	function __construct() {
	      parent::__construct();
		  $this->load->library('layout');
		  $this->load->helper('url');
		  $this->load->helper('setting');
		  $this->load->library('session');
		  $this->lang->load('message', 'english');
		  $this->load->helper('event');
	}
 
	//edit client user profile
	public function profile(){
	
		$check_fields = $this->db->query('select * from site_meta_setting where meta_key="validate_fields"')->row_array();
		$text = $check_fields['meta_value'];
		$val_fields = $this->session->set_userdata('check_text', $text);
	
		if( $this->session->userdata('vendorAuth')){
		   redirect('business/dashboard');
		}
		
		$password_change = "";
		if(!empty($_GET['id']))
		{
			$id = base64_decode($_GET['id']);
			$token = base64_decode($_GET['token']);
			$out = $this->db->query("SELECT * FROM users WHERE id='$id' and token='$token'")->row_array();
			if(!empty($out))
			{
				$this->session->set_userdata('clientAuth', true);
				$this->session->set_userdata('client_id', $id);
			}
		}
   	      //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect(site_url());
		  } 
		  
	      $this->load->model('client');
		  $client_data = $this->client->getClientById($this->session->userdata('client_id'));
		  
		   //checking post for changepassword
		    if( $this->input->post('act') == 'changepassword' ){
			  	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
                if($this->form_validation->run() == FALSE){
				 //form validation failed         
				}else{
				  $this->client->updateClientUser($this->session->userdata('client_id'),array('password'=>base64_encode(mysql_real_escape_string($this->input->post('password')))));
				  $password_change = "Password Changed Succesfully.";
				  $this->session->set_flashdata('success',$this->lang->line('account_edit'));
				 // redirect('user/Profile');
				}
		    }
			
			if(isset($_POST['submit'])){
			   $qui = "delete from  user_interest where user_id =".$this->session->userdata('client_id');
			   $this->db->query($qui);
			   if(!empty($_POST['new_customer'])){
				$password = mysql_real_escape_string(base64_encode($this->input->post('new_password')));
			   }else{
				$password = mysql_real_escape_string(base64_encode($this->input->post('password')));
			   }
			   
			   if(isset($_POST['interest']))
			   {
			   if(count($_POST['interest']) > 0){
				 foreach($_POST['interest'] as $row => $val ){
					   $qu = "INSERT INTO user_interest VALUES(null,".$this->session->userdata('client_id').",".$val.")";
					   $this->db->query($qu);
				 }
			   }
			   }
			    $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
				$this->form_validation->set_rules('zipcode', 'zipcode', 'trim|required|integer');
				if(isset($_GET['id']) && isset($_GET['token']))
				{
				   if(!empty($_POST['new_customer'])){
					$this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[5]');
					$this->form_validation->set_rules('re_pass', 'Password Confirmation', 'trim|required|matches[new_password]');
					$this->form_validation->set_rules('username', 'Username', 'trim|required');
				   }else{
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
					$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
				   }
				}
				if($this->form_validation->run() == FALSE){
				  //form validation failed   
				  $client_data[0]['email'] = mysql_real_escape_string($this->input->post('email'));
				  $client_data[0]['contact_number'] = mysql_real_escape_string($this->input->post('contact_number'));
				  $client_data[0]['zip_code'] = mysql_real_escape_string($this->input->post('zip_code'));
				 
				}else{
			      //check this email address exists
				  $res = $this->client->emailDuplication($this->session->userdata('client_id'),mysql_real_escape_string($this->input->post('email')));
				  if(count($res) > 0 ){
				    $this->session->set_flashdata('error',mysql_real_escape_string($this->input->post('email'))." - ".$this->lang->line('update_email_exists'));
				    redirect('user/Profile');
				  }else{
					$this->client->updateClientUser($this->session->userdata('client_id'),array('age'=>mysql_real_escape_string($this->input->post('age')),'email'=>mysql_real_escape_string($this->input->post('email')),'username'=>mysql_real_escape_string($this->input->post('username')),'password'=>$password,'token'=>'','gender'=>mysql_real_escape_string($this->input->post('gender')),'profile'=>'1','zipcode'=>mysql_real_escape_string($this->input->post('zipcode'))));
					$this->client->updateClient($this->session->userdata('client_id'),array('contact_number'=>mysql_real_escape_string($this->input->post('contact_number'))));
					$this->session->set_flashdata('success',$this->lang->line('account_edit'));
				    if(isset($_GET['id']) && isset($_GET['token']))
					{
						redirect('user/myQueries');
					}
					else
					{
						redirect('user/Profile');
					}
				  }
				}
			
		   //end of password change check
		  }
          $this->layout->title('Edit Profile');
		  $this->layout->view('client_profile',array('result' => $client_data[0], 'password' => $password_change));
	}	
	
	function check_username($username)
		{
			//$username is passed automatically to this function which is the value entered by the User.
			$id = $this->session->userdata('client_id');
			//This function checks the availability of the username in Database.
			$return_value = $this->db->query("SELECT * FROM users WHERE username='$username' and id !='$id'")->result_array();
			if (count($return_value) > 0)
			{
				  //set Error message.
				  $this->form_validation->set_message('check_username', 'This username is already Exist.Please type another one');
				  return FALSE;
			}
			else
			{
				  //after satisfying our conditions return TRUE to the origin with no errors.
				  return TRUE;
			}
		}
	
	
	 public function myQueries($id = 0){
	    $check_fields = $this->db->query('select * from site_meta_setting where meta_key="validate_fields"')->row_array();
		$text = $check_fields['meta_value'];
		$val_fields = $this->session->set_userdata('check_text', $text);
		
	    $this->id =$id;
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect(base_url());
		  }
		  //checking user post
		  if( isset($_POST['temp']) && $_POST['temp'] > 0 ){
			  
		    $survey = $_POST['sid'];
			
			$amount = mysql_real_escape_string($_POST['amount']);
			$template = mysql_real_escape_string($_POST['temp']);
			$name   = mysql_real_escape_string($_POST['sname']);
			$survey = mysql_real_escape_string($_POST['sid']);
			
			unset($_POST['sid']);
			unset($_POST['amount']);
			unset($_POST['temp']);
			unset($_POST['sname']);
			
		    
			//transfer amount to user email address
			
			//get client email address
			$out_id = $this->db->query('select * from users where id='.$this->session->userdata('client_id'))->result_array(); 
			$cemail = $out_id[0]['email'];
			$payLoad=array();
			
			//If survey is not completed
			$query = 'select * from completed_survey where survey_id ='.$survey.' and user_id='.$this->session->userdata('client_id');
			//echo $query;
			$check_survey = $this->db->query($query)->result_array();
			//print_r($check_survey);
			//echo count($check_survey);
			if(count($check_survey)==0){
				$completed = 0;
				$rs = $this->db->query('insert into completed_survey (user_id,survey_id) values ('.$this->session->userdata('client_id').','.$survey.')');
				if( $template == 4 )
			{ 
			    $ans =  htmlspecialchars(mysql_real_escape_string($_POST['single_question']));
				
				$this->db->query('insert into client_answes (client_id,survey_id,comment)
 				values ('.$this->session->userdata('client_id').','.$survey.',"'.$ans.'")');
			   
			}
			else
			{ 
			   unset($_POST['type']);  
			   unset($_POST['captcha']);  
			   unset($_POST['ocaptcha']);  
			   unset($_POST['captcha1']);  
			   unset($_POST['ocaptcha1']);  
			   if( count($_POST) > 0 ){
				   //print_r($_POST);exit;
			    foreach($_POST as $row => $val ){
				if($val != ""){
				 
                if(ctype_digit($val)){				 
				   $this->db->query('insert into client_answes (client_id,survey_id,question_id,answer_id,comment)
 				   values ('.$this->session->userdata('client_id').','.$survey.','.$row.','.htmlspecialchars(mysql_real_escape_string($val)).',"")');
				 }else{
				   $this->db->query('insert into client_answes (client_id,survey_id,question_id,comment)
 				   values ('.$this->session->userdata('client_id').','.$survey.','.$row.',"'.htmlspecialchars(mysql_real_escape_string($val)).'")');
				 
				 }
				  
				  
				  }
				} //end of foreach
			   }
			   
			}
				if($rs){
					$completed = 1;
					$query = 'update clients_survey set completed = 1 where user_id = '.$this->session->userdata('client_id').' and survey_id ='.$survey;
					$this->db->query($query);
				}
				
				if($completed){
						
					if($this->getMetaValue("env_mode") == '1' || $this->getMetaValue("env_mode") == 1){
						$ppuserid = $this->getMetaValue("live_api_username");
						$pppass   = $this->getMetaValue("live_api_password");
						$ppsig    = $this->getMetaValue("live_api_signature");
						$ppappid  = $this->getMetaValue("live_app_id");
						$payment_email  = $this->getMetaValue("live_payment_email");
					}else{
						$ppuserid = $this->getMetaValue("sandbox_api_username");
						$pppass   = $this->getMetaValue("sandbox_api_password");
						$ppsig    = $this->getMetaValue("sandbox_api_signature");
						$ppappid  = $this->getMetaValue("sandbox_app_id");
						$payment_email  = $this->getMetaValue("sandbox_payment_email");
					}

					//prepare the receivers
					$receiverList=array();
					$counter=0;
					$receiverList["receiver"][$counter]["amount"]=$amount;
					$receiverList["receiver"][$counter]["email"]= $cemail;
					// $receiverList["receiver"][$counter]["email"]= "syed.wasi.abbas@gmail.com";
					
					$receiverList["receiver"][$counter]["paymentType"]="SERVICE";//this could be SERVICE or PERSONAL 
					$receiverList["receiver"][$counter]["invoiceId"]=uniqid();//NB that this MUST be unique otherwise
					//prepare the call
					$payLoad["actionType"]="PAY";
					$payLoad["cancelUrl"]= $this->getMetaValue("site_url");//this is required even though it isnt used
					$payLoad["returnUrl"]= $this->getMetaValue("site_url");//this is required even though it isnt used
					$payLoad["currencyCode"]="USD";
					$payLoad["receiverList"]=$receiverList;
					$payLoad["feesPayer"]="SENDER";//this could be SENDER or EACHRECEIVER
					$payLoad["sender"]["email"] = $payment_email;//the paypal email address of the where the money is coming from
					//run the call
					
					if($this->getMetaValue("env_mode") == '1' || $this->getMetaValue("env_mode") == 1){
						$API_Endpoint = "https://svcs.paypal.com/AdaptivePayments/Pay";
					}else{
						$API_Endpoint = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";
					}
					
					$payLoad["requestEnvelope"]=array("errorLanguage"=>urlencode("en_US"),"detailLevel"=>urlencode("ReturnAll"));
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
					curl_setopt($ch, CURLOPT_VERBOSE, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
						'X-PAYPAL-REQUEST-DATA-FORMAT: JSON',
						'X-PAYPAL-RESPONSE-DATA-FORMAT: JSON',
						'X-PAYPAL-SECURITY-USERID: '. $ppuserid,
						'X-PAYPAL-SECURITY-PASSWORD: '. $pppass,
						'X-PAYPAL-SECURITY-SIGNATURE: '. $ppsig,
						'X-PAYPAL-APPLICATION-ID: '. $ppappid
					));  
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payLoad));//
					$response = curl_exec($ch);
					$response = json_decode($response, 1);
					//print_r($response);
					//analyse the output
					$payKey = $response["payKey"];
					$paymentExecStatus = $response["paymentExecStatus"];
					$ack = $response["responseEnvelope"]["ack"];
					$correlationId=$response["responseEnvelope"]["correlationId"];
					$paymentInfoList = isset($response["paymentInfoList"]) ? $response["paymentInfoList"] : null;
					
					if ($ack == "Success"){
					   //update user earnings
						$this->db->query('insert into user_earnings (user_id,survey,date,amount)
									   values ('.$this->session->userdata('client_id').',"'.$name.'","'.date('Y-m-d').'","'.$amount.'")');
						
						//transfer amount to user   
						//redirect to user dashboard
						 $this->session->set_flashdata('success',' Thank you for completing this query!<br />A payment has been sent to your PayPal account.');
						 // if query is submitted and payment is completed then unset this session.
						 redirect('user/myQueries');
						 
						/*foreach($paymentInfoList["paymentInfo"] as $paymentInfo) {//they will only be in this array if they had a paypal account
							$receiverEmail = $paymentInfo["receiver"]["email"];
							$receiverAmount = $paymentInfo["receiver"]["amount"];
							$withdrawalID = $paymentInfo["receiver"]["invoiceId"];
							$transactionId = $paymentInfo["transactionId"];//what shows in their paypal account
							$senderTransactionId = $paymentInfo["senderTransactionId"];//what shows in our paypal account
							$senderTransactionStatus = $paymentInfo["senderTransactionStatus"];
							$pendingReason = isset($paymentInfo["pendingReason"]) ? $paymentInfo["pendingReason"] : null;
						}*/

					}else{
					   //deal with error
					   //echo "Sorry Payment could not proceed, Details: <br>";
						/* print_r($response);
					   exit; */
						$this->session->set_flashdata('error','Sorry, Payment could not be completed.');
						//redirect('user/myQueries');
					}
				
				
				}
			}else{
				$this->session->set_flashdata('success',' Thank you for completing this query!<br />A payment has been sent to your PayPal account.');
				// if query is submitted and payment is completed then unset this session.
				redirect('user/myQueries');
			}
		}
		  
		  //$this->session->set_userdata('clientAuth', true);
	      $this->layout->title('Dashboard');
		  $this->load->model('event');
		  $data['data'] = $this->event->loadMyPosts($this->session->userdata('client_id'));
		  if($this->id > 0 ){
		    $data['single'] = $this->event->loadMyPosts1($this->session->userdata('client_id'),$this->id);
		  }else{
		    if(count( $data['data'] ) > 0){
			  $data['single'] = $this->event->loadMyPosts2($this->session->userdata('client_id'));	
			}else{
		      $data['single'] = array();	
            }			
		  }
		  
			$this->load->helper('captcha');

			$this->load->helper('string');

			$vals = array(

               'word'	=> strtolower(random_string('numeric', 4)),

               'img_path'	=> './captcha/',

               'img_url'	=> base_url().'captcha/',

               'img_width'	=> '150',

               'img_height' => '30',

               'expiration' => 7200

            );


            $data['cap'] = create_captcha($vals);
			
			//print_r($data['cap']);
		  
		  $this->layout->view('client_only/my_posts',$data);
	 }
	 
	 public function myEarnings(){
	 
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect(base_url());
		  }
		  //$this->session->set_userdata('clientAuth', true);
	      $this->layout->title('History');
	      $this->layout->view('client_only/my_earnings');
	 }
	 
	  public function withdraw(){
	 
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect(base_url());
		  }
		  //$this->session->set_userdata('clientAuth', true);
	      $this->layout->title('Withdrawal');
		  $this->load->model('event');
		  $data['data'] = $this->event->loadMyPosts($this->session->userdata('client_id'));
	      $this->layout->view('client_only/widthdraw',$data);
	 }
	 
	  	 
  
	  public function vendorProfile($id=0,$pid=0){
	    $this->pid = $pid;
	    if($id > 0){
		  $this->load->model('vendor');
  		  $out = $this->vendor->getVendorById($id);
		  $out_img = $this->vendor->getImages($id);
		  
		  if(count($out_img) > 0 ){
		   $out[0]['gal'] =  $out_img;
		  }else{
		    $out[0]['gal'] =  array();
		  }
		  
		  
		  $out_cat = $this->vendor->getCat($id);
		  
		  if(count($out_cat) > 0 ){
		   $out[0]['cat'] =  $out_cat;
		  }else{
		    $out[0]['cat'] =  array();
		  }
		  
		  $out_review = $this->vendor->getReview($id);
		  
		  if(count($out_review) > 0 ){
		   $out[0]['review'] =  $out_review;
		  }else{
		    $out[0]['review'] =  array();
		  }
       
    		  
		  if( count($out) > 0 ){
		    $out[0]['post_id'] = $pid;
		    $this->layout->title('My Profile');
	        $this->layout->view('vendor_only/vendor_details',$out[0]);  
		  }else{
		    redirect(base_url());	
		  }
		}else{
		   redirect(base_url());		  
		}
	  }
 
	  public function deactivate(){
	       $this->load->model('client');
		    /*-----------------------------------------------------------------------------------------------------------------------------------------------*/
			         $ano = 'select clients.contact_name,users.email from users inner join clients on clients.user_id = users.id where clients.user_id='.$this->session->userdata('client_id');
			         $kout = $this->db->query($ano);
			         $res  = $kout->result_array();
					 $this->load->library('phpmailer/PHPMailer');
					 $u_email     = $res[0]['email'];
					 $headers     = "MIME-Version: 1.0\r\n";
                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";
                     $to          = $u_email;
                     $bodyOfMessage =  $this->load->view('deact_message',array('name'=>$res[0]['contact_name']), true );
	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 
	                 $mail->SingleTo = true; 
	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');
	                 $mail->Subject = 'Your ThoughtBase Account Is Deactivated'; //Edited By Raza.
	                 $mail->Body    = $bodyOfMessage;
	                 $mail->AddAddress($u_email);
	                 $mail->Send();					 
		/*---------------------------------------------------------------------------------------------------------------------------------------------------*/
		   $this->db->query('update  users set disable_flag = 1, deact=1 where id='.$this->session->userdata('client_id'));
		   $this->session->sess_destroy();
		   $this->session->set_flashdata('success','Your account deactivated successfully');		   
		   redirect(base_url());
	  }
	  
    //edit client user profile
	public function payment() {
		  //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect(base_url());
		  } 
	      $this->load->model('client');
		  $client_data = $this->client->getClientById($this->session->userdata('client_id'));		  
		   if($this->input->post()){
		   //checking post for changepassword	
			if( $this->input->post('act') == 'editaccount' ){
			    $this->form_validation->set_rules('pemail', 'Paypal Email Address', 'trim|required');
				if($this->form_validation->run() == FALSE){
				  //form validation failed   
				  $client_data[0]['pemail'] = mysql_real_escape_string($this->input->post('pemail'));				 
				}else{
	   				$this->client->updateClientUser($this->session->userdata('client_id'),array('pemail'=>mysql_real_escape_string($this->input->post('pemail'))));
					$this->session->set_flashdata('success','settings changed successfully');
				    redirect('user/payment');			
				}	
			}
		   //end of password change check
		  }
	      $this->layout->title('Edit Payment settings');
		  $this->layout->view('client_payment',array('result' => $client_data[0]));
	}
	
	//Get API Details
	public function getMetaValue($meta_key) {
		$data = $this->db->query("SELECT * FROM site_meta_setting WHERE meta_key='$meta_key'")->row_array();
			return $data['meta_value'];
	   }
	  
	  
	  
}