<?php
class Clients extends CI_Controller {
    // Layout used in this controller
	public $layout_view = 'layout/default';
	
	function __construct() {
	      parent::__construct();
		  $this->load->library('layout');
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->lang->load('message', 'english');
		  $this->load->helper('event');
		 
	}
 
	//edit client user profile
	public function profile(){
   	      //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
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
				  $this->client->updateClientUser($this->session->userdata('client_id'),array('password'=>base64_encode($this->input->post('password'))));
				  $this->session->set_flashdata('success',$this->lang->line('account_edit'));
				  redirect('clients/profile');
				}
		    }
			
			if(isset($_POST['submit'])){
			
			   $qui = "delete from  user_interest where user_id =".$this->session->userdata('client_id');
			   $this->db->query($qui);
			   
			   if( count($_POST['interest']) > 0){
			     foreach($_POST['interest'] as $row => $val ){
			           $qu = "INSERT INTO user_interest VALUES(null,".$this->session->userdata('client_id').",".$val.")";
					   $this->db->query($qu);
			     }
			   }
			
			    $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
				$this->form_validation->set_rules('zipcode', 'zipcode', 'trim|required|integer');
				if($this->form_validation->run() == FALSE){
				  //form validation failed   
				  $client_data[0]['email'] = $this->input->post('email');
				  $client_data[0]['contact_number'] = $this->input->post('contact_number');
				  $client_data[0]['zip_code'] = $this->input->post('zip_code');
				 
				}else{
			      //check this email address exists
				  $res = $this->client->emailDuplication($this->session->userdata('client_id'),$this->input->post('email'));
				  if(count($res) > 0 ){
				    $this->session->set_flashdata('error',$this->input->post('email')." - ".$this->lang->line('email_exists'));
				    redirect('clients/profile');
				  }else{
					$this->client->updateClientUser($this->session->userdata('client_id'),array('age'=>$this->input->post('age'),'email'=>$this->input->post('email'),'gender'=>$this->input->post('gender'),'zipcode'=>$this->input->post('zipcode')));
					$this->client->updateClient($this->session->userdata('client_id'),array('contact_number'=>$this->input->post('contact_number')));
					$this->session->set_flashdata('success',$this->lang->line('account_edit'));
				    redirect('clients/profile');
				  }
				
				}
			
		   //end of password change check
		  }
          $this->layout->title('Edit Account');
		  $this->layout->view('client_profile',array('result' => $client_data[0]));
	
	}	
	
	
	 public function myPosts($id = 0){
	      $this->id =$id;
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
		  }
		  
		  //checking user post
		  if( isset($_POST['temp']) && $_POST['temp'] > 0  ){
		    $survey = $_POST['sid'];
			$amount = $_POST['amount'];
			$template = $_POST['temp'];
			$name   = $_POST['sname'];
			
			unset($_POST['sid']);
			unset($_POST['amount']);
			unset($_POST['temp']);
			unset($_POST['sname']);
			
		    if( $template == 4 )
			{ 
			    $ans =  mysql_escape_string($_POST['single_question']);
				$this->db->query('insert into client_answes (client_id,survey_id,comment)
 				values ('.$this->session->userdata('client_id').','.$survey.',"'.$ans.'")');
			   
			}
			else
			{
			   unset($_POST['type']);  
			   if( count($_POST) > 0 ){
			    foreach($_POST as $row => $val ){
				if($val != ""){
				 
                if(ctype_digit($val)){				 
				   $this->db->query('insert into client_answes (client_id,survey_id,question_id,answer_id,comment)
 				   values ('.$this->session->userdata('client_id').','.$survey.','.$row.','.$val.',"")');
				 }else{
				   $this->db->query('insert into client_answes (client_id,survey_id,question_id,comment)
 				   values ('.$this->session->userdata('client_id').','.$survey.','.$row.',"'.$val.'")');
				 
				 }
				  
				  
				  }
				} //end of foreach
			   }
			    
			
			
			
			}
			//transfer amount to user email address
			
			//get client email address
			$out_id = $this->db->query('select * from users where id='.$this->session->userdata('client_id'))->result_array(); 
			$cemail = $out_id[0]['email'];
			$payLoad=array();
$ppuserid ='testerz_api1.gmail.com';
$pppass   ='GY95C8GTDKCE2LKC';
$ppsig    ='Ah5uOOkZ9rndm3rkroenMoLxt4VbA.Ks.JOalqVSgPP.wXsancsbylXe';
$ppappid  ='APP-80W284485P519543T';

//prepare the receivers
$receiverList=array();
$counter=0;
$receiverList["receiver"][$counter]["amount"]=$amount;
$receiverList["receiver"][$counter]["email"]= $cemail;
$receiverList["receiver"][$counter]["paymentType"]="SERVICE";//this could be SERVICE or PERSONAL 
$receiverList["receiver"][$counter]["invoiceId"]=uniqid();//NB that this MUST be unique otherwise
//prepare the call
$payLoad["actionType"]="PAY";
$payLoad["cancelUrl"]="http://www.thoughtbase.net";//this is required even though it isnt used
$payLoad["returnUrl"]="http://www.thoughtbase.net";//this is required even though it isnt used
$payLoad["currencyCode"]="USD";
$payLoad["receiverList"]=$receiverList;
$payLoad["feesPayer"]="EACHRECEIVER";//this could be SENDER or EACHRECEIVER
$payLoad["sender"]["email"] = 'syed.wasi.abbas@hotmail.com';//the paypal email address of the where the money is coming from
//run the call
$API_Endpoint = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";
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

//analyse the output
$payKey = $response["payKey"];
$paymentExecStatus=$response["paymentExecStatus"];
$correlationId=$response["responseEnvelope"]["correlationId"];
$paymentInfoList = isset($response["paymentInfoList"]) ? $response["paymentInfoList"] : null;

if ($paymentExecStatus<>"ERROR") {
   //update user earnings
			 $this->db->query('insert into user_earnings (user_id,survey,date,amount)
 				   values ('.$this->session->userdata('client_id').',"'.$name.'","'.date('Y-m-d').'","'.$amount.'")');
		
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
   //deal with it
   
}
			$query = 'update clients_survey set completed = 1 where user_id = '.$this->session->userdata('client_id').' and survey_id ='.$survey;
			$this->db->query($query);
            $this->db->query('insert into completed_survey (user_id,survey_id) values ('.$this->session->userdata('client_id').','.$survey.')');
			//transfer amount to user   
			//redirect to user dashboard
		     $this->session->set_flashdata('success','You have successfully completed the query.');
			 redirect('clients/myPosts');
		  }
		  
		  //$this->session->set_userdata('clientAuth', true);
	      $this->layout->title('My Posts');
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
		  $this->layout->view('client_only/my_posts',$data);
	 }
	 
	 public function myEarnings(){
	 
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
		  }
		  //$this->session->set_userdata('clientAuth', true);
	      $this->layout->title('My Earnings');
	      $this->layout->view('client_only/my_earnings');
	 }
	 
	  public function withdraw(){
	 
	       //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
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
		    $this->layout->title('Vendor Profile');
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
		   redirect('main/clientLogin');
	  }
	  
    //edit client user profile
	public function payment() {
		  //checking user session if not redirect to login
		  if(!$this->session->userdata('clientAuth')){
		    redirect('main/clientLogin');
		  } 
	      $this->load->model('client');
		  $client_data = $this->client->getClientById($this->session->userdata('client_id'));		  
		   if($this->input->post()){
		   //checking post for changepassword	
			if( $this->input->post('act') == 'editaccount' ){
			    $this->form_validation->set_rules('pemail', 'Paypal Email Address', 'trim|required');
				if($this->form_validation->run() == FALSE){
				  //form validation failed   
				  $client_data[0]['pemail'] = $this->input->post('pemail');				 
				}else{
	   				$this->client->updateClientUser($this->session->userdata('client_id'),array('pemail'=>$this->input->post('pemail')));
					$this->session->set_flashdata('success','settings changed successfully');
				    redirect('clients/payment');			
				}	
			}
		   //end of password change check
		  }
	      $this->layout->title('Edit Payment settings');
		  $this->layout->view('client_payment',array('result' => $client_data[0]));
	}
	  
	  
	  
}