<?php $last_key = count($items) - 1 ?>

<?php !isset($separator) and $separator = '&raquo;' ?>
<?php if (count($items)): ?>
  <ul class="breadcrumbs">
  <?php foreach ($items as $key => $item): ?>
    <?php if ($key < $last_key): ?>
      <li><?php echo link_to($item->getText(), $item->getUri(ESC_RAW)) ?> <?php echo $separator ?></li>
    <?php else: ?>
      <li><?php echo $item->getText() ?></li>
    <?php endif ?>
  <?php endforeach ?>
  </ul>
<?php endif ?>