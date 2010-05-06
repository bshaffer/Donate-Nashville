<?php use_helper('dh') ?>
<form class="resourceFilter search-large" action="<?php echo url_for('@stuff_list?type='.opposite_of($resource_action)); ?>" method="get" accept-charset="utf-8">
	<input type="text" class="resource" name="resource" value="" id="ResourceFilter">	
	<input type="hidden" name="resource_type" value="stuff" id="ResourceType">
</form>
