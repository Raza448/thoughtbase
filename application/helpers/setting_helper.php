<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_social_icon($meta_key){
    
    //get main CodeIgniter object
    $ci =& get_instance();
    
    //load databse library
    //$ci->load->database();
    
    //get data from database
    $result = $ci->db->query("SELECT * FROM site_meta_setting WHERE meta_key='$meta_key'")->row_array();
   // $result = $query;
    
        return $result['meta_value'];
    
    
}

function get_spam_words(){
	
	$ci =& get_instance();
	
	$check_fields = $ci->db->query('select * from site_meta_setting where meta_key="validate_fields"')->row_array();
	
	return $check_fields['meta_value'];
}

?>