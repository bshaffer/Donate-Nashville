<h1>I Need Stuff...</h1>

<?php
include_partial('resource/resource_filter', array('resource_type' => 'stuff', 'resource_action' => 'need'));
?>


<a href="<?php echo url_for('@add_need_stuff') ?>">Add new item</a>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>