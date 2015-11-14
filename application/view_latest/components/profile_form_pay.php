<?php $this->load->view('components/form_message'); ?>
<form action="<?php echo site_url('clients/payment'); ?>" id="register" method="POST" type="post">
<input type="hidden" name="act" value="editaccount"  />
<div class="row">
  <div class="form-group">
    <div class="col-md-12">
      <label>Paypal E-mail Address*</label><br />
       <input name="pemail"  type="text" autocorrect="off" autocapitalize="none" value="<?php echo $profile['pemail']; ?>" class="form-control input-lg">
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <input type="submit" value="Update Account" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
  </div>
</div>
</form>