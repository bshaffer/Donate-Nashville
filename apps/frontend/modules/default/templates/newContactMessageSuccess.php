<div class="main-col">
  <h1>Contact DonateNashville.org</h1>

  <?php include_partial('default/contact_form', array('form' => $form)) ?>
</div>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>

<?php slot('sidebar') ?>
  <div class="widget clearfix">
  	<h3 class="half-margin">Do you have a question about a specific need?</h3>
  	<div class="half-margin">
  	  <a href="http://www.211tn.org" title="TN 2-1-1" target="_blank"><?php echo image_tag('partners/211logo.png') ?></a>
  	</div>
  	<p class="text-large">
  	 Dial United Way's 2-1-1 or visit <a href="http://www.211tn.org" title="TN 2-1-1" target="_blank">www.211tn.org</a>
  	 to speak with a live operator who can help answer your questions and guide you in the right
  	 direction.
  	</p>
  </div>
<?php end_slot() ?>
