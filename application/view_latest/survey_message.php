<table width="650">
<!--<td  style="padding-top:40px;background-color:#0086C4;padding-bottom:10px;">
<b ><font style="font-size:22px !important;color:#fff;"><img src="<?=base_url('assets/img/logo.png') ?>" /> Thoughtbase.net</font></b><br />
</td>
</tr>
<tr>
<td style="padding-top:10px;">Dear <?php echo $name; ?></td>
</tr>-->
<?php
$out = $this->db->query("SELECT * FROM users WHERE id='$id' and profile='0'")->row_array();
if(!empty($out))
{
?>
<tr>
<td style="padding-top:20px;">You have a new query! <br /><br />
<?php echo $name ?><br />
<?php echo $survey_name ?><br />
<?php echo '$'.$p_amount.'.00' ?><br /><br />
To view this query, <a href="<?php echo site_url(); ?>/user/Profile?id=<?php echo base64_encode($id) ?>&token=<?php echo base64_encode($out['token']) ?>">login</a> to your account at ThoughtBase.
</td>
</tr>
<tr>
<td style="padding-top:40px;">
Don't have any account?<br />
Then you're probably wondering why you received this email.<br /><br /> 

ThoughtBase is a platform where you get paid cash instantly for simply providing your anonymous feedback. <?php echo $name ?> chose you because you're an existing customer. <br /><br />

To proceed, simply login to create your free anonymous account, complete this brief query, and you will receive an instant cash payment to your PayPal account.<br /><br />

Or to learn more, visit <a href="<?php echo site_url(); ?>">https://thoughtbase.com</a>
</td>
</tr>
<!--<tr>
<td style="padding-top:20px;">You have a new query from <?php echo $name ?> .<br />
To view this query, <a href="<?php echo site_url(); ?>/user/Profile?id=<?php echo base64_encode($id) ?>&token=<?php echo base64_encode($out['token']) ?>">login</a> to your account at ThoughtBase.
</td>
</tr>-->
<?php
}
else
{
?>
<tr>
<td style="padding-top:20px;">You have a new query! <br /><br />
<?php echo $name ?><br />
<?php echo $survey_name ?><br />
<?php echo '$'.$p_amount.'.00' ?><br /><br />
To view this query, <a href="<?php echo site_url(); ?>">login</a> to your account at ThoughtBase.
</td>
</tr>
<tr>
<td style="padding-top:40px;">
Don't have any account?<br />
Then you're probably wondering why you received this email.<br /><br /> 

ThoughtBase is a platform where you get paid cash instantly for simply providing your anonymous feedback. <?php echo $name ?> chose you because you're an existing customer. <br /><br />

To proceed, simply login to create your free anonymous account, complete this brief query, and you will receive an instant cash payment to your PayPal account.<br /><br />

Or to learn more, visit <a href="<?php echo site_url(); ?>">https://thoughtbase.com</a>
</td>
</tr>
<?php
}

?>

<tr>
<td style="padding-top:40px;"><img src="<?=base_url('assets/img/logo.png') ?>" style="width:70px;" /> </td>
</tr>
<tr>
<tr>
<td style="padding-top:10px;padding-bottom:10px;">
&nbsp;<i>&copy; 2015 ThoughtBase Inc.</i>
</td>
</tr>
</table>