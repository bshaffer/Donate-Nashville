<div class="main-col">
	<h1>I Have&hellip;</h1>
	<ul class="clearfix">
		<li>
			<h2 class="no-margin"><?php echo link_to('Time', '@have_time') ?></h2>
			<p class="text-large">
				<strong>Find a hands-on activity requiring volunteer labor, like cleanup and repair.</strong>
			</p>
		</li>
		<li>
			<h2 class="no-margin"><?php echo link_to('Stuff', '@have_stuff') ?></h2>
			<p class="text-large">
				<strong>Click here to donate goods like food, water, clothing, toiletries, and other supplies.</strong>
			</p>
		</li>
		<li>
			<h2 class="no-margin"><?php echo link_to('Money', '@have_money') ?></h2>
			<p class="text-large">
				<strong>Click here for organizations accepting disaster relief donations.</strong>
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