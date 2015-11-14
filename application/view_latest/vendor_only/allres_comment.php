<?php
 $sql ='select client_answes.id as kid,client_answes.comment,client_answes.client_id,client_answes.survey_id,client_answes.question_id,
 users.age,users.gender,users.zipcode from client_answes left join users on
  client_answes.client_id = users.id where
  client_answes.survey_id='.$survey.' and client_answes.question_id='.$question;
 $data_img = $this->db->query($sql)->result_array();  
?>
<?php if(count($data_img ) > 0 ){  
foreach($data_img as $row => $val ){
?>
<div>
<?php echo $val['comment']; ?>
<h6><i class="fa fa-star"></i>Age:<?php echo $val['age']; ?> <i class="fa fa-star"></i>Gender:<?php echo $val['gender']; ?> <i class="fa fa-star"></i>Zip:<?php echo $val['zipcode']; ?> </h6>
</div>
<br />
<?php }}else{ ?>
<div>
No Comments yet
<h6 style="display:none;"><i class="fa fa-star"></i>Age:~ <i class="fa fa-star"></i>Gender:~ <i class="fa fa-star"></i>Zip:~ </h6>
</div>
<br />
<?php } ?>