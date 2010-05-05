<form action="<?php echo url_for('@have_time_list') ?>" method="get" name="time_resource">
	<?php
	@include_partial('resource/resource_filter', array('resource_type' => 'time', 'resource_action' => 'have'));
	?>

</form>
