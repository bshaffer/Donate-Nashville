<li class="<?php echo $class ?>">
    <?php if ($resource['is_fulfilled']): ?>
      <div class="right button-inactive"><?php echo image_tag('/sfDoctrinePlugin/images/tick.png') ?>&nbsp;<strong>fulfilled</strong></div>
    <?php else: ?>
      <div class="right"><?php echo link_to('fulfill', sprintf('@%s_fulfill?id='.$resource['id'], $resource['type']), array('method' => 'POST', 'class' => 'button')) ?></div>      
      <div class="right"><?php echo link_to('delete', sprintf('@%s_delete?id='.$resource['id'], $resource['type']), array('method' => 'DELETE', 'class' => 'button')) ?></div>
    <?php endif ?>
  <h3 class="no-margin"><?php echo link_to($resource->title, sprintf("@%s_show?id=".$resource['id'], $resource['type'])) ?></h3>
  &bull;&nbsp;<span class=""><strong>Added:</strong> <?php echo date('M j, Y', strtotime($resource['created_at'])) ?></span>&nbsp;&bull;&nbsp;<strong><?php echo $resource['neighborhood'] ?></strong>
</li>
