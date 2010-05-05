<?php use_helper('jQuery') ?>

<form class="resourceFilter timeFilter" action="<?php echo url_for('@time_list'); ?>" method="get" accept-charset="utf-8">
	<label for="resource">I <?php echo ($resource_action == 'need' ? 'Need' : 'Have') ?> Time:</label>

	<fieldset>

	<ul>
		<li>
			<label for="date">Date</label>
		  <?php echo $form['resource_date']->render(); ?>
		</li>
		<li>
		  <?php echo link_to_function('Specify Time', '$(".time-form").show();$(this).hide()') ?>
		  <div class="time-form" style="display:none">
			  <label for="time">Time</label>
  		  <ul>
      		<li>
      			<label for="start">From</label>
      		  <?php echo $form['start_time']->render(); ?>
      		</li>
      		<li>
      			<label for="start">To</label>
      		  <?php echo $form['end_time']->render(); ?>
      		</li>
  		  </ul>
		  </div>
		</li>
	</ul>
	</fieldset>

</form>
