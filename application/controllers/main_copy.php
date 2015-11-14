<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');   

class Main extends CI_Controller {

    // Layout used in this controller

	public $layout_view = 'layout/default';

	

	function __construct() {

	      parent::__construct();

		  $this->load->library('layout');

		  $this->load->helper('url');

		  $this->load->library('session');

		  $this->lang->load('message', 'english');

	}

 

	   public function index() {
	   
	      //checking user login if logged redirect to dashboard
          if( $this->session->userdata('clientAuth')){
		    redirect('clients/myPosts');
		  }
		  if( $this->session->userdata('vendorAuth')){
		    redirect('vendors/dashboard');
		  }

	      $this->layout->title('Home');

	      $this->layout->view('home');

	   }
	   
	   public function terms_condition()
	   {
			
		$this->layout->title('Home');

		$this->layout->view('terms_condition.php');
	   }

	   

	   public function newPost($id=0){

	      $data['id'] = $id;

 		  $this->load->model('event');

		  $this->load->model('client');

    	  //checking post belong to user

		  if( $data['id'] > 0 ){

		     if(!$this->session->userdata('clientAuth')){

			      redirect('main/index');			 

			 }else{

			      $temp = $this->event->getPost($data['id'],$this->session->userdata('client_id'));

  		          $client_data_no = $this->client->getClientById($this->session->userdata('client_id'));

				  if(! count($temp) > 0){

				    redirect('main/index');

				  }else{

						

						$data['eventSubType'] = $temp[0]['sub_event_type'];

				 	    $out_temp =	$this->event->getParentEvent($data['eventSubType']);

						$data['eventType']    = isset($out_temp[0]['me_id']) ? $out_temp[0]['me_id'] :'';

     					$data['category']     = $temp[0]['vendor_cat_id'];

						$data['delivery_dt']  = $temp[0]['date'];

						$data['address'] = $temp[0]['address'];

						$data['post_unit'] = $temp[0]['post_unit'];

						$data['budget'] = $temp[0]['budget'];

						$data['quantity'] = $temp[0]['unit'];

						$data['total'] = $temp[0]['unit']*$temp[0]['budget'];

						$data['contact_number'] = $client_data_no[0]['contact_number'];

						$data['contactTime'] = $temp[0]['contact'];

						$data['description'] = $temp[0]['addi_req'];	

						$sub_events = $this->event->getSubTypes($data['eventType']);

						 $options ='<option value=""></option>';

						 if(count($sub_events) > 0 ){

						   foreach($sub_events as $row => $val){

							if($data['eventSubType'] == $val['event_id'] ){

							   $options .='<option selected value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

							}else{

							  $options .='<option  value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

							}

						   }

						 }

						 $data['options'] = $options;  

						

				  }

			 }

		  }

	      //fetching events types informatiom



		  //checking usr session to populate contact number

		  if($this->session->userdata('clientAuth')){

		     $user_data = $this->client->getClientById($this->session->userdata('client_id'));

			 $data['contact_no'] = isset($user_data[0]['contact_number']) ? $user_data[0]['contact_number'] :''; 

		  }else{

			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|is_unique[users.email]');

			$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');

			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			$this->form_validation->set_rules('userName', 'Username', 'trim|required');

		    $data['contact_no'] ='';

		  }

		  $data['main_event_type'] = $this->event->getAll();

	      $data['vendor_cat'] = $this->event->getAllVendorCat();

	  

		  if( ($this->input->post('act')) &&  ($this->input->post('act') =='post') ){

             $data['eventType'] = $this->input->post('eventType');

			 $data['eventSubType'] = $this->input->post('eventSubType');

			 $data['category'] = $this->input->post('category');

			 $data['delivery_dt'] = $this->input->post('delivery_dt');

			 $data['address'] = $this->input->post('address');

 			 $data['post_unit'] = $this->input->post('post_unit');

			 $data['budget'] = $this->input->post('budget');

			 $data['quantity'] = $this->input->post('quantity');

			 $data['total'] = $this->input->post('total');

			 $data['contact_number'] = $this->input->post('contact_number');

			 $data['contactTime'] = $this->input->post('contactTime');

 			 $data['description'] = $this->input->post('description');

		     //set validation error message here

 			$this->form_validation->set_rules('eventType', 'Event Type', 'trim|required');

			$this->form_validation->set_rules('eventSubType', 'Plan', 'trim|required');

			$this->form_validation->set_rules('category', 'Looking for', 'trim|required');

			$this->form_validation->set_rules('delivery_dt', 'Delivery date', 'trim|required');

    		$this->form_validation->set_rules('address', 'Address', 'trim|required');

			$this->form_validation->set_rules('budget', 'Budget', 'trim|required');

			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');

            $this->form_validation->set_rules('total', 'Total', 'trim|required');

			$this->form_validation->set_rules('post_unit', 'Unit', 'trim|required');



			

			

    		if($this->form_validation->run() == FALSE){

			 $data['eventType'] = $this->input->post('eventType');

			 $data['eventSubType'] = $this->input->post('eventSubType');

			 $data['category'] = $this->input->post('category');

			 $data['delivery_dt'] = $this->input->post('delivery_dt');

			 $data['address'] = $this->input->post('address');

			 $data['post_unit'] = $this->input->post('post_unit');

			 $data['budget'] = $this->input->post('budget');

			 $data['quantity'] = $this->input->post('quantity');

			 $data['total'] = $this->input->post('total');

			 $data['contact_number'] = $this->input->post('contact_number');

			 $data['contactTime'] = $this->input->post('contactTime');

 			 $data['description'] = $this->input->post('description');

			 

			 if( ! $this->session->userdata('clientAuth')){

			   $data['email'] = $this->input->post('email');

			   $data['contact_number'] = $this->input->post('contact_number');

			   $data['userName'] = $this->input->post('userName');

			 }



			 

			 //loding subcategories of event

			 $sub_events = $this->event->getSubTypes($data['eventType']);

			 $options ='<option value=""></option>';

			 if(count($sub_events) > 0 ){

			   foreach($sub_events as $row => $val){

			    if($data['eventSubType'] == $val['event_id'] ){

			       $options .='<option selected value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

			    }else{

				  $options .='<option  value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

				}

			   }

			 }

			 $data['options'] = $options;

			 //form validation failed         

			}else{

			  //registration

			  if( ! $this->session->userdata('clientAuth')){

			      $clientId = $this->client->insertClient(array('email' =>$this->input->post('email'),'password' => $this->input->post('password'),'register_date'=> date('Y-m-d H:i:s') , 'disable_flag' => 0 ));

				  //inserting in to client table

				  $clientData = array('user_id'=> $clientId,'contact_name'=>$this->input->post('userName'),'contact_number'=>$this->input->post('contact_number'));

				  $this->client->insertClientTable($clientData);

 				  $this->session->set_userdata('clientAuth', true);

				  $this->session->set_userdata('client_id', $clientId);

				  $this->session->set_userdata('client_name', $this->input->post('userName') );

			  }//

			  

			  		

			

			  //valid form

			  //$db['main_event_type'] = $data['eventType'];

			  $db['sub_event_type'] = $data['eventSubType'];

			  $db['vendor_cat_id'] = $data['category'];

			  $db['date'] = $data['delivery_dt'];

			  $db['address'] = $data['address'];

 			  $db['post_unit'] = $data['post_unit'];

			  $db['budget']     = $data['budget'];

			  $db['unit']      = $data['quantity'];

			  $db['addi_req'] = $data['description'];

			  $db['contact'] = $data['contactTime'];

			  $db['user_id'] = $this->session->userdata('client_id');

			  $db['submitted_date'] = date('Y-m-d H:i:s');

			  if($data['id'] > 0 ){

			   //update condition

			   	$this->session->set_flashdata('success',$this->lang->line('post_update'));

			    $this->event->updatePost($data['id'],$db);

			  }else{

			   //add condition

			    $this->session->set_flashdata('success',$this->lang->line('post_insert'));

			    $this->event->insertPost($db);

			   	   

			  }

			  //redirect to client post page

			  redirect('clients/myPosts');

			

			}

          }		  

	  

		  

	      $this->layout->title('Get Quotes');

	      $this->layout->view('newPost',$data);

		  //$this->layout->view('newPostWiz',$data);

	   }

	   

