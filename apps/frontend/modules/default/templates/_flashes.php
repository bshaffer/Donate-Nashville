<?php if ($sf_user->hasFlash('confirm')): ?>
  <div class="flash-confirm"><?php echo $sf_user->getFlash('confirm') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash-notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash-error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif; ?>