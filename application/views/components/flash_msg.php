				<?php if ($this->session->flashdata('error') !== FALSE){ ?>
					<div class="alert alert-danger">
						<strong>Error!</strong> <?=$this->session->flashdata('error');?>
					</div>
				<?php }?>
				<?php if ($this->session->flashdata('warning') !== FALSE){ ?>
					<div class="alert alert-warning">
						<strong>Warning!</strong> <?=$this->session->flashdata('warning');?>
					</div>
				<?php }?>
				<?php if ($this->session->flashdata('info') !== FALSE){ ?>
					<div class="alert alert-info">
						<strong><i class="fa fa-info-circle"></i></strong> <?=$this->session->flashdata('info');?>
					</div>
				<?php }?>
				<?php if ($this->session->flashdata('success') !== FALSE){ ?>
					<div class="alert alert-success">
						<strong class="check"><i class="fa fa-check"></i></strong> <?=$this->session->flashdata('success');?>
					</div>
				<?php } else if(!empty($password)) { ?>
					<div class="alert alert-success">
						<strong class="check"><i class="fa fa-check"></i></strong> <?php echo $password; ?>
					</div>
				<?php } ?>