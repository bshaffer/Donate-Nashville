<table>
  <tr class="header">
    <th class="email">Email</th>
    <th class="num_resources">Number of Resources</th>
    <th class="date_added">Date Added</th>
  </tr>
<?php foreach ($users as $user): ?>
  <tr>
    <td class="email">
      <?php echo link_to($user['email_address'], 'sf_guard_user_edit', array('sf_subject' => $user)) ?>
    </td>
    <td class="num_resources"><?php echo $user['Resources']->count() ?></td>
    <td class="date_added"><?php echo $user['created_at'] ?></td>
  </tr>
<?php endforeach ?>
</table>