<form class="resourceFilter" action="<?php echo url_for('@stuff_list'); ?>" method="get" accept-charset="utf-8">

	<div><label for="resource">I <?php echo ($resource_action == 'need' ? 'Need' : 'Have') ?></label><input type="text" class="resource" name="resource" value="" id="ResourceFilter"></div>

	<input type="hidden" name="resource_type" value="time" id="ResourceType">
</form>
