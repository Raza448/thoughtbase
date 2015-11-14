<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*******************
* Login model 
********************************************/

Class Login_model extends CI_Model
{
	public $table_name = 'admin';
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
/*******************
* Check Login 
********************************************/

	function check_login($login_data)
	{
	  $this->db->select("*");
	  $this->db->from($this->table_name);
	  $this->db->where($login_data);
	  
	  $query = $this->db->get();
	  $data = false;
	  if($query->num_rows() > 0)
	  {
		$data = $query->result();
		return $data;
	  }
	}
}