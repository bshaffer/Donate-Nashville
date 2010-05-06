<div class="main-col">
	<h1>I Need&hellip;</h1>
	<ul class="clearfix">
		<li>
			<h2 class="no-margin"><?php echo link_to('Help', '@add_need_time') ?></h2>
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
  <!-- <div class="widget special clearfix">
    <h3 class="half-margin">Important Message</h3>
    <p class="half-margin">
      <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</strong>
    </p>
  </div>
  <div class="widget clearfix">
    <h3 class="half-margin">Quick Message</h3>
    <ul>
      <li>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
      </li>
      <li>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </li>
    </ul>
  </div> -->
<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>