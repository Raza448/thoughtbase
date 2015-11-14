<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*******************
* client model 
********************************************/
class Client extends CI_Model
{	
   
   //register client
   //@param array
   //@return insert id       
   function insertClient($data){
      unset($data['userName']);
	  unset($data['confirm_password']);
	   unset($data['contact_number']);
	  $data['password'] = base64_encode($data['password']);
	  $data['register_date'] = date('Y-m-d H:i:s');
	  $data['disable_flag']  = 1;
      $this->db->insert('users',$data);
	  return $this->db->insert_id();
   } 
   
   //inserting in to client table
   //@param array
   function insertClientTable($data){
      $this->db->insert('clients',$data);
   }
   
   
   //get client details
   //@param email 
   //@param password
   //@return array  
   function getClient($email,$password){
      $this->db->where('users.disable_flag',0);
	  $this->db->where('users.isadv',0);
      $this->db->where('users.email',$email);
	  $this->db->where('users.password', base64_encode($password) );
	  $this->db->select('users.id, users.email,users.password,clients.contact_name,clients.user_id')->from('users')->join('clients', 'users.id = clients.user_id');
	  return $this->db->get()->result_array();
   }
   
   
    function getUsers($email,$password){
     $this->db->where('users.email',$email);
	  $this->db->where('users.password', base64_encode($password) );
	  return $this->db->get('users')->result_array();
   }
   
   //get client details
   //@param email 
   //@param password
   //@return array  
   function getClientById($id){
      $this->db->where('users.id',$id);
	  $this->db->select('users.id,users.age,users.gender,users.zipcode, users.email,users.movies,users.age,users.music,users.business,users.pemail, users.newsletter,users.password,clients.contact_name,clients.user_id,clients.contact_number')->from('users')->join('clients', 'users.id = clients.user_id');
	  return $this->db->get()->result_array();
   }
   
   //update client user data
   //@param id 
   //@param array
   function updateClientUser($id,$data){
      $this->db->where('id',$id);
      $this->db->update('users',$data);
     
   }
   
   
   //@param array
   function emailDuplication($id,$email){
      $this->db->where('id !=',$id);
	  $this->db->where('email',$email);
      return $this->db->get('users')->result_array(); 
   }
   
   //update client data
   //@param id 
   //@param array
   function updateClient($id,$data){
      $this->db->where('user_id',$id);
      $this->db->update('clients',$data);
   }
   
   function getBids($id){
      $query = "select bid.post_id,bid.id,bid.shortlisted,bid.vendor_id,bid.quotation,bid.comment,vendors.user_id,vendors.name from bid 
	            left join vendors on vendors.user_id = bid.vendor_id
				where post_id =".$id;
	  $out = $this->db->query($query);
	  return $out->result_array();
   }
   
   function placeBid($data){
      $this->db->insert('bid',$data);
   }
   
    function placeReview($data){
      $this->db->insert('review',$data);
   }
    
   
          
}