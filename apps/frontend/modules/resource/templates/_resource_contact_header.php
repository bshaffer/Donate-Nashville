<?php if ($transaction_type == 'have'): ?>
  <?php if ($resource_type == 'stuff'): ?>
    I need this!
  <?php else: ?>
    I want to help!
  <?php endif ?>
<?php else: ?>
  <?php if ($resource_type == 'stuff'): ?>
    I have this!
  <?php else: ?>
    Please help me!
  <?php endif ?>
<?php endif ?>
