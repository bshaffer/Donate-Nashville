<form action="<?php echo url_for('@have_time_list') ?>" method="get" name="time_resource">
<?php
include_partial('resource/resource_filter', array('resource_type' => 'time', 'resource_action' => 'have'));
?>

</form>

<a href="<?php echo url_for('@add_need_time') ?>">Add new event</a>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>
