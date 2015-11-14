<?php 
function get_main_event($id)
{
    $name ="";
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select event_name from event_types where event_id =$id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp) > 0 ){
	     return $temp[0]['event_name'];
	  }
	}
	return $name;
}



function get_event($id)
{
    $name ="";
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select event_parent,me_name  from event_types 
	  left join main_event_types on event_parent = me_id where event_id =$id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp) > 0 ){
	     $name = $temp[0]['me_name'];
	  }
	}
	return $name;
}


function get_vendor_cat($id){
      $name =array();
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select category_id from vendor_cat_list where vendor_id = $id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp) > 0 ){
	    foreach($temp as $row => $kal){
	     $name[] = $kal['category_id'];
		}
	  }
	}
	return $name;
}



function get_vendor_bid($id){
   $name =array();
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select * from bid  where vendor_id = $id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp) > 0 ){
	    foreach($temp as $row => $kal){
	     $name[] = $kal['post_id'];
		}
	  }
	}
	return $name;



}


function get_vendor_bid_short($id){
   $name =array();
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select * from bid  where vendor_id = $id and shortlisted=1";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp) > 0 ){
	    foreach($temp as $row => $kal){
	     $name[] = $kal['post_id'];
		}
	  }
	}
	return $name;



}


function get_num_bid($id){
  $name =0;
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select * from bid  where post_id = $id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  $name = count($temp);
	}
	return $name;

}


function vendor_reg($id){
  $name ='';
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select register_date from users  where id = $id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp)>0){
	    $name = date('Y/m/d',strtotime($temp[0]['register_date']));
	  }
	}
	return $name;

}


function vendor_cname($id=0){
  $name ='';
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select vc_name from vendor_categories  where vc_id = $id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp)>0){
	    $name = $temp[0]['vc_name'];
	  }
	}
	return $name;

}

function getOwner($id=0){
 $name =0;
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select user_id from post  where post_id = $id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp)>0){
	    $name = $temp[0]['user_id'];
	  }
	}
	return $name;
 
}

function get_det_cli($id){
$name =array();
    if($id > 0){
	  $CI =& get_instance();
	  $query = "select users.id as kid,users.email,clients.contact_name from users
	  left join clients on clients.user_id = users.id
	  where users.id = $id";
	  $out = $CI->db->query($query);
	  $temp = $out->result_array();
	  if(count($temp)>0){
	    $name = $temp;
	  }
	}
	return $name;




}