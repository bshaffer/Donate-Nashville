<h1>I Have Stuff...</h1>

<?php
include_partial('resource/resource_filter', array('resource_type' => 'stuff', 'resource_action' => 'have'));
?>

<a href="<?php /* echo url_for('@have_stuff_create'); */ ?>">Add a New Item</a>
