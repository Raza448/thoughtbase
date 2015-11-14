<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed mb-none">
<tr><td colspan="8" class="align_left">
<span style="height:15px;width:15px;background:#E7766F;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;18 - 24
&nbsp;&nbsp;<span style="height:15px;width:15px;background:#008000;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;25 - 34&nbsp;
&nbsp;&nbsp;<span style="height:15px;width:15px;background:#00BFFF;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;35 - 44&nbsp;
&nbsp;&nbsp;<span style="height:15px;width:15px;background:#1E90FF;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;45 - 54&nbsp;
&nbsp;&nbsp;<span style="height:15px;width:15px;background:#6495ED;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;55 - 64&nbsp;
&nbsp;&nbsp;<span style="height:15px;width:15px;background:#CD853F;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;64+&nbsp;
</td></tr>
<?php if( count($ans) > 0 ){
	$total_2 = '';
	$total_3 = '';
	$total_4 = '';
	$total_5 = '';
	$total_6 = '';
	$total_7 = '';
	/* echo '<pre>';
	print_r($ans);
	echo '</pre>'; */
  foreach($ans as $row => $bval ){
	   $total_2 += $bval['total_2'];
	   $total_3 += $bval['total_3'];
	   $total_4 += $bval['total_4'];
	   $total_5 += $bval['total_5'];
	   $total_6 += $bval['total_6'];
	   $total_7 += $bval['total_7'];
	   
} } ?>
<?php if( count($ans) > 0 ){
  foreach($ans as $row => $bval ){
?>
<tr><td class="align_left"><?php echo $bval['ans']; ?></td>
<!--<td style="background:#ccc;color:#000;"><?php echo $bval['per_1']; ?>%</td>-->
<?php if($bval['total_2'] != 0){ ?>
<td style="background:#E7766F;color:#000;"><?php echo round(100*$bval['total_2']/$total_2, 2); ?>%</td>
<?php }else{ ?> 
<td style="background:#E7766F;color:#000;">0%</td>
<?php } ?>
<?php if($bval['total_3'] != 0){ ?>
<td style="background:#008000;color:#000;"><?php echo round(100*$bval['total_3']/$total_3, 2); ?>%</td>
<?php }else{ ?> 
<td style="background:#008000;color:#000;">0%</td>
<?php } ?>
<?php if($bval['total_4'] != 0){ ?>
<td style="background:#00BFFF;color:#000;"><?php echo round(100*$bval['total_4']/$total_4, 2); ?>%</td>
<?php }else{ ?> 
<td style="background:#00BFFF;color:#000;">0%</td>
<?php } ?>
<?php if($bval['total_5'] != 0){ ?>
<td style="background:#1E90FF;color:#000;"><?php echo round(100*$bval['total_5']/$total_5, 2); ?>%</td>
<?php }else{ ?> 
<td style="background:#1E90FF;color:#000;">0%</td>
<?php } ?>
<?php if($bval['total_6'] != 0){ ?>
<td style="background:#6495ED;color:#000;"><?php echo round(100*$bval['total_6']/$total_6, 2); ?>%</td>
<?php }else{ ?> 
<td style="background:#6495ED;color:#000;">0%</td>
<?php } ?>
<?php if($bval['total_7'] != 0){ ?>
<td style="background:#CD853F;color:#000;"><?php echo round(100*$bval['total_7']/$total_7, 2); ?>%</td>
<?php }else{ ?> 
<td style="background:#CD853F;color:#000;">0%</td>
<?php } ?>
<!--<td style="background:#008000;color:#000;"><?php echo round(100/$total_3, 2); ?>%</td>
<td style="background:#00BFFF;color:#000;"><?php echo round(100/$total_4, 2); ?>%</td>
<td style="background:#1E90FF;color:#000;"><?php echo round(100/$total_5, 2); ?>%</td>
<td style="background:#6495ED;color:#000;"><?php echo round(100/$total_6, 2); ?>%</td>
<td style="background:#CD853F;color:#000;"><?php echo round(100/$total_7, 2); ?>%</td>-->
</tr>
<?php }  } ?>
</table>
</div>