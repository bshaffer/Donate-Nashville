<?php use_helper('dh') ?>
  
<?php if (count($results)): ?>
  <?php if (!$append): ?>
    <ul class="results-list search-results clearfix" id="ResourceList">    
  <?php endif ?>

<?php $i = 0; ?>
<?php foreach ($results as $result): ?>
  <li <?php echo $i % 2 == 0 ? 'class="alt"' : '' ?>>
    <div class="right">
			<?php echo link_to('More Info', '@'.opposite_of($transaction_type).'_stuff_show?id='. $result['id'], array('class'=>'button')) ?>
		</div>
		<h3 class="no-margin"><?php echo link_to($result['title'], '@'.opposite_of($transaction_type).'_stuff_show?id='. $result['id']) ?></h3>
		<strong>Quantity <?php echo $transaction_type == 'have' ? 'Available' : 'Needed' ?>:</strong> <?php echo $result['quantity'] ?>&nbsp;&bull;&nbsp;<span class=""><strong>Added:</strong> <?php echo date('M j, Y', strtotime($result['created_at'])) ?></span>&nbsp;&bull;&nbsp;<strong><?php echo $result['neighborhood'] ?></strong>
  </li>
  <?php $i++; ?>
<?php endforeach ?>

  <?php if (!$append): ?>
    </ul>
  <?php endif ?>
<?php endif ?>