	   public function clientLogin() {
	   
	   
	      //already logged in redirct to home page

	      if( $this->session->userdata('clientAuth')){
		    redirect('clients/myPosts');
		  }
		  
		  if( $this->session->userdata('vendorAuth')){
		    redirect('vendors/dashboard');
		  }

	   

		  

			    //setting formvalidation rules

				$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');

				$this->form_validation->set_rules('password', 'Password', 'trim|required');

		        if($this->form_validation->run() == FALSE){

				 //form validation failed         

				}else{
				     
				   	//set cookie
					 if(isset($_POST['rem']) && $_POST['rem'] =="1"  ){
					 
$expire = time() + 60 * 60 * 24 * 30;					 
$cookie1 = array(
'name'   => 'username',
'value'  => $_POST['email'],
'expire' => $expire,
'path'   => '/',
'prefix' => 'kk_',
);
$cookie2 = array(
'name'   => 'password',
'value'  => $_POST['password'],
'expire' => $expire,
'path'   => '/',
'prefix' => 'kk_',
);
set_cookie($cookie1);
set_cookie($cookie2);
			 
					 
					  

					 }else{
						$cookie1 = array(
							'name'   => 'username',
							'value'  => '',
							'expire' => '0',
							'prefix' => 'kk_'
							);
						$cookie2 = array(
							'name'   => 'password',
							'value'  => '',
							'expire' => '0',
							'prefix' => 'kk_'
							);
						delete_cookie($cookie1);
						delete_cookie($cookie2);

					 }
				  
				  

				  	//Checking
				

				  //formvalidation success check login credentials

				  $this->load->model('client');

				  $client_dat = $this->client->getUsers($this->input->post('email'),$this->input->post('password'));

				  

			  

				  if( count($client_dat) > 0){
				  
	 

				    if( ($client_dat[0]['disable_flag'] == 1) &&  ( $client_dat[0]['deact'] == 1  )   ){
                       //show activation message
				    	$ema = base64_encode($client_dat[0]['email']);
                        $this->session->set_flashdata('error','Your account is currently inactive, would you like to reactivate it ? <a href="'.site_url("main/active/$ema").'"> Yes</a> / No');
			            redirect('main/clientLogin');



				    }else if(  ($client_dat[0]['disable_flag'] == 1) &&  ( $client_dat[0]['deact'] == 0  )  ){
                       //user not activated 
				       $this->session->set_flashdata('error','Please check your email to activate your account');
			           redirect('main/clientLogin');

				    }else{


				    //login success
                    if($client_dat[0]['isadv'] == 0 ){
					    $this->session->set_userdata('clientAuth', true);
					    $this->session->set_userdata('client_id', $client_dat[0]['id']);
					    $this->session->set_userdata('client_name','cli' );
					    redirect('clients/myPosts');
					  }else{
					
					    $this->session->set_userdata('vendorAuth', true);
					    $this->session->set_userdata('vendor_id', $client_dat[0]['id']);
					    $this->session->set_userdata('name', 'adv');
				        redirect('vendors/dashboard');
					  
					 }

				   }
					 

				    

				  }else{

				     //login error

				     $this->session->set_flashdata('error',$this->lang->line('login_failed'));

					 redirect('main/clientLogin');

				  }

				

				}

	      $this->layout->title('Login');

	      $this->layout->view('client_login');

	   }

