<li>
  <?php echo link_to($resource->title, sprintf("@%s_show?id=".$resource['id'], $resource['type'])) ?>
  <ul>
    <?php if ($resource['is_fulfilled']): ?>
      <li><?php echo image_tag('/sfDoctrinePlugin/images/tick.png') ?>&nbsp;Fulfilled</li>
    <?php else: ?>
      <li><?php echo link_to('delete', sprintf('@%s_delete?id='.$resource['id'], $resource['type']), array('method' => 'DELETE')) ?></li>

      <li><?php echo link_to('fulfill', sprintf('@%s_fulfill?id='.$resource['id'], $resource['type']), array('method' => 'POST')) ?></li>      
    <?php endif ?>
  </ul>
</li>
