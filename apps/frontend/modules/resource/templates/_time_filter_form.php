<form class="resourceFilter timeFilter" action="<?php echo url_for('@time_list'); ?>" method="get" accept-charset="utf-8">
	<label for="resource">I <?php echo ($resource_action == 'need' ? 'Need' : 'Have') ?> Time:</label>

	<fieldset>

	<ul>
		<li>
			<label for="start">From</label>
		  <?php echo $form['start']->render(); ?>
		</li>
		<li>
			<label for="start">To</label>
		  <?php echo $form['end']->render(); ?>
		</li>
	</ul>


	</fieldset>

</form>
