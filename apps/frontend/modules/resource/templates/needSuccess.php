<div class="main-col">
	<h1>I Need&hellip;</h1>
	<ul class="clearfix">
		<li>
			<h2 class="no-margin"><?php echo link_to('A Hand', '@add_need_time') ?></h2>
			<p class="text-large">
				<strong>Find help with tasks like cleanup, repair and any other activities requiring volunteer labor.</strong>
			</p>
		</li>
		<li>
			<h2 class="no-margin"><?php echo link_to('Stuff', '@need_stuff') ?></h2>
			<p class="text-large">
				<strong>Find donated goods such as food, water, clothing, toiletries, and other supplies.</strong>
			</p>
		</li>
		<li>
			<h2 class="no-margin"><?php echo link_to('A Place', '@need_place') ?></h2>
			<p class="text-large">
				<strong>Find out more about temporary housing options for displaced flood victims.</strong>
			</p>
		</li>
	</ul>
</div>

<?php slot('sidebar') ?>
<!-- <div class="widget clearfix">
  <h3 class="half-margin">General Help Available</h3>
  <a href="http://www.211tn.org" title="TN 2-1-1" target="_blank"><?php echo image_tag('partners/211logo.png') ?></a>
  <p>
   Dial United Way's 2-1-1 or visit <a href="http://www.211tn.org" title="TN 2-1-1" target="_blank">www.211tn.org</a> to find additional resources.
  </p>
</div> -->
<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>