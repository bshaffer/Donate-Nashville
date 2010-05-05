<?php if (count($results)): ?>
<ul class="results-list">
<?php foreach ($results as $result): ?>
  <?php include_partial('resource/list_item', array('resource' => $result)) ?>
<?php endforeach ?>
</ul>  
<?php endif ?>
