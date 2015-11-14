<div class="table-responsive">
	<table class="table table-bordered table-striped table-condensed mb-none">
	<?php if( count($ans) > 0 ){
	foreach($ans as $row => $bval ){
	?>
	<tr><td style="padding: 6px 0 6px 20px;text-align:left;"><?php echo $bval['ans']; ?></td><td><?php echo round($bval['per'],2); ?>%</td></tr>
	<?php }} ?>
	</table>
</div>