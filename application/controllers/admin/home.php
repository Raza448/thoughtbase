<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Home extends CI_Controller {
	
	public $layout_view = 'layout/admin/default';
	
	function __construct() {
		
	  parent::__construct();
	  $this->load->library('layout');
	  $this->load->model('login_model');
	  $this->load->model('client');
	  $this->load->model('event');
	  $this->load->model('vendor');
	  $this->load->library('form_validation');
	  $this->load->helper('url');
	  $this->load->helper('setting');
	  $this->load->library('session');
	  $this->lang->load('message', 'english');
	}
	
	public function index() {
	
		$this->home();
	}
	
	
	function home() {
		if($this->session->userdata('admin'))
		{
			if(isset($_GET['user_date'])){
				$user_date = explode('/', $_GET['user_date']);
				$data['users'] = $this->client->getClientUsers($user_date[0]);
			}else{
				$data['users'] = $this->client->getClientUsers($user_date[0]='');
			}
			
			if(isset($_GET['business_date'])){
				$business_date = explode('/', $_GET['business_date']);
				$data['business'] = $this->vendor->getAllBusiness($business_date[0]);
			}else{
				$data['business'] = $this->vendor->getAllBusiness($business_date[0]='');
			}
			
			if(isset($_GET['query_date'])){
				$query_date = explode('/', $_GET['query_date']);
				$data['queries'] = $this->event->getAllQueries($query_date[0]);
			}else{
				$data['queries'] = $this->event->getAllQueries($query_date[0]='');
			}
			
			if(isset($_GET['submit_date'])){
				$submit_date = explode('/', $_GET['submit_date']);
				$data['submit_queries'] = $this->event->getSubmittedQueries($submit_date[0]);
			}else{
				$data['submit_queries'] = $this->event->getSubmittedQueries($submit_date[0]='');
			}
			
			
			
			
			$data['all'] = 'all';
			$data['last_day'] = date('Y-m-d', strtotime('-1 days', time()));
			$data['week'] = date('Y-m-d', strtotime('-7 days', time()));
			$data['month'] = date('Y-m-d', strtotime('-1 months', time()));
			$data['last_three'] = date('Y-m-d', strtotime('-3 months', time()));
			$data['year'] = date('Y-m-d', strtotime('-1 years', time()));
			//echo '<pre>';
			//print_r($data['submit_queries']);
			$result = array();

			// Go over the data one by one
			foreach ($data['queries'] as $item)
			{
				// Use the category name to identify unique categories
				$name = $item['survey_id'];

				// If the category appears in the auxiliary variable
				if (isset($result[$name]))
				{
					// Then add the orders total to it
					$result[$name]['user_id'] .= ','.$item['user_id'];
				}
				else // Otherwise
				{
					// Add the category to the auxiliary variable
					$result[$name] = $item;
				}
			}
			// Get the values from the auxiliary variable and override the
			// old $data array. This is not strictly necessary, but if you
			// want the indices to be numeric and in order then do this.
			$data['filter_data'] = array_values($result);
			
			$result1 = array();

			// Go over the data one by one
			foreach ($data['submit_queries'] as $item1)
			{
				// Use the category name to identify unique categories
				$name1 = $item1['survey_id'];

				// If the category appears in the auxiliary variable
				if (isset($result1[$name1]))
				{
					// Then add the orders total to it
					$result1[$name1]['user_email'] .= ', '.$item1['user_email'];
				}
				else // Otherwise
				{
					// Add the category to the auxiliary variable
					$result1[$name1] = $item1;
				}
			}
			// Get the values from the auxiliary variable and override the
			// old $data array. This is not strictly necessary, but if you
			// want the indices to be numeric and in order then do this.
			$data['submit_data'] = array_values($result1);
			/* print_r($data['submit_data']);
			echo '</pre>';
			exit; */
			$this->layout->view('admin/home', $data);
		}
		else
		{
			redirect('admin');
		}
	}
	
	function logout()
	{
	   $this->session->unset_userdata('admin');
	   $this->session->sess_destroy();
	   redirect('admin', 'refresh');
	}
}