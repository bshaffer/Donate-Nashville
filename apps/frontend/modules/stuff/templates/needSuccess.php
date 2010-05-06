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
<?php end_slot() ?>