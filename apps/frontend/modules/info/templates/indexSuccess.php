<h1>Info Resources</h1>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Abstract</th>
      <th>Keywords</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($info_resources as $info_resource): ?>
    <tr>
      <td><?php echo $info_resource->getTitle() ?></td>
      <td><?php echo $info_resource->getDescription() ?></td>
      <td><?php echo $info_resource->getAbstract() ?></td>
      <td><?php echo $info_resource->getKeywords() ?></td>
      <td><a href="<?php echo url_for('info/edit?id='.$info_resource->getId()) ?>">Edit</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('info/new') ?>">New</a>
