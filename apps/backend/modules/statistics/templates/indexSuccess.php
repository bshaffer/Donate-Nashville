<div id="stat-tabs">
  <ul>
    <li><a href="#have-time">Time (Have): <?php echo $active_have_time->count() ?> / <?php echo $fulfilled_have_time->count() ?></a></li>
    <li><a href="#need-time">Time (Need): <?php echo $active_need_time->count() ?> / <?php echo $fulfilled_need_time->count() ?></a></li>
    <li><a href="#have-stuff">Stuff (Have): <?php echo $active_have_stuff->count() ?> / <?php echo $fulfilled_have_stuff->count() ?></a></li>
    <li><a href="#need-stuff">Stuff (Need): <?php echo $active_need_stuff->count() ?> / <?php echo $fulfilled_need_stuff->count() ?></a></li>
  </ul>
  <?php $list = array('have_time', 'need_time', 'have_stuff', 'need_stuff'); ?>

  <div id="lists">
  <?php foreach ($list as $list_type): ?>
    <div id="<?php echo str_replace('_', '-', $list_type) ?>" class="list_type">
      <h2><?php echo ucwords(str_replace('_', ' ', $list_type)) ?></h2>
      <table>
        <tr class="header">
          <th class="title">Title</th>
          <th class="community">Community</th>
          <th class="date_added">Date Added</th>
        </tr>
        <?php $record = 'active_'.$list_type ?>
      <?php foreach ($$record as $resource): ?>
        <tr>
          <td class="title"><a href="<?php echo public_path('index.php')."/".str_replace('_', '/', $list_type)."/".$resource['id'] ?>" target="_blank"><?php echo $resource['title'] ?></a></td>
          <td class="community"><?php echo $resource['neighborhood'] ?></td>
          <td class="date_added"><?php echo $resource['created_at'] ?></td>
        </tr>
      <?php endforeach ?>
      </table>
      
      <h3>Fulfilled Items</h3>
      <table>
        <tr class="header">
          <th class="title">Title</th>
          <th class="community">Community</th>
          <th class="date_added">Date Added</th>
        </tr>
        <?php $record = 'fulfilled_'.$list_type ?>
      <?php foreach ($$record as $resource): ?>
        <tr>
          <td class="title"><a href="<?php echo public_path('index.php')."/".str_replace('_', '/', $list_type)."/".$resource['id'] ?>" target="_blank"><?php echo $resource['title'] ?></a></td>
          <td class="community"><?php echo $resource['neighborhood'] ?></td>
          <td class="date_added"><?php echo $resource['created_at'] ?></td>
        </tr>
      <?php endforeach ?>
      </table>
    </div>  
  <?php endforeach ?>
  </div>
</div>