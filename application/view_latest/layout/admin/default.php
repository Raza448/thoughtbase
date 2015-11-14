<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html class="boxed "> <!--<![endif]-->
<head>
  <? $this->load->view('layout/admin/includes/layout_head'); ?>
  <?$this->layout->block('currentPageCss')?>
   <!--define current page css-->
  <?$this->layout->block()?>
</head>
<body class="<?php echo (basename($_SERVER['PHP_SELF']) == 'admin')? 'bg-black' : 'skin-blue' ?>">
		
	<?php echo (basename($_SERVER['PHP_SELF']) == 'admin')? '' : $this->load->view('layout/admin/includes/layout_header') ?>
	
	<?php echo (basename($_SERVER['PHP_SELF']) == 'admin')? '' : '<div class="wrapper row-offcanvas row-offcanvas-left">' ?>
	
	<?$this->layout->block('breadcrumbs')?>
	 Site |
	<?$this->layout->block()?>
	<?=$content_for_layout?>
	</div>
		
	
	<? $this->load->view('layout/admin/includes/layout_js'); ?>
    <?$this->layout->block('currentPageJS')?>
      <!--define current page js-->
    <?$this->layout->block()?>
</body>
</html>