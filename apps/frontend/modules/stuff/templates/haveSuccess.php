<div class="main-col">
  <h1>I Have Stuff...</h1>

  <?php
    include_partial('resource/resource_filter', array('resource_type' => 'stuff', 'resource_action' => 'have'));
  ?>

  <br />
	<p class="text-large">
		<strong>Is this your search not currently listed as a need?</strong>
		<br />
		Simply <a class="text-highlite" href="<?php echo url_for('@add_have_stuff') ?>">Add the item</a> you have and we'll notify you as soon as someone needs it!
	</p>
</div>

<?php slot('sidebar') ?>
  <div class="widget clearfix" id="SidebarContainer">
  </div>
  <div class="widget clearfix special">
    <h3 class="no-margin">How does this work?</h3>
    <p class="no-margin">
      <strong>Search for your specific need. See below for matching items, or add a new item if no matching goods are available.</strong>
    </p>
  </div>
<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>