	   //vendor login
	   public function vendorLogin(){
	      //already logged in redirct to home page
	      if($this->session->userdata('vendorAuth')){
		    redirect('main/index');
		  }
			    //setting formvalidation rules
				$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
		        if($this->form_validation->run() == FALSE){
				 //form validation failed         
				}else{
				  //formvalidation success check login credentials
				  $this->load->model('vendor');
				  $vendor_dat = $this->vendor->getVendor($this->input->post('email'),$this->input->post('password'));
				  if( count($vendor_dat) > 0){
				     //login success
					 $this->session->set_userdata('vendorAuth', true);
					 $this->session->set_userdata('vendor_id', $vendor_dat[0]['id']);
					 $this->session->set_userdata('name', $vendor_dat[0]['name']);
				     redirect('vendors/dashboard');
				  }else{
				     //login error
				     $this->session->set_flashdata('error',$this->lang->line('login_failed'));
					 redirect('main/vendorLogin');
				  }
				}
	      $this->layout->title('Vendor Login');
	      $this->layout->view('vendor_login');
	   }
	   

	   public function clientRegister(){
			//checking for register post
			if($this->input->post()){
			    //setting formvalidation rules
                $brr = array();
               
				$ema = base64_encode($this->input->post('email'));
				 if($ema){

                    $brr = $this->db->query('select * from users where email="'.base64_encode($ema).'"')->result_array();
                }

				$this->form_validation->set_rules('email', 'Paypal Email Address', 'trim|required|is_unique[users.email]|valid_email');
				if(isset($brr[0]['deact']) &&  $brr[0]['deact'] == 1 ){
 				  $this->form_validation->set_message('is_unique', 'This account already exists. Your account is currently inactive, would you like to reactivate it ? <a href="'.site_url("main/active/$ema").'"> Yes</a> / No');
			    }else{
				  $this->form_validation->set_message('is_unique', 'This account is already registered.  Try  <a href="'.site_url("main/clientLogin").'">Logging In.</a>');
				}


				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
				$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|integer');
				$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|matches[ocaptcha]');
				$this->form_validation->set_rules('ocaptcha', 'Verify image letters', 'trim|required');
				if($this->form_validation->run() == FALSE){

				  //form validation failed
              	}else{

				  unset($_POST['captcha']);
				  unset($_POST['ocaptcha']);
				  $int = array();
				  if($_POST['interest']){
				     $int = $_POST['interest'];
                  }
				  unset($_POST['interest']);
				  //formvalidation success redirect to client dashboard after update

				  $this->load->model('client');

				  //inserting in to user table

				  $clientId = $this->client->insertClient($this->input->post());
				  
				  //checking latiyude and longitude
				  $url ="http://maps.googleapis.com/maps/api/geocode/json?address=".$this->input->post('zipcode')."&sensor=false";
                  try{ 
                   $res = json_decode(file_get_contents($url));	
 				   if( isset($res->results[0]->geometry->location->lat) && isset($res->results[0]->geometry->location->lng) ){
					$this->db->query('update users set lat="'.$res->results[0]->geometry->location->lat.'" , lon="'.$res->results[0]->geometry->location->lng.'" where id ='.$clientId);				  
				   }
				  }catch(Exception $e) {
                    
                  }
				  
				  
				  
				  if(count($int) > 0 ){
				    foreach($int as $a => $b ){
					   $qu = "INSERT INTO user_interest VALUES(null,".$clientId.",".$b.")";
					   $this->db->query($qu);
					}
				  }

				  //inserting in to client table

				  $clientData = array('user_id'=> $clientId,'contact_name'=>$this->input->post('userName'),'contact_number'=>$this->input->post('contact_number'));

				  $this->client->insertClientTable($clientData);

				  /*---------------------------------------------------*/

				     $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $this->input->post('email');

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage = $this->load->view( 'message',array('name'=>$this->input->post('userName'),'id'=>base64_encode($clientId)), true );
					 

	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase Registration Confirmation";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

                     redirect('main/confirm_email');					 

				}

			}//end of post check

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

			

			



            $cap = create_captcha($vals);

			$this->layout->title('Register');

			$this->layout->view('client_register',$cap);

	   }
	   
	   
	   
	   
	     public function advtRegister() {

	         

			//checking for register post

			if($this->input->post()){

			    //setting formvalidation rules

				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|is_unique[users.email]|valid_email');
				$this->form_validation->set_message('is_unique', 'This email address already exists.');
				$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
				$this->form_validation->set_rules('userName', 'Username', 'trim|required');
				$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|matches[ocaptcha]');
				$this->form_validation->set_rules('ocaptcha', 'Verify image letters', 'trim|required');
				if($this->form_validation->run() == FALSE){
				  //form validation failed         
				}else{

				  unset($_POST['captcha']);

				  unset($_POST['ocaptcha']);

				  //formvalidation success redirect to client dashboard after update

				  $this->load->model('client');

				  //inserting in to user table

				  $clientId = $this->client->insertClient($this->input->post());

				  //inserting in to client table

				  $clientData = array('user_id'=> $clientId,'contact_name'=>$this->input->post('userName'),'contact_number'=>$this->input->post('contact_number'));

				  $this->client->insertClientTable($clientData);

				  /*---------------------------------------------------*/

				    /* $this->load->library('email');

				     $config['wordwrap'] = TRUE;

					 $config['mailtype'] = 'html';

				     $this->email->initialize($config);

                     $this->email->from('thoughtbase@thoughtbase.net', 'Thoughtbase.net' );

                     $this->email->to( $this->input->post('email') );

                     $this->email->subject( 'Thoughtbase.net - Registration Confirmation' );

                     $this->email->message( $this->load->view( 'message',array('name'=>$this->input->post('userName'),'id'=>base64_encode($clientId)), true ) );

                     $this->email->send();

             		 redirect('main/confirm_email'); */

					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $this->input->post('email');

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                     $bodyOfMessage = $this->load->view( 'message',array('name'=>$this->input->post('userName'),'id'=>base64_encode($clientId)), true );

	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase Registration Confirmation";

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

                     redirect('main/confirm_email');					 

				}

			}//end of post check

			$this->load->helper('captcha');

			$this->load->helper('string');

			$vals = array(

               'word'	=> strtolower(random_string('alpha', 4)),
               'word'	=> strtolower(random_string('numeric', 4)),

               'img_path'	=> './captcha/',

               'img_url'	=> base_url().'captcha/',

               'img_width'	=> '150',

               'img_height' => '30',

               'expiration' => 7200

            );

            $cap = create_captcha($vals);
			$this->layout->title('Register');
			$this->layout->view('client_register',$cap);

	   }

