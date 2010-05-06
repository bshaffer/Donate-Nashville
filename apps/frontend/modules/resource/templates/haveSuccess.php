<div class="main-col">
	<h1>I Have&hellip;</h1>
	<ul class="clearfix">
		<li>
			<h2 class="no-margin"><?php echo link_to('Time', '@have_time') ?></h2>
			<p class="text-large">
				<strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</strong> Ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
			</p>
		</li>
		<li>
			<h2 class="no-margin"><?php echo link_to('Stuff', '@have_stuff') ?></h2>
			<p class="text-large">
				<strong>Ut enim ad minim veniam</strong>. Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
			</p>
		</li>
		<li>
			<h2 class="no-margin"><?php echo link_to('Money', '@have_money') ?></h2>
			<p class="text-large">
				<strong>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</strong>. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
			</p>
		</li>
	</ul>
</div>

<?php slot('sidebar') ?>
  <div class="widget special clearfix">
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
	</div>
<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>
