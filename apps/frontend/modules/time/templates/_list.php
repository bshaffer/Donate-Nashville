<?php if (count($results)): ?>
<ul class="results-list search-results clearfix">
<?php $i = 0; ?>
<?php foreach ($results as $result): ?>
  <li <?php echo $i % 2 == 0 ? 'class="alt"' : '' ?>>
    <div class="right">
			<?php echo link_to('More Info', '@time_show?id='. $result['id'], array('class'=>'button')) ?>
		</div>
		<h3 class="no-margin"><?php echo link_to($result['title'], '@time_show?id='. $result['id']) ?></h3>
		<strong>Volunteers Needed:</strong> 3&nbsp;&bull;&nbsp;<span class=""><strong>Added:</strong> May 5, 2010</span>&nbsp;&bull;&nbsp;<strong>Germantown</strong>
  </li>
  <?php $i++; ?>
<?php endforeach ?>
</ul>  
<?php endif ?>