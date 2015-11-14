<?php if(validation_errors()){ ?>
<div class="alert alert-danger"> <strong>*&nbsp;Error</strong>
  <?php  echo validation_errors('<span>', '</span>'); ?> </div>
<?php } ?>
