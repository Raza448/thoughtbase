<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*******************
* vendor model 
********************************************/
class Vendor extends CI_Model
{	
   
   //register client
   //@param array
   //@return insert id       
   function insertVendor($data){
      unset($data['userName']);
      unset($data['fname']);
      unset($data['lname']);
      unset($data['city']);
      unset($data['state']);
      unset($data['zip']);
      unset($data['country']);
      unset($data['addr']);
	  unset($data['confirm_password']);
	  unset($data['contact_number']);
  	  unset($data['confirm_password']);
	  unset($data['company']);
      unset($data['uen']);
	  $data['password'] = base64_encode($data['password']);
	  $data['register_date'] = date('Y-m-d H:i:s');
	  $data['disable_flag']  = 1;
	  $data['isadv']        = 1;
      $this->db->insert('users',$data);
	  return $this->db->insert_id();
   } 
   
   //inserting in to client table
   //@param array
   function insertVendorTable($data){
	  unset($data['username']);
      $this->db->insert('vendors',$data);
   }
   
   
   function updateVendorImages($data){
      $this->db->insert('vendor_photos',$data);
   }
   
    function getVendorImages($id,$img_id){
	   $this->db->where('vendor_id',$id);
	   $this->db->where('id',$img_id);
	   return $this->db->get('vendor_photos')->result_array();
      
   }
   
    function deleteVendorImages($id,$img_id){
	  $this->db->where('vendor_id',$id);
	  $this->db->where('id',$img_id);
      $this->db->delete('vendor_photos');
   }
   
   
   function insertVendorCatList($data){
      $this->db->insert('vendor_cat_list',$data);
   }
   function deleteVendorCatList($id){
      $this->db->where('vendor_id',$id);
      $this->db->delete('vendor_cat_list');
   }
   
   
   //get client details
   //@param email 
   //@param password
   //@return array  
   function getVendor($email,$password){
      $this->db->where('users.email',$email);
	   $this->db->where('users.isadv','1');
	  $this->db->where('users.password', base64_encode($password) );
	  $this->db->select('users.id, users.email,users.password,vendors.name,vendors.user_id')->from('users')->join('vendors', 'users.id = vendors.user_id');
	  return $this->db->get()->result_array();
   }
   
    //get All Business details
   function getAllBusiness($date){
	  if($date != '' && $date != 'all'){
		  return $this->db->query("SELECT *,DATE_FORMAT(register_date,'%d-%m-%Y') AS date FROM `users` WHERE isadv=1 and register_date > '$date' ORDER BY `users`.`register_date` DESC")->result_array();
	  }else{
		  return $this->db->query("SELECT *,DATE_FORMAT(register_date,'%d-%m-%Y') AS date FROM `users` WHERE isadv=1 ORDER BY `users`.`register_date` DESC")->result_array();
	  }
	
   }
   
   //get client details
   //@param email 
   //@param password
   //@return array  
   function getVendorById($id){
      $this->db->where('users.id',$id);
	  $this->db->select('users.id, users.email,users.username,users.register_date,users.password,vendors.name,vendors.user_id,vendors.company_name,vendors.uen,vendors.contact_number,vendors.logo,vendors.website,vendors.address,vendors.description,vendors.fname,vendors.lname,vendors.city,vendors.state,vendors.zip,vendors.addr,vendors.country')->from('users')->join('vendors', 'users.id = vendors.user_id');
	  return $this->db->get()->result_array();
   }
   
   //update client user data
   //@param id 
   //@param array
   function updateVendorUser($id,$data){
      $this->db->where('id',$id);
      $this->db->update('users',$data);
     
   }
   
   
    //@param array
  //@param array
   function emailDuplication($id,$email){
      $this->db->where('id !=',$id);
	  $this->db->where('email',$email);
      return $this->db->get('users')->result_array(); 
   }
   
   //update client data
   //@param id 
   //@param array
   function updateVendor($id,$data){
      $this->db->where('user_id',$id);
      $this->db->update('vendors',$data); 
   }
   
   function updateVendorEmail($id,$data){
	  if(empty($data['password'])){
		  unset($data['password']);
		  $this->db->where('id',$id);
		  $this->db->update('users',$data);
	  }else{
		  $this->db->where('id',$id);
		  $this->db->update('users',$data);
	  }
   }
   
   
   function vendorCatType(){
      return $this->db->get('vendor_category_types')->result_array(); 
   }
   
   function vendorCat(){
      return $this->db->get('vendor_categories')->result_array(); 
   }
   
   function vendorCatId($id){
    $this->db->where('vc_parent',$id);
    return $this->db->get('vendor_categories')->result_array(); 
   }
   
   public function getImages($id){
	 $this->db->where('vendor_id',$id);
     return $this->db->get('vendor_photos')->result_array();
   }
   
    public function getCat($id){
	 $this->db->where('vendor_id',$id);
     return $this->db->get('vendor_cat_list')->result_array();
   }
   
    public function getReview($id){
	 $this->db->where('vendor_id',$id);
     return $this->db->get('review')->result_array();
   }
   
   public function getAllSiteSettngs(){
     return $this->db->get('site_meta_setting')->result_array();
   }
    
   
          
}