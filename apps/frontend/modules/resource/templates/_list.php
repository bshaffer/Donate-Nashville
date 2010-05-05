<ul class="results-list">
<?php foreach ($results as $result): ?>
  <?php include_partial('resource/list_item', array('result' => $result)) ?>
<?php endforeach ?>
</ul>