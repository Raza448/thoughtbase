<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/*******************
* event model 
********************************************/
class Event extends CI_Model 
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
	  $data['disable_flag']  = 0;
      $this->db->insert('users',$data);
	  return $this->db->insert_id();
   } 
   
   //inserting in to client table
   //@param array
   function insertClientTable($data){
      $this->db->insert('clients',$data);
   }
   
   
   function getAll(){
      $this->db->where('me_status',1);
	  return $this->db->get('main_event_types')->result_array();
   }
   
   function getAllVendorCat(){
      $this->db->where('vc_status',1);
	  return $this->db->get('vendor_categories')->result_array();
   }
   
   function getSubTypes($id){
      $this->db->where('event_parent',$id);
	  return $this->db->get('event_types')->result_array();
   }
   
   //get client details
   //@param email 
   //@param password
   //@return array  
   function getClientById($id){
      $this->db->where('users.id',$id);
	  $this->db->select('users.id, users.email,users.business,users.movies,users.music,users.password,clients.contact_name,clients.user_id,clients.contact_number')->from('users')->join('clients', 'users.id = clients.user_id');
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
   
   
   function insertPost($data){
     $this->db->insert('post',$data);
   }
   
   function updatePost($id,$data){
     $this->db->where('post_id',$id);
	 $this->db->update('post',$data);
   }
   
   function getPost($id,$uid){
     $this->db->where('post_id',$id);
	 $this->db->where('user_id',$uid);
	 return $this->db->get('post')->result_array();
   }
   
   
   function getPostById($id){
     $this->db->where('post_id',$id);
	 return $this->db->get('post')->result_array();
   }
   
   function getParentEvent($eid){
     $this->db->where('event_types.event_id',$eid);
	 $this->db->select('event_types.*,main_event_types.*')->from('event_types')->join('main_event_types', 'event_types.event_parent = main_event_types.me_id');
	 return $this->db->get()->result_array();
   }
   
   
   function loadMyPosts($id){
     $query ="SELECT clients_survey.user_id as suid,clients_survey.survey_id,clients_survey.created_on,clients_survey.completed,
	 survey_temp.* from clients_survey left join survey_temp
	 on clients_survey.survey_id=survey_temp.id 
	 where clients_survey.user_id =".$id." and clients_survey.completed = 0 order by id desc";
    
	 return $this->db->query($query)->result_array();
   }
   
   function loadMyPosts1($id,$sid){
     $query ="SELECT clients_survey.user_id as suid,clients_survey.survey_id,clients_survey.created_on,clients_survey.completed,
	 survey_temp.* from clients_survey left join survey_temp
	 on clients_survey.survey_id=survey_temp.id 
	 where clients_survey.user_id =".$id." and clients_survey.completed = 0 and clients_survey.survey_id =".$sid." order by id desc";
     return $this->db->query($query)->result_array();
   }
   
    function loadMyPosts2($id){
     $query ="SELECT clients_survey.user_id as suid,clients_survey.survey_id,clients_survey.created_on,clients_survey.completed,
	 survey_temp.* from clients_survey left join survey_temp
	 on clients_survey.survey_id=survey_temp.id 
	 where clients_survey.user_id =".$id." and clients_survey.completed = 0 order by clients_survey.survey_id desc limit 0,1";
     return $this->db->query($query)->result_array();
   }
   
   
   function loadPosts(){
 	 $this->db->select('post.*,event_types.*')->from('post')->join('event_types', 'event_types.event_id = post.sub_event_type');
	 return $this->db->get()->result_array();
   }
   
    function loadMyPost($id,$uid){
     $this->db->where('post.user_id',$uid);
	 $this->db->where('post.post_id',$id);
	 $this->db->select('post.*,event_types.*')->from('post')->join('event_types', 'event_types.event_id = post.sub_event_type');
	  return $this->db->get()->result_array();
   }
   
   function getMainEventName($id){
     $this->db->where('me_id',$id);
	 return $this->db->get('main_event_types')->result_array();
   }
   
   function getVendorType($id){
     $this->db->where('vc_id',$id);
	 return $this->db->get('vendor_categories')->result_array();
   }
    
   function getAllSiteSettings(){
	 return $this->db->get('site_meta_setting')->result_array();
   }
   
   function AddSiteSetting($meta_key, $meta_value){
	
	$this->db->select("*");
	$this->db->from("site_meta_setting");
	$this->db->where('meta_key', $meta_key);
	
	$query = $this->db->get();
	
	if ($query->num_rows() > 0)
	{
	$this->db->set('meta_value', $meta_value);
	$this->db->where('meta_key', $meta_key);
	$this->db->update('site_meta_setting');
	
	}
	else
	{
	$this->db->set('meta_key', $meta_key);
	$this->db->set('meta_value', $meta_value);
	$this->db->insert('site_meta_setting');
	}
   }
   
   function getAllQueries($date){
	$this->db->select('ST.name as q_name, ST.created_on, VN.name as b_name, SC.name as s_name, CS.user_id as user_id, CS.survey_id as survey_id, US.email as user_email' );
	$this->db->from('survey_temp AS ST');// I use aliasing make joins easier
	$this->db->join('survey_category AS SC', 'ST.template = SC.ID', 'INNER');
	$this->db->join('clients_survey AS CS', 'ST.id = CS.survey_id', 'INNER');
	$this->db->join('vendors AS VN', 'ST.user_id = VN.user_id', 'INNER');
	$this->db->join('users AS US', 'US.id = CS.user_id');
	$this->db->where('ST.paid', 1);
	if($date != '' && $date != 'all'){
	$this->db->where('ST.created_on >=', $date);	
	}
	$this->db->order_by('ST.ID DESC');
	$result = $this->db->get()->result_array();
	return $result;
   }
   
   function getSubmittedQueries($date){
	$this->db->select('ST.name as q_name, ST.created_on, VN.name as b_name, SC.name as s_name, CS.user_id as user_id, CS.survey_id as survey_id, US.email as user_email' );
	$this->db->from('survey_temp AS ST');// I use aliasing make joins easier
	$this->db->join('survey_category AS SC', 'ST.template = SC.ID', 'INNER');
	$this->db->join('clients_survey AS CS', 'ST.id = CS.survey_id', 'INNER');
	$this->db->join('vendors AS VN', 'ST.user_id = VN.user_id', 'INNER');
	$this->db->join('users AS US', 'US.id = CS.user_id');
	$this->db->where('CS.completed', 1);
	if($date != '' && $date != 'all'){
	$this->db->where('CS.created_on >=', $date);	
	}
	$this->db->order_by('CS.ID DESC');
	$result = $this->db->get()->result_array();
	return $result;
   }
          
}