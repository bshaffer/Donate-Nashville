<?php use_helper('dh') ?>
<?php include_javascripts_for_form($form) ?>
<?php include_stylesheets_for_form($form) ?>

<form class="resourceFilter timeFilter" action="<?php echo url_for('@time_list?type='.opposite_of($resource_action)); ?>" method="get" accept-charset="utf-8">
	<label for="resource">I <?php echo ($resource_action == 'need' ? 'Need' : 'Have') ?> Time:</label>

	<fieldset>

	<ul>
		<li>
			<label for="date">Start</label>
		  <?php echo $form['start']->render(); ?>
		</li>
		<li>
			<label for="date">End</label>
		  <?php echo $form['end']->render(); ?>
		</li>
	</ul>
	</fieldset>

</form>
