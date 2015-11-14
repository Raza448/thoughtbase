<table class="table table-bordered table-striped table-condensed mb-none">
<tr>
<td colspan="3" class="align_left"><span style="height:15px;width:15px;background:#6495ED;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;Male&nbsp;&nbsp;&nbsp;<span style="height:15px;width:15px;background:#E7766F;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;Female&nbsp;</td>

</tr>
<?php if( count($ans) > 0 ){
	 $total_male = '';
	 $total_female = '';
	/* echo '<pre>';
	print_r($ans);
	echo '</pre>'; */
  foreach($ans as $row => $bval ){
	  $total_male += $bval['total_male'];
	  $total_female += $bval['total_female'];
	  
  }} ?>
<?php if( count($ans) > 0 ){
	/* echo '<pre>';
	print_r($ans);
	echo '</pre>'; */
  foreach($ans as $row => $bval ){
?>
<tr>
<td style="padding: 6px 0 6px 20px;text-align:left;"><?php echo $bval['ans']; ?></td>
<?php if($bval['total_male'] != 0){ ?>
<td style="background:#6495ED;color:#000;"><?php echo round(100*$bval['total_male']/$total_male, 2); ?>%</td>
<?php }else{ ?> 
<td style="background:#6495ED;color:#000;">0%</td>
<?php } ?>
<?php if($bval['total_female'] != 0){ ?>
<td style="background:#E7766F;color:#000;"><?php echo round(100*$bval['total_female']/$total_female, 2); ?>%</td></tr>
<?php }else{ ?> 
  <td style="background:#E7766F;color:#000;">0%</td>
<?php } } } ?>
</table>
<!--<tr><td style="padding: 6px 0 6px 20px;text-align:left;"><?php echo $bval['ans']; ?></td><td style="background:#6495ED;color:#000;"><?php echo round($bval['male_per'],2); ?>%</td><td style="background:#E7766F;color:#000;"><?php echo round($bval['female_per'],2); ?>%</td></tr> -->