<li>
  <?php echo link_to($resource->title, $resource->getRoute()) ?>
  <ul>
    <li><?php echo link_to('delete', '@resource_delete?id='.$resource['id'], array('sf_method' => 'DELETE')) ?></li>
    <li><?php echo link_to('satisfied', '@resource_satisfy?id='.$resource['id'], array('sf_method' => 'POST')) ?></li>
  </ul>
</li>
