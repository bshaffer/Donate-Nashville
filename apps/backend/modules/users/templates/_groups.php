<table>
  <tr class="header">
    <th class="name">Name</th>
    <th class="description">Description</th>
    <th class="date_added">Date Added</th>
  </tr>
<?php foreach ($groups as $group): ?>
  <tr>
    <td class="name">
      <?php echo link_to($group['name'], 'sf_guard_group_edit', array('sf_subject' => $group)) ?>
    </td>
    <td class="description"><?php echo $group['description'] ?></td>
    <td class="date_added"><?php echo $group['created_at'] ?></td>
  </tr>
<?php endforeach ?>
</table>
