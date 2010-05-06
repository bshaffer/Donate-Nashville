<?php use_helper('dh') ?>
<form class="resourceFilter" action="<?php echo url_for('@stuff_list?type='.opposite_of($resource_action)); ?>" method="get" accept-charset="utf-8">
	<fieldset>
		
	<ul>
		<li>
			<label for="resource">I <?php echo ($resource_action == 'need' ? 'Need' : 'Have') ?></label>
			<input type="text" class="resource" name="resource" value="" id="ResourceFilter">
		</li>
	</ul>
	

	</fieldset>

	<input type="hidden" name="resource_type" value="stuff" id="ResourceType">
</form>
