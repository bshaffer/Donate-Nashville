<?php if (count($results)): ?>
<ul class="infobox-list clearfix">
<?php $i = 0; ?>
<?php foreach ($results as $result): ?>
  <li <?php echo $i % 2 == 0 ? 'class="alt"' : '' ?>>
		<h3 class="half-margin"><?php echo link_to($result['title'], '@info_show?id='. $result['id']) ?></h3>
		<p class="half-margin">
		<?php echo $result['abstract'] ? $result['abstract'] : csToolkit::truncate($result['description'], 140)?></p>
    <div>
			<?php echo link_to('More Info', '@info_show?id='. $result['id'], array('class'=>'button right')) ?>
		</div>
  </li>
  <?php $i++; ?>
<?php endforeach ?>
</ul>  
<?php endif ?>