	    //vendor register 
	    public function vendorRegister(){

			//checking for register post
			if($this->input->post()){



				$brr = array();
				$ema = base64_encode($this->input->post('email'));
				 if($ema){
                    $brr = $this->db->query('select * from users where email="'.$this->input->post('email').'"')->result_array();
                }

			    //setting formvalidation rules
				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|is_unique[users.email]|valid_email');

                if(isset($brr[0]['deact']) &&  $brr[0]['deact'] == 1 ){
                    
        				$this->form_validation->set_message('is_unique', 'This account already exists. Your account is currently inactive, would you like to reactivate it ? <a href="'.site_url("main/active/$ema").'"> Yes</a> / No');
				
				}else{
						$this->form_validation->set_message('is_unique', 'This account is already registered.  Try  <a href="'.site_url("main/clientLogin").'">logging in</a>');
				}





				$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
				$this->form_validation->set_rules('company', 'Company Name', 'trim|required');
				$this->form_validation->set_rules('uen', 'Business Registration Number', 'trim|required');
				$this->form_validation->set_rules('company', 'Company Description', 'trim|required');
				$this->form_validation->set_rules('uen', 'Address', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
				$this->form_validation->set_rules('userName', 'Username', 'trim|required');
				$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|matches[ocaptcha]');
				$this->form_validation->set_rules('ocaptcha', 'Verify image letters', 'trim|required');
				if($this->form_validation->run() == FALSE){
				 //form validation failed         
				}else{
   			      unset($_POST['captcha']);
				  unset($_POST['ocaptcha']);
				  //formvalidation success redirect to client dashboard after update
				  $this->load->model('vendor');
				  //inserting in to user table
				  $vendorId = $this->vendor->insertVendor($this->input->post());
				  //inserting in to vendor table
				  $vendorData = array('user_id'=> $vendorId,'name'=>$this->input->post('userName'),'contact_number'=>$this->input->post('contact_number'),'company_name'=>$this->input->post('company'),'uen'=>$this->input->post('uen'));
				  $this->vendor->insertVendorTable($vendorData);
				  	 $this->load->library('phpmailer/PHPMailer');
					 $u_email     = $this->input->post('email');
					 $headers     = "MIME-Version: 1.0\r\n";
                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";
                     $to          = $u_email;
                     $bodyOfMessage = $this->load->view( 'message1',array('name'=>$this->input->post('userName'),'id'=>base64_encode($vendorId)), true );
	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 
	                 $mail->SingleTo = true; 
	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');
	                 $mail->Subject = "Thoughtbase Registration Confirmation";
	                 $mail->Body    = $bodyOfMessage;
	                 $mail->AddAddress($u_email);
	                 $mail->Send();	
                     redirect('main/confirm_email');	
   			    }

			}//end of post check
				  
				  
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
            $cap = create_captcha($vals);
			$this->layout->title('Advertiser Register');
			$this->layout->view('vendor_register',$cap);

	     
	   }

	  

	   public function logout() {

		  $this->session->sess_destroy();
	      redirect(site_url(), 'refresh');

	   }

	   

	   public function ajaxSubEvents(){

 		  $options ='<option value=""></option>';

	      if(isset($_POST['id'])  && $_POST['id'] > 0  ){

		     $this->load->model('event');

		     $sub_events = $this->event->getSubTypes($_POST['id']);

			 if(count($sub_events) > 0 ){

			   foreach($sub_events as $row => $val){

			    $options .='<option value="'.$val['event_id'].'">'.$val['event_name'].'</opion>';

			   }

			 }

		  }

		  echo $options;

	   }

	   

	   public function confirm_email(){
		 $this->layout->title('Confirm Email');
	     $this->layout->view('client_only/confirm_email');  

	   }

	   

	   

	   public function forgot_password(){

		 $this->layout->title('Forgot Password');

		 if($this->input->post()){

		  $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

		  if($this->form_validation->run() == FALSE){

				 //form validation failed         

		  }else{
		  
			$email = $this->input->post('email');

		    //checking email exists in database

			$sql ="select * from users where email ='".$this->input->post('email')."'";

			$temp = $this->db->query($sql);

			$out  = $temp->result_array();

			if( count($out) > 0 ){
			
			 $token =  base64_encode($email.'-'.$out[0]['id']);
				
			 $this->session->set_userdata('token', $token);
			
			 $token_data = $this->session->userdata('token');

			  //get user name

			  //sending password

			  /*---------------------------------------------------*/


					 

					 $this->load->library('phpmailer/PHPMailer');

					 $u_email     = $out[0]['email'];

					 $headers     = "MIME-Version: 1.0\r\n";

                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";

                     $to          = $u_email;

                    $bodyOfMessage = $this->load->view( 'password_message',array('name'=>'User','token'=>$token_data), true );

	                 $mail = new PHPMailer();

	                 $mail->IsHTML(true); 

	                 $mail->SingleTo = true; 

	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');

	                 $mail->Subject = "Thoughtbase Password Recovery"; //Edited By Raza.

	                 $mail->Body    = $bodyOfMessage;

	                 $mail->AddAddress($u_email);

	                 $mail->Send();	

			  /*---------------------------------------------------*/

			

			  $this->session->set_flashdata('success','Your password reset request has been sent to your email address.  If you do not receive the email within a few minutes, please check your Junk or Spam folder.');

			  redirect('main/clientLogin');

			}else{

			  $this->session->set_flashdata('error','The email address you specified is not in system data.');

			  redirect('main/forgot_password');

			}

		

		  }

			 

		 }

		 $this->layout->view('forgotpassword');  

	   }
	   
	   
	    public function reset_password($token=''){
		
		if($token != "" && $token == $this->session->userdata('token'))
		{
			if(isset($_POST['reset']))
			{
				$token_value = explode("-", base64_decode($token));
				
				$token_value[0];
				$token_value[1];
				
				$password = base64_encode($_POST['confirm_pass']);
				
				$sql ="UPDATE users SET password = '".$password."' where email ='".$token_value[0]."' and id='".$token_value[1]."'";
				
				$query = $this->db->query($sql);
				
				$this->session->set_flashdata('success','You have reset your password.');
				
				redirect('main/clientLogin');
			}
		 
			$this->layout->view('reset_password');  
		 }
		 
		}

	   

	   

	   public function confirm($id=''){

	     if($id !=""){

		    $id  = base64_decode($id);

			$sql = "UPDATE users SET disable_flag=0 where id=".$id;

			$this->db->query($sql);

			

			$ano = 'select clients.contact_name,users.email from users inner join clients on clients.user_id = users.id where users.id ='.$id;

			$kout = $this->db->query($ano);

			$res  = $kout->result_array();

			

			 /*--------------------------------------------------------------------------------------------------------------*/

					 $this->load->library('phpmailer/PHPMailer');
					 $u_email     = $res[0]['email'];
					 $headers     = "MIME-Version: 1.0\r\n";
                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";
                     $to          = $u_email;
                     $bodyOfMessage =  $this->load->view( 'confirm_message',array('name'=>$res[0]['contact_name']), true );
	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 
	                 $mail->SingleTo = true; 
	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');
	                 $mail->Subject = "Thoughtbase Activation Confirmation.";
	                 $mail->Body    = $bodyOfMessage;
	                 $mail->AddAddress($u_email);
	                 $mail->Send();	

			/*--------------------------------------------------------------------------------------------------------------*/

			

			$this->session->set_flashdata('success','your account is activated please login to continue');

			redirect('main/clientLogin');

		 }else{

		    redirect(base_url());

		 }

	   }
	   
	   
	   
	   
	    public function confirm1($id=''){

	     if($id !=""){

		    $id  = base64_decode($id);
			$sql = "UPDATE users SET disable_flag=0 where id=".$id;
			$this->db->query($sql);
			$ano = 'select users.*,vendors.name,vendors.id as vid,vendors.contact_number,vendors.company_name,
vendors.uen from users
            join vendors 
			on users.id = vendors.user_id
			where users.id ='.$id." and isadv =1";
			$kout = $this->db->query($ano);
			$res  = $kout->result_array();
			
			 /*--------------------------------------------------------------------------------------------------------------*/
					 $this->load->library('phpmailer/PHPMailer');
					 $u_email     = $res[0]['email'];
					 $headers     = "MIME-Version: 1.0\r\n";
                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";
                     $to          = $u_email;
                     $bodyOfMessage =  $this->load->view( 'confirm_message',array('name'=>$res[0]['name']), true );
	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 
	                 $mail->SingleTo = true; 
	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');
	                 $mail->Subject = "Your Thoughtbase Account is Activated";
	                 $mail->Body    = $bodyOfMessage;
	                 $mail->AddAddress($u_email);
	                 $mail->Send();	
			/*--------------------------------------------------------------------------------------------------------------*/
			$this->session->set_flashdata('success','your account is activated please login to continue');
			redirect('main/vendorLogin');

		 }else{
		    redirect(base_url());
		 }
	   }
	   
	   
	   
	   
	   public function forgot_password_adv(){

		 $this->layout->title('Forgot Password');

		 if($this->input->post()){

		  $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

		  if($this->form_validation->run() == FALSE){

				 //form validation failed         

		  }else{
		  
			$email = $this->input->post('email');
			
		    //checking email exists in database
			$sql ="select * from users where email ='".$this->input->post('email')."'";
			$temp = $this->db->query($sql);
			$out  = $temp->result_array();
			if( count($out) > 0 ){
			
			  $token =  base64_encode($email.'-'.$out[0]['id']);
			  $this->session->set_userdata('token', $token);
			  $token_data = $this->session->userdata('token');
			  //get user name
			  $uquery ="select name from vendors where user_id =".$out[0]['id'];
			  $itemp = $this->db->query($uquery);
			  $uout  = $itemp->result_array();
			  //sending password
			  /*---------------------------------------------------*/
					 $this->load->library('phpmailer/PHPMailer');
					 $u_email     = $out[0]['email'];
					 $headers     = "MIME-Version: 1.0\r\n";
                     $headers    .= "Content-type: text/html; charset=ISO-8859-1\r\n";
                     $to          = $u_email;
                     $bodyOfMessage = $this->load->view( 'password_message',array('name'=>$uout[0]['contact_name'],'token'=>$token_data), true );
	                 $mail = new PHPMailer();
	                 $mail->IsHTML(true); 
	                 $mail->SingleTo = true; 
	                 $mail->SetFrom('thoughtbase@thoughtbase.net', 'Thoughtbase');
	                 $mail->Subject = "ThoughtBase Password Recovery"; //Edited By Raza.
	                 $mail->Body    = $bodyOfMessage;
	                 $mail->AddAddress($u_email);
	                 $mail->Send();	
			  /*---------------------------------------------------*/
			  $this->session->set_flashdata('success','Your password reset request has been sent to your email address.  If you do not receive the email within a few minutes, please check your Junk or Spam folder.');
			redirect('main/vendorLogin');

		 }else{
			  $this->session->set_flashdata('error','The email address you specified is not in system data.');
			  redirect('main/forgot_password_adv');
			}
		  }

			 

		 }

		 $this->layout->view('forgotpassword');  

	   }




  
	   
	   
	public function username_check($str)
	{
	    $query ="select * from users where email ='".$str."' and isadv=0";
		$out1 = $this->db->query($query);
		$out = $out1->result_array();
		if ( count($out) > 0 )
		{
			$this->form_validation->set_message('username_check', 'This account is already registered. Try<a href="'.site_url().'/main/clientLogin"> Logging In.</a>'); //Edited By Raza.
			return FALSE;
		}else
		{
			return TRUE;
		}
	}
	
	
	public function username_check_adv($str)
	{
	    $query ="select * from users where email ='".$str."' and isadv=1";
		$out1 = $this->db->query($query);
		$out = $out1->result_array();
		if ( count($out) > 0 )
		{
			$this->form_validation->set_message('username_check_adv', 'This account is already registered. Try<a href="'.site_url().'/main/vendorLogin"> Logging In.</a>'); //Edited By Raza.
			return FALSE;
		}else
		{
			return TRUE;
		}
	}
	
	
	public function ajax(){
	  $gender ='';
	  if(isset($_POST['gender']) && $_POST['gender'] != 0  ){
	   if($_POST['gender'] == 1){
	     $gender .= " and gender = 'male'";
	   }else{
	     $gender .= " and gender = 'female'";
	   }
	  }
	  
	  $int = '';
	  if(isset($_POST['interest']) && $_POST['interest'] != 0  ){
	    $ter = explode('/',$_POST['interest']);
		$temp = implode(',',array_filter($ter));
	    $int = $temp;
		$gender .= " and interest in (".$int.")";
	  }
	  
	  
	  
	  /******************************************************/
	    
		if( ( isset($_POST['range']) && $_POST['range'] > 0 ) && ( isset($_POST['zip']) && $_POST['zip'] > 0 )){
		
		        $outll = $this->db->query('select * from zips where zip='.$_POST['zip'])->result_array();
		
		//checking latitude and longitude
		/*$url ="http://maps.googleapis.com/maps/api/geocode/json?address=".$_POST['zip']."&sensor=false";
        try{ */
                  # $res = json_decode(file_get_contents($url));	
 				  # if( $res->status == 'OK' ){
				  if( count($outll) > 0  ){
				  	//entered correct zip - check for zipcodes in the range
                    $r    = 3959;
                    $d    = $_POST['range'];
					#$lat1 = $res->results[0]->geometry->location->lat;
                    #$lon1 = $res->results[0]->geometry->location->lng;
					
					$lat1 = $outll[0]['lat'];
                    $lon1 = $outll[0]['lng'];
					
                    //compute max and min latitudes / longitudes for search square
                    $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));
                    $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
                    $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
                    $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
					$gender .= " and zipcode in ('select zipcode from users where (lat <= ".$latN." AND lat >= ".$latS." AND lon <= ".$lonE." AND lon >= ".$lonW.") AND (lat != ".$lat1." AND lon != ".$lon1.")')";
					//display information about starting point
                    //provide max and min latitudes / longitudes					  
				   }else{
				     $gender .= " and zipcode ='aer' ";
					
				   }
		/*}catch(Exception $e) {}*/
		
		}
		
		
	  /******************************************************/
	  if(isset($_POST['age']) && $_POST['age'] != 0  ){
	   if($_POST['age'] == 1){
	     $gender .= " and age = 1 ";
	   }else if($_POST['age'] == 2 ){
	     $gender .= " and age = 2 ";
	   }else if($_POST['age'] == 3 ){
	     $gender .= " and  age= 3 ) ";
	   }else if($_POST['age'] == 4 ){
	     $gender .= " and  age = 4 ";
	   }else if($_POST['age'] == 5 ){
	     $gender .= "  and  age = 5  ";
	   }else if($_POST['age'] == 6 ){
	     $gender .= "  and age = 6 ";
	   }else if($_POST['age'] == 7 ){
	     $gender .= "  and  age = 7  ";
	   }
	  }

	  
	  $sqlz = 'select users.id as uid,user_interest.user_id as did,user_interest.interest from users left join user_interest on user_interest.user_id = users.id where isadv = 0 and disable_flag = 0 '.$gender." group by users.id";
	  $this->session->set_userdata(array('sql' => $sqlz));
	  $out = $this->db->query($sqlz)->result_array();
	  
