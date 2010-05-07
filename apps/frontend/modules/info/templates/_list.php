<?php if (count($results)): ?>
<ul class="results-list search-results clearfix">
<?php $i = 0; ?>
<?php foreach ($results as $result): ?>
  <li <?php echo $i % 2 == 0 ? 'class="alt"' : '' ?>>
    <div>
			<?php echo link_to('More Info', '@info_show?id='. $result['id'], array('class'=>'button')) ?>
		</div>
		<h3 class="no-margin"><?php echo link_to($result['title'], '@info_show?id='. $result['id']) ?></h3>
		<p><?php echo $result['abstract'] ? $result['abstract'] : csToolkit::truncate($result['description'], 140)?></p>
  </li>
  <?php $i++; ?>
<?php endforeach ?>
</ul>  
<?php endif ?>