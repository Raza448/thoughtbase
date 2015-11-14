<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Login extends CI_Controller {

	// Layout used in this controller
	public $layout_view = 'layout/admin/default';
	
	function __construct() {
		
		//;
	
	      parent::__construct();
		  $this->load->model('login_model');
		  $this->load->library('layout');
		  $this->load->library('form_validation');
		  $this->load->helper('url');
		  $this->load->helper('setting');
		  $this->load->library('session');
		  $this->lang->load('message', 'english');
	}
	
	public function index() {
		//echo md5('admin');
		if($this->session->userdata('admin'))
		{
			redirect('admin/home');
		}
		else
		{
		$this->login();
		}
	}
	
	function login()
	{
		
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		
		if(isset($_POST['signin']))
		{
			
			if($this->form_validation->run() == FALSE)
			{
				$this->layout->view('admin/login');
				
			}
			else
			{
				$login_data['username'] = md5($_POST['username']);
				$login_data['password'] = md5($_POST['password']);
				
				/************** Check Login ******************/
				$check = $this->login_model->check_login($login_data); 
				if($check)
				{
					$this->session->set_userdata('admin', $check);
					if($this->session->userdata('admin'))
					{
						redirect('admin/home');
					}
				}
				else
				{
					$data["error"]="Invalid Username or Password ";
					$this->layout->view('admin/login', $data);
					
				}
			}
			
		}
		else
		{
			$this->layout->view('admin/login');
		}
	}
	
	
	

}

?>