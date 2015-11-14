<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html class="boxed "> <!--<![endif]-->
<head>
  <? $this->load->view('layout/includes/layout_head'); ?>
  <?$this->layout->block('currentPageCss')?>
   <!--define current page css-->
  <?$this->layout->block()?>
</head>
<body>
	<div class="body">
		<? $this->load->view('layout/includes/layout_header'); ?>
		<div role="main" class="main">
	    <? $this->layout->block('breadcrumbs')?>
	     Site |
	    <?$this->layout->block()?>
		<?=$content_for_layout?>
		</div>
		<? $this->load->view('layout/includes/layout_footer'); ?>
	</div>
	<? $this->load->view('layout/includes/layout_js'); ?>
    <?$this->layout->block('currentPageJS')?>
      <!--define current page js-->
    <?$this->layout->block()?>
</body>
</html>