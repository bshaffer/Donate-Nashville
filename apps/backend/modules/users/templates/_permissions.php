<table>
  <tr class="header">
    <th class="name">Name</th>
    <th class="description">Description</th>
    <th class="date_added">Date Added</th>
  </tr>
<?php foreach ($permissions as $perm): ?>
  <tr>
    <td class="name">
      <?php echo link_to($perm['name'], 'sf_guard_permission_edit', array('sf_subject' => $perm)) ?>
    </td>
    <td class="description"><?php echo $perm['description'] ?></td>
    <td class="date_added"><?php echo $perm['created_at'] ?></td>
  </tr>
<?php endforeach ?>
</table>
