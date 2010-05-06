<div class="main-col">
  <h1>I Need Stuff...</h1>

  <?php
    include_partial('resource/resource_filter', array('resource_type' => 'stuff', 'resource_action' => 'need'));
  ?>

  <br />
	<p class="text-large">
		<strong>Can't find the item you're looking for?</strong>
		<br />
		Simply <a class="text-highlite" href="<?php echo url_for('@add_need_stuff') ?>">Add the item</a> you want and we'll notify you as soon as someone donates it!
	</p>
</div>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>

<?php slot('sidebar') ?>
  <div id="quicklink" class="widget clearfix">
  	<h3 class="half-margin">Need Additional Resources?</h3>
  	<a href="http://www.211tn.org" title="TN 2-1-1" target="_blank"><?php echo image_tag('partners/211logo.png') ?></a>
  	<p>
  	 Dial United Way's 2-1-1 or visit <a href="http://www.211tn.org" title="TN 2-1-1" target="_blank">www.211tn.org</a> to find additional resources.
  	</p>
  </div>
<?php end_slot() ?>