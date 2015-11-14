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
<td style="padding-top:20px;">You have a new query from <?php echo $name ?> .<br />
To view this query, <a href="<?php echo site_url(); ?>/user/Profile?id=<?php echo base64_encode($id) ?>&token=<?php echo base64_encode($out['token']) ?>">login</a> to your account at ThoughtBase.
</td>
</tr>
<?php
}
else
{
?>
<tr>
<td style="padding-top:20px;">You have a new query from <?php echo $name ?> .<br />
To view this query, <a href="<?php echo site_url(); ?>">login</a> to your account at ThoughtBase.
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