<?php if (count($results)): ?>
<ul class="results-list">
<?php foreach ($results as $result): ?>
  <li><?php echo link_to($result['title'], '@time_match?id='. $result['id']) ?></li>
<?php endforeach ?>
</ul>  
<?php endif ?>