	  if( count($out) > 0 ){
	   $set_re   = $this->db->query('select * from settings')->result_array();	  
	   $per_user = $set_re[0]['val'];
	   $tat      = count($out)*$per_user;
	   $amtz     =  number_format((float)$tat, 2, '.', '');
	   $tper = ($set_re[1]['val']/100)*$tat;
	   $ttot = $tat - $tper;
	   $zbt_user = number_format((float)($ttot/count($out)), 2, '.', '');
	  }
      if(count($out) > 0 ){
	    echo json_encode( array('amount' =>$amtz,'amount_user' =>$zbt_user,'count' => count($out)));
	  }else{
	    echo json_encode(array('amount' =>0,'amount_user' =>0,'count' =>0));
	  }
      exit;
	}






	public function active($email =''){

		if($email !=""){

          $email = base64_decode($email);
          $this->db->query('update  users set disable_flag = 0  where email ="'.$email.'"');
          $this->session->set_flashdata('success','Your account is activated. Please login to continue.');
		  redirect('main/clientLogin');

		}else{

            redirect(base_url());
		}

	}
	
	
	public function ajax_one(){

		if( isset( $_POST['survey'] ) && $_POST['survey'] > 0 ){
		 $survey   = $_POST['survey'];
         $question = $_POST['question'];
         $sort     = $_POST['sort'];	
         //fetch all questions of this survey
		 $result1 = $this->db->query('select * from survey_answers where question_id ='.$question)->result_array();
		 
		 		 
		 //fetching values
		   $i     = 0;
		   $total = $this->db->query('select * from client_answes where question_id ='.$question.' and survey_id='.$survey)->result_array();
		   $total = count($total);   
		   if($sort == 1){
			 //condition for total 
			 foreach($result1 as $row => $val){
				$ans[$i]['ans'] = $val['answer'];
				//fetching total user vote for this answer
				$total_ans = $this->db->query('select * from client_answes where question_id ='.$question.' and survey_id="'.$survey.'" and answer_id='.$val['id'])->result_array();
		        $totalz = count($total_ans);
				$ans[$i]['total'] = $totalz;
				if( $total == 0 ){
				    $ans[$i]['per']   = 0;
				}else{
				   if($totalz > 0 ){
				     //calculate percentage here
					 $ans[$i]['per'] = ($totalz/$total)*100;
				   }else{
			         $ans[$i]['per'] = 0;
				   }
				}
				//calculating age group percentage
				$i++;
			  }//end of total condition  
              $he = $this->load->view('vendor_only/allres',array('ans' =>$ans),true);
			  $he_comm = $this->load->view('vendor_only/allres_comment',array('survey'=>$survey,'question'=>$question),true); 	
              echo json_encode(array('question' => $he,'comment' => $he_comm));			  
            }//filter all
			
			if($sort == 2){
			    //condition for total 
			 foreach($result1 as $row => $val){
				$ans[$i]['ans'] = $val['answer'];
				
				
				//fetching total user vote for this answer
				$total_ans_male   = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.' and users.gender="male" and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
				$total_ans_female = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.' and users.gender="female" and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
		        $totalz_male = count($total_ans_male);
				$totalz_female = count($total_ans_female);
				$ans[$i]['total_male'] = $totalz_male;
				$ans[$i]['total_female'] = $totalz_female;
	
				if( $total == 0 ){
				    $ans[$i]['per']   = 0;
					$ans[$i]['male_per'] = 0;
					$ans[$i]['female_per'] = 0;
				}else{
				   if($totalz_male > 0 ){
				     //calculate percentage here
					 $ans[$i]['male_per'] = ($totalz_male/$total)*100;
				   }else{
			         $ans[$i]['male_per'] = 0;
				   }
				   
				   if($totalz_female > 0 ){
				     //calculate percentage here
					 $ans[$i]['female_per'] = ($totalz_female/$total)*100;
				   }else{
			         $ans[$i]['female_per'] = 0;
				   }
				}
				//calculating age group percentage
				$i++;
			  }//end of total condition  
			  
              $he = $this->load->view('vendor_only/genderallres',array('ans' =>$ans),true);
			  $he_comm = $this->load->view('vendor_only/allres_comment',array('survey'=>$survey,'question'=>$question),true); 	
              echo json_encode(array('question' => $he,'comment' => $he_comm));	
			}
			
			
			if( $sort == 3 ){
			    //condition for total 
			 foreach($result1 as $row => $val){
				$ans[$i]['ans'] = $val['answer'];
     			//fetching total user vote for this answer
				$total_ans_1   = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.'  and  users.age = 1    and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
				$total_ans_2 = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.' and  users.age =2 and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
  
  $total_ans_3   = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.' and  users.age = 3 and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
				$total_ans_4 = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.' and  users.age = 4 and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
  
  
  $total_ans_5   = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.' and  users.age =5 and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
				$total_ans_6 = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.' and  users.age =6 and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
  
  $total_ans_7   = $this->db->query('select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.answer_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where client_answes.question_id ='.$question.' and users.age = 7  and client_answes.survey_id="'.$survey.'" and client_answes.answer_id='.$val['id'])->result_array();
				
		        $totalz_1 = count($total_ans_1);
				$totalz_2 = count($total_ans_2);
				$totalz_3 = count($total_ans_3);
				$totalz_4 = count($total_ans_4);
				$totalz_5 = count($total_ans_5);
				$totalz_6 = count($total_ans_6);
				$totalz_7 = count($total_ans_7);
	
	
				$ans[$i]['total_1'] = $totalz_1;
				$ans[$i]['total_2'] = $totalz_2;
				$ans[$i]['total_3'] = $totalz_3;
				$ans[$i]['total_4'] = $totalz_4;
				$ans[$i]['total_5'] = $totalz_5;
				$ans[$i]['total_6'] = $totalz_6;
				$ans[$i]['total_7'] = $totalz_7;

	
				if( $total == 0 ){
				    $ans[$i]['per']   = 0;
					$ans[$i]['per_1'] = 0;
					$ans[$i]['per_2'] = 0;
					$ans[$i]['per_3'] = 0;
					$ans[$i]['per_4'] = 0;
					$ans[$i]['per_5'] = 0;
					$ans[$i]['per_6'] = 0;
					$ans[$i]['per_7'] = 0;

				}else{
				   if($totalz_1 > 0 ){
				     //calculate percentage here
					 $ans[$i]['per_1'] = ($totalz_1/$total)*100;
				   }else{
			         $ans[$i]['per_1'] = 0;
				   }
				   if($totalz_2 > 0 ){
				     //calculate percentage here
					 $ans[$i]['per_2'] = ($totalz_2/$total)*100;
				   }else{
			         $ans[$i]['per_2'] = 0;
				   }
				   if($totalz_3 > 0 ){
				     //calculate percentage here
					 $ans[$i]['per_3'] = ($totalz_3/$total)*100;
				   }else{
			         $ans[$i]['per_3'] = 0;
				   }
				   if($totalz_4 > 0 ){
				     //calculate percentage here
					 $ans[$i]['per_4'] = ($totalz_4/$total)*100;
				   }else{
			         $ans[$i]['per_4'] = 0;
				   }
				   if($totalz_5 > 0 ){
				     //calculate percentage here
					 $ans[$i]['per_5'] = ($totalz_5/$total)*100;
				   }else{
			         $ans[$i]['per_5'] = 0;
				   }
				   if($totalz_6 > 0 ){
				     //calculate percentage here
					 $ans[$i]['per_6'] = ($totalz_6/$total)*100;
				   }else{
			         $ans[$i]['per_6'] = 0;
				   }
				   if($totalz_7 > 0 ){
				     //calculate percentage here
					 $ans[$i]['per_7'] = ($totalz_7/$total)*100;
				   }else{
			         $ans[$i]['per_7'] = 0;
				   }
				   
				   
				}
				//calculating age group percentage
				$i++;
			  }//end of total condition  
			  
              $he = $this->load->view('vendor_only/ageallres',array('ans' =>$ans),true);
			  $he_comm = $this->load->view('vendor_only/allres_comment',array('survey'=>$survey,'question'=>$question),true); 	
              echo json_encode(array('question' => $he,'comment' => $he_comm));	
			}
            			
			
		}else{
          echo "hi";
           
		}
        exit;
	}
  
   

}