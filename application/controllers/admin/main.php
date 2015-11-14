<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Main extends CI_Controller {
	
	public $layout_view = 'layout/admin/default';
	
	function __construct() {
		
	  parent::__construct();
	  $this->load->library('layout');
	  $this->load->model('client');
	  $this->load->model('event');
	  $this->load->model('vendor');
	  $this->load->library('form_validation');
	  $this->load->helper('url');
	  $this->load->helper('setting');
	  $this->load->library('session');
	  $this->lang->load('message', 'english');
	}
	
	public function index()
	{
		redirect('admin');
	}
	
	function users() {
	
		if($this->session->userdata('admin'))
		{
			$data['users'] = $this->client->getAllUsers();
			$this->layout->view('admin/user',$data);
		}
		else
		{
			redirect('admin');
		}
	
	}
	function edit_user()
	{
		if(isset($_GET['id']))
		{
			if(isset($_POST['update_user']))
			{
			   $qui = "delete from  user_interest where user_id =".$_GET['id'];
			   $this->db->query($qui);
			   if( count($_POST['interest']) > 0){
			     foreach($_POST['interest'] as $row => $val ){
			           $qu = "INSERT INTO user_interest VALUES(null,".$_GET['id'].",".$val.")";
					   $this->db->query($qu);
			     }
			   } 
				
				
				$client['contact_name'] = $_POST['contact_name'];
				$client['contact_number'] = $_POST['contact_number'];
				
				$client_user['age'] = $_POST['age'];
				$client_user['email'] = $_POST['email'];
				$client_user['gender'] = $_POST['gender'];
				$client_user['zipcode'] = $_POST['zipcode'];
				
				
				$this->client->updateClientUser($_GET['id'],$client_user);
				$this->client->updateClient($_GET['id'],$client);
			}else if(isset($_POST['update_vendor'])){
				$vendor['user_id'] = $_GET['id'];
				$vendor['company_name'] = $_POST['company_name'];
				$vendor['description'] = $_POST['description'];
				$vendor['fname'] = $_POST['fname'];
				$vendor['lname'] = $_POST['lname'];
				$vendor['uen'] = $_POST['uen'];
				$vendor['addr'] = $_POST['addr'];
				$vendor['city'] = $_POST['city'];
				$vendor['state'] = $_POST['state'];
				$vendor['zip'] = $_POST['zip'];
				$vendor['country'] = $_POST['country'];
				$vendor['contact_number'] = $_POST['contact_number'];
				$vendor_email = $_POST['vendor_email'];
				
				$this->vendor->updateVendor($_GET['id'],$vendor);
				$this->vendor->updateVendorEmail($_GET['id'],$vendor_email);
			}
			
			if($this->session->userdata('admin'))
			{
				$user = $this->client->getClientById($_GET['id']);
				$vendor = $this->vendor->getVendorById($_GET['id']);
				//print_r($vendor);
				if($user)
				{
					$this->layout->view('admin/edit_user',array('user' => $user[0]));
				}
				else
				{
					$this->layout->view('admin/edit_user',array('vendor' => $vendor[0]));
				}
				
				
			}
			
			
			else
			{
				redirect('admin');
			}
		}
	}
	
	function categories()
	{
		if($this->session->userdata('admin'))
		{
			$data['categories'] = $this->client->getAllCategories();
			$this->layout->view('admin/categories',$data);
		}
		else
		{
			redirect('admin');
		}
	
	}
	function edit_category()
	{
		if(isset($_POST['add_category']))
		{
			$post_data['name'] = $_POST['cat_name'];
			$this->client->AddCategory($post_data);
			redirect('admin/main/categories', 'refresh:0');
		}
		
		if(isset($_POST['upd_category']))
		{
			$post_data['name'] = $_POST['cat_name'];
			$this->client->updateCategoryById($post_data,$_GET['id']);
			redirect('admin/main/categories', 'refresh:0');
		}
		
		if(isset($_GET['id']))
		{
			$data['category'] = $this->client->getCategoryById($_GET['id']);
			$this->layout->view('admin/edit_category',$data);
		}
		else
		{
			$this->layout->view('admin/edit_category');
		}
	}
	function templates()
	{
		if($this->session->userdata('admin'))
		{
			$data['templates'] = $this->client->getAllTemplates();
			$this->layout->view('admin/templates',$data);
		}
		else
		{
			redirect('admin');
		}
	
	}
	function question_category()
	{
		if($this->session->userdata('admin'))
		{
			$this->layout->view('admin/question_category',$data);
		}
		else
		{
			redirect('admin');
		}
	
	}
	function survey_questions()
	{
		if($this->session->userdata('admin'))
		{
			if(isset($_GET['id']))
			{
				if(isset($_GET['ques_id']))
				{
				$data['questions'] = $this->client->getQuestionsByCat($_GET['id'],$_GET['ques_id']);
					if(empty($data['questions'])){
						$data['questions'] = $this->client->getTemplateQuestions($_GET['id']);
						$this->layout->view('admin/survey_questions',$data);
					}else{
						$this->layout->view('admin/survey_questions',$data);
					}
					
				}
				else
				{
					$data['questions'] = $this->client->getTemplateQuestions($_GET['id']);
					$this->layout->view('admin/survey_questions',$data);
				}
			}
			
		}
		else
		{
			redirect('admin');
		}
	
	}
	function add_template()
	{
		if(isset($_POST['add_template']))
		{
			$post_data['name'] = $_POST['title'];
			$post_data['status'] = '1';
			$template_id = $this->client->addTemplate($post_data);
			
			redirect('admin/main/templates');
		}
		$this->layout->view('admin/add_template');
	}
	
	function edit_template()
	{
		if(isset($_GET['id']))
		{
			if(isset($_POST['upd_template']))
			{
				$data['name'] = $_POST['temp_name'];
				$this->client->updateTemplate($_GET['id'],$data);
				redirect('admin/main/templates');

			}
			$query = $this->client->getTemplateById($_GET['id']);
			$data['template'] = $query;
			$this->layout->view('admin/edit_template',$data);
			
		}
		else
		{
			if(isset($_POST['add_template']))
			{
			$post_data['name'] = $_POST['title'];
			$post_data['status'] = '1';
			$post_data['type'] = $_POST['type'];
			$template_id = $this->client->addTemplate($post_data);
			
			redirect('admin/main/templates');
			}
			$this->layout->view('admin/edit_template');
		}
	}
	
	function edit_question()
	{
		if(isset($_GET['id']))
		{
			if(isset($_POST['upd_question']))
			{
				$data['question'] = $_POST['ques_name'];
				$this->client->deleteAnswerById($_GET['id']);
				$this->client->updateQuestion($_GET['id'],$data);
				$ans = count($_POST['answer']);
				for($i=0;$i<$ans;$i++)
				{
					if($_POST['answer'][$i] != ''){
						$answer['answer'] = $_POST['answer'][$i];
						$this->client->addAnswerById($_GET['id'],$answer);
					}
				}
			}
			$query = $this->client->getQuestionById($_GET['id']);
			$data['answers'] = $this->client->getAnswerById($query['id']);
			$data['question'] = $query;
			$this->layout->view('admin/edit_question',$data);
			
		}else{
			$this->layout->view('admin/edit_category');
		}
	}
	function add_questions()
	{
		if(isset($_GET['id']))
		{
			if(isset($_POST['add_question']))
			{
				if(!empty($_POST['question_category'])){
					$post_data['question_cat'] = $_POST['question_category'];
				}else{
					$post_data['question_cat'] = $_POST['question_cat'];
				}
				$post_data['ans_type'] = $_POST['ans_type'];
				if($_POST['ans_type'] == 1){
					$post_data['question'] = $_POST['ques'];
				}else{
					$post_data['question'] = $_POST['text_ques'];
				}
				$post_data['survey_id'] = $_POST['survey_id'];
				$ques_id = $this->client->addQuestion($post_data);
				if(isset($_POST['answer'])){
					$c = count($_POST['answer']);
					for($i=0;$i<$c;$i++)
					{
						if($_POST['answer'][$i] != ''){
						$answer['answer'] = $_POST['answer'][$i];
						$this->client->addAnswer($ques_id, $answer, $_GET['id']);
						}
					}
				}
				redirect('admin/main/templates', 'refresh:0');
			}
			$data['template'] = $this->client->getTemplateById($_GET['id']);
			$this->layout->view('admin/add_question',$data);
		}
	}
	function site_settings()
	{
		if($this->session->userdata('admin'))
		{
		
			if(isset($_POST['upd_site']))
			{
				$target = 'upload/';
				
				foreach($_POST as $k=>$v)
				{
				
					if(!in_array($k, array('upd_site'), true))
					{
						$meta_key = mysql_real_escape_string($k);
						$meta_value = mysql_real_escape_string($v);
						$val = $this->event->AddSiteSetting($meta_key, $meta_value);
						
						
							
					}
				}
				if(!empty($_FILES['logo']['name']))
				{
				if (!is_dir($target))
				{
					mkdir($target);
				}
				$r = rand(0,1234567890);
				$pic = $target.$r.$_FILES['logo']['name'];
				
				$query = $this->db->query("select * from site_meta_setting where meta_key='logo'")->row_array();
				
				if (!empty($query['meta_value']))
				{
				
					unlink($query['meta_value']);
					move_uploaded_file($_FILES['logo']['tmp_name'], $pic);
					$this->db->set('meta_value', $pic);
					$this->db->where('meta_key', 'logo');
					$this->db->update('site_meta_setting');

				}
				else
				{
					move_uploaded_file($_FILES['logo']['tmp_name'], $pic);
					$this->db->set('meta_key', 'logo');
					$this->db->set('meta_value', $pic);
					$this->db->insert('site_meta_setting');
				}
			
			}
			}
			$rows = $this->event->getAllSiteSettings();
			if(!empty($rows))
			{
				foreach($rows as $key => $meta){
					$data[$meta['meta_key']] = $meta['meta_value'];
				}
			}
			//print_r($data['setting']);
			$this->layout->view('admin/site_setting',$data);
			
		}
		else
		{
			redirect('admin');
		}
	
	}
	
	function delete_category()
	{
		if(isset($_GET['id']))
		{
		$query = $this->client->deleteInterestById($_GET['id']);
		redirect('admin/main/categories', 'refresh:0');
		}
	}
	function delete_question()
	{
		if(isset($_GET['id']))
		{
		$query = $this->client->deleteQuestionById($_GET['id']);
		$query = $this->client->deleteAnswerById($_GET['id']);
		if(isset($_GET['t_id']))
		{
			
			if(isset($_GET['ques_id']))
			{
				redirect('admin/main/survey_questions?id='.$_GET['t_id'].'&ques_id='.$_GET['ques_id'].'&type='.$_GET['type'].'', 'refresh:0');
			}
			redirect('admin/main/survey_questions?id='.$_GET['t_id'].'&type='.$_GET['type'].'', 'refresh:0');
		}
		}
	}
	function remove_answer()
	{
		if(isset($_GET['answer']))
		{
			if(isset($_GET['ques_id']))
			{
				$result = $this->client->getAnswerById($_GET['ques_id']);
				if(count($result) > 1){
					$query = $this->client->removeAnswerById($_GET['answer'], $_GET['ques_id']);
				}
				redirect('admin/main/edit_question?id='.$_GET['ques_id'].'&type='.$_GET['type'].'', 'refresh:0');
			}
		}
	
	}
	function deactivate_user()
	{
		if(isset($_GET['id']))
		{
			$user = $this->client->getUsersById($_GET['id']);
			
			$id = $user['id'];
			$flag = $user['disable_flag'];
			
			$this->client->actUserById($id,$flag);
			redirect('admin/main/users', 'refresh:0');
		}
	}
	
	function disable_template()
	{
		if(isset($_GET['id']))
		{
			$user = $this->client->getTemplatesById($_GET['id']);
			
			$id = $user['id'];
			$flag = $user['status'];
			
			$this->client->actTemplateById($id,$flag);
			redirect('admin/main/templates', 'refresh:0');
		}
	}
	function check_password(){
		$admin = $this->session->userdata('admin');
		foreach($admin as $data){
			$password = $data->password;
			$id = $data->id;
			$admin_details = $this->client->getAdmin($id);
			$admin_password = $admin_details['password'];
			$this->session->set_userdata('admin_id', $data->id);
		}
		$current_pass = md5($_GET['current_password']);
		if($admin_password == $current_pass){
			echo 'true';
		}else{
			echo 'false';
		}
		//$admin_details = $this->client->getAdmin($this->session->userdata('id'));
		//print_r($admin_details);
	}
	function change_password(){
		if(isset($_POST['pass'])){
			$password = md5($_POST['confirm_password']);
			
			$sql ="UPDATE admin SET password = '".$password."' where id ='".$this->session->userdata('admin_id')."'";
			
			$query = $this->db->query($sql);
				
			$this->session->set_flashdata('success','You have change your password.');
			
			redirect('admin/main/change_password');
		}
		
		
		$this->layout->view('admin/change_password');
	}
	
	
	
	
}