<?php if (count($results)): ?>
<ul class="results-list search-results clearfix">
<?php $i = 0; ?>
<?php foreach ($results as $result): ?>
  <li <?php echo $i % 2 == 0 ? 'class="alt"' : '' ?>>
    <div class="right">
			<?php echo link_to('More Info', '@time_show?id='. $result['id'], array('class'=>'button')) ?>
		</div>
		<h3 class="no-margin"><?php echo link_to($result['title'], '@time_show?id='. $result['id']) ?> <?php if ($result['city']): ?><span>(<strong><?php echo $result['city'] ?></strong>)</span><?php endif ?></h3>
		<strong>Date:</strong> <?php echo date('M j', strtotime($result['resource_date'])) ?>, <?php echo date('g:ia', strtotime($result['start_time'])) ?> - <?php echo date('g:ia', strtotime($result['end_time'])) ?>
		<?php if ($result['num_volunteers']): ?>&bull;&nbsp;<strong>Volunteers Needed:</strong> <?php echo $result['num_volunteers'] ?><?php endif ?>
  </li>
  <?php $i++; ?>
<?php endforeach ?>
</ul>  
<?php endif ?>