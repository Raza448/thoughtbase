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
			$data['users'] = $this->client->getClientUsers();
			$data['business'] = $this->vendor->getAllBusiness();
			$data['queries'] = $this->event->getAllQueries();
			$data['submit_queries'] = $this->event->getSubmittedQueries();
			//echo '<pre>';
			//print_r($data['submit_queries']);
			$result = array();

			// Go over the data one by one
			foreach ($data['submit_queries'] as $item)
			{
				// Use the category name to identify unique categories
				$name = $item['survey_id'];

				// If the category appears in the auxiliary variable
				if (isset($result[$name]))
				{
					// Then add the orders total to it
					$result[$name]['user_email'] .= ', '.$item['user_email'];
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
			$data['submit_data'] = array_values($result);
			//print_r($data['submit_data']);
			
			$result1 = array();

			// Go over the data one by one
			foreach ($data['queries'] as $item1)
			{
				// Use the category name to identify unique categories
				$name1 = $item1['survey_id'];

				// If the category appears in the auxiliary variable
				if (isset($result1[$name1]))
				{
					// Then add the orders total to it
					$result1[$name1]['user_id'] .= ','.$item1['user_id'];
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
			$data['filter_data'] = array_values($result1);
			
			
			/* print_r($data['filter_data']);
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