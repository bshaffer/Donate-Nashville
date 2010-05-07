<?php if (count($results)): ?>
<ul class="results-list search-results clearfix">
<?php $i = 0; ?>
<?php foreach ($results as $result): ?>
  <li <?php echo $i % 2 == 0 ? 'class="alt"' : '' ?>>
    <div>
			<?php echo link_to('More Info', '@stuff_show?id='. $result['id'], array('class'=>'button')) ?>
		</div>
		<h3 class="no-margin"><?php echo link_to($result['title'], '@stuff_show?id='. $result['id']) ?></h3>
  </li>
  <?php $i++; ?>
<?php endforeach ?>
</ul>  
<?php endif ?>