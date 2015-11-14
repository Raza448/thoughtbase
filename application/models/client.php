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
	  $data['disable_flag']  = 0;
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
   
   
    function getUsers($username,$password){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('username',$username);
		$this->db->where('password', base64_encode($password));
		$query =  $this->db->get();
		$data = false;
		if($query->num_rows() > 0)
		{
			return $data = $query->result_array();
		}
		else
		{
			$this->db->select("*");
			$this->db->from("users");
			$this->db->where('email',$username);
			$this->db->where('password', base64_encode($password));
			$query1 =  $this->db->get();
			if($query1->num_rows() > 0)
			{
				return $data = $query1->result_array();
			}
		}
		
		
   }
   
   //get All Users details
   function getAllUsers(){
    //return $this->db->get('users')->result_array();
	return $this->db->query("SELECT *,DATE_FORMAT(register_date,'%d-%m-%Y') AS date FROM `users` ORDER BY `users`.`register_date` DESC")->result_array();
   }
   
   function getClientUsers($date){
	if($date !='' && $date != 'all'){
		return $this->db->query("SELECT *,DATE_FORMAT(register_date,'%d-%m-%Y') AS date FROM `users` WHERE isadv=0 and register_date > '$date' ORDER BY `users`.`register_date` DESC")->result_array();
	}else{
		//return $this->db->get('users')->result_array();
		return $this->db->query("SELECT *,DATE_FORMAT(register_date,'%d-%m-%Y') AS date FROM `users` WHERE isadv=0 ORDER BY `users`.`register_date` DESC")->result_array();
	}
    
   }
   
   //get All Interests
   function getAllCategories(){
    return $this->db->get('interests')->result_array();
   }
   
   //get Interests By Id
   function getCategoryById($id){
    $this->db->where('interests.id',$id);
    $this->db->select('*');
    $this->db->from('interests');
	return $this->db->get()->row_array();
   }
   
   //get Question By Id
   function getQuestionById($id){
    $this->db->select('*');
    $this->db->from('survey_questions');
	$this->db->where('id',$id);
	return $this->db->get()->row_array();
   }
   
   //get Answer By Id
   function getAnswerById($id){
    $this->db->select('*');
    $this->db->from('survey_answers');
	$this->db->where('question_id',$id);
	return $this->db->get()->result_array();
   }
   
   /* function getAnswerById($template_id, $id){
    $this->db->select('*');
    $this->db->from('survey_answers');
	$this->db->where('template_id',$template_id);
	$this->db->where('question_id',$id);
	return $this->db->get()->result_array();
   } */
   
   function getCustomAnswerById($id){
    $this->db->select('*');
    $this->db->from('custom_answer');
	$this->db->where('question_id',$id);
	return $this->db->get()->result_array();
   }
   
   //Add Interests
   function AddCategory($post_data){
	$this->db->set($post_data);
    $this->db->insert('interests');
   }
   
   //Add Questions
   function addQuestion($post_data){
	$this->db->set($post_data);
    $this->db->insert('survey_questions');
	$insert_id = $this->db->insert_id();
	return $insert_id;
   }
   
   function addCustomQuestion($post_data){
	unset($post_data['question_id']);
	$this->db->set($post_data);
    $this->db->insert('custom_questions');
	$insert_id = $this->db->insert_id();
	return $insert_id;
   }
   
   //Add Templates
   function addTemplate($post_data){
	$this->db->set($post_data);
    $this->db->insert('survey_category');
	$insert_id = $this->db->insert_id();
	return $insert_id;
   }
   
   //Add Answer
   function addAnswer($id,$answer, $template_id){
	$this->db->set('question_id', $id);
	$this->db->set('template_id', $template_id);
	$this->db->set($answer);
    $this->db->insert('survey_answers');
   }
   
   function addCustomAnswer($id, $answer, $user_id, $template_id){
	$this->db->set('question_id', $id);
	$this->db->set('user_id', $user_id);
	$this->db->set('template_id', $template_id);
	$this->db->set('answer', $answer);
    $this->db->insert('custom_answer');
   }
   
   //Add Answers Based on ID
   function addAnswerById($id,$answer){
	$this->db->set($answer);
	$this->db->set('question_id',$id);
	$this->db->set('cat','1');
    $this->db->insert('survey_answers');
   }
   
   function addCustomAnswerById($id, $answer, $user_id, $template_id){
	$this->db->set($answer);
	$this->db->set('question_id',$id);
	$this->db->set('user_id', $user_id);
	$this->db->set('template_id', $template_id);
    $this->db->insert('custom_answer');
   }
   
   //Update Interests By Id
   function updateCategoryById($post_data,$id){
	$this->db->set($post_data);
	$this->db->where('id',$id);
    $this->db->update('interests');
   }
   
   //get Questions Based on Template
   function getTemplateQuestions($id){
    $this->db->select('*');
    $this->db->from('survey_questions');
	$this->db->where('survey_id',$id);
	$this->db->order_by('ans_type');
    return $this->db->get()->result_array();
	}
	
	//get Customize Template Based on Template ID
   function getCustomizeTemplate($id, $user_id){
    $this->db->select('*');
    $this->db->from('survey_temp');
	$this->db->where('template',$id);
	$this->db->where('user_id',$user_id);
	$this->db->where('paid','0');
	$this->db->where('customize','1');
	$this->db->order_by('id','DESC');
    return $this->db->get()->row_array();
	}
	
	function getTemplateQuestionsExceptId($survey_id,$id){
    $this->db->select('*');
    $this->db->from('survey_questions');
	$this->db->where('survey_id',$survey_id);
	$this->db->where('id !=',$id);
    return $this->db->get()->result_array();
	}
	
   function getCustomTemplateQuestions($id, $user_id, $survey_id){
    $this->db->select('*');
    $this->db->from('custom_questions');
	$this->db->where('template_id',$id);
	$this->db->where('user_id',$user_id);
	$this->db->order_by('id', 'DESC');
	$data = $this->db->get()->row();
	if($data){
		$survey_id = $data->survey_id;
	}
	return $this->db->get_where('custom_questions',array('survey_id'=>$survey_id, 'template_id'=>$id))->result_array();
	}
	
	 //get Questions Based on Question Category.
   function getQuestionsByCat($id,$cat_id){
    $this->db->select('*');
    $this->db->from('survey_questions');
	$this->db->where('survey_id',$id);
	$this->db->where('question_cat',$cat_id);
    return $this->db->get()->result_array();
	}
   
   //get All Questions
   function getAllTemplates(){
    return $this->db->get('survey_category')->result_array();
   }
   
   //get Template By Id.
   function getTemplateById($id){
    $this->db->select('*');
    $this->db->from('survey_category');
	$this->db->where('id',$id);
    return $this->db->get()->row_array();
   }
   
   function getCustomQuestion($id, $user_id, $survey_id){
    $this->db->select('*');
    $this->db->from('custom_questions');
	$this->db->where('id',$id);
	$this->db->where('user_id',$user_id);
	$this->db->where('survey_id',$survey_id);
    return $this->db->get()->row_array();
   }
   
   //get client details
   //@param email 
   //@param password
   //@return array  
   function getClientById($id){
      $this->db->where('users.id',$id);
	  $this->db->select('users.id,users.age,users.username,users.gender,users.zipcode, users.email,users.movies,users.age,users.music,users.business,users.pemail, users.newsletter,users.password,users.disable_flag,clients.contact_name,clients.user_id,clients.contact_number')->from('users')->join('clients', 'users.id = clients.user_id');
	  return $this->db->get()->result_array();
   }
   
   //update client user data
   //@param id 
   //@param array
   function updateClientUser($id,$data){
	if(empty($data['password']))
	{
		if(empty($data['username'])){
		 unset($data['username']);
		}
		unset($data['password']);
		$this->db->where('id',$id);
		$this->db->update('users',$data);

	}
	else
	{	
	  if(empty($data['username'])){
		unset($data['username']);
		$this->db->where('id',$id);
		$this->db->update('users',$data);
	  }else{
		$this->db->where('id',$id);
		$this->db->update('users',$data);
	  }
	}
	
   }
   
    //update User Interest
   //@param id 
   //@param array
   function updateUserInterest($data){
		print_r($data);
		$this->db->where('user_id', $data['user_id']);
		$this->db->delete('user_interest');
		
		$this->db->set('user_id', $data['user_id']);
		$this->db->set('interest', $data['interest']);
		$this->db->insert('user_interest'); 
		/*$this->db->set('user_id', $data['user_id']);
		$this->db->set('interest', $data['interest']);
		$this->db->insert('user_interest');*/
	} 
	//update User Interest
   //@param id 
   //@param array
   function deleteInterest($data){
		$this->db->set('user_id', $data['user_id']);
		$this->db->set('interest', $data['interest']);
		$this->db->insert('user_interest');
	}
	
	function deleteAnswerById($id){
		$this->db->where('question_id', $id);
		$this->db->delete('survey_answers');
	} 
	
	function deleteCustomAnswerById($id){
		$this->db->where('question_id', $id);
		$this->db->delete('custom_answer');
	} 
	
	function removeAnswerById($answer,$id){
		$this->db->where('question_id', $id);
		$this->db->where('answer', $answer);
		$this->db->delete('survey_answers');
	} 
	
	//Delete Interest Based On ID
   function deleteInterestById($id){
		$this->db->where('id', $id);
		$this->db->delete('interests');
	} 
	
	//Delete Question Based On ID
   function deleteQuestionById($id){
		$this->db->where('id', $id);
		$this->db->delete('survey_questions');
	} 
	
	//Delete Question Based On ID
   function deleteCustomQuestions($id, $user_id){
		$this->db->where('template_id', $id);
		$this->db->where('user_id', $user_id);
		$this->db->delete('custom_questions');
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
   
   //update Survey Question
   //@param id 
   //@param array
   function updateQuestion($id,$data){
      $this->db->where('id',$id);
      $this->db->update('survey_questions',$data);
   }
   
   function updateCustomQuestion($id,$data){
      $this->db->set('question',$data);
	  $this->db->where('id',$id);
      $this->db->update('custom_questions');
   }
   
   function updateTemplate($id,$data){
      $this->db->where('id',$id);
      $this->db->update('survey_category',$data);
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
    
   //Activate client/ Advertiser
   //@param id 
   //@param array
   function actUserById($id,$flag){
	   if($flag == 0){
		  $this->db->set('disable_flag',1);
		  $this->db->where('id',$id);
		  $this->db->update('users');
	   }else{
		  $this->db->set('disable_flag',0);
		  $this->db->where('id',$id);
		  $this->db->update('users');
	   }
   }
   
    //get Users By Id
   function getUsersById($id){
    $this->db->where('users.id',$id);
    $this->db->select('*');
    $this->db->from('users');
	return $this->db->get()->row_array();
   } 
   
   //Enable template/ Disable
   //@param id 
   //@param array
   function actTemplateById($id,$flag){
	   if($flag == 0){
		  $this->db->set('status',1);
		}else{
		  $this->db->set('status',0);
		}
	   $this->db->where('id',$id);
		$this->db->update('survey_category');
   }

	//get Templates By Id
   function getTemplatesById($id){
    $this->db->where('survey_category.id',$id);
    $this->db->select('*');
    $this->db->from('survey_category');
	return $this->db->get()->row_array();
   }
   
   function getAdmin($id){
	$this->db->where('admin.id',$id);
    $this->db->select('*');
    $this->db->from('admin');
	return $this->db->get()->row_array();
   }
}