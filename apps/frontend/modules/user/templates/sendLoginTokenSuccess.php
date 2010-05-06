<div class="main-col">
  <h1>Manage your stuff</h1>

<<<<<<< HEAD:apps/frontend/modules/user/templates/sendLoginTokenSuccess.php
<p>
  Need to manage your posts or mark them as fulfilled? Just fill out the
  form below and we'll email you a link where you can manage your posts.
</p>
=======
  <p>
    Need to manage your posts or mark them as satisfied? Just fill out the
    form below and we'll email you a link where you can manage your posts.
  </p>
>>>>>>> 4d7dc4f5a761136f70bd2e6a5dac0787cf04c001:apps/frontend/modules/user/templates/sendLoginTokenSuccess.php

  <?php echo use_stylesheets_for_form($form) ?>
  <?php echo use_javascripts_for_form($form) ?>
  <?php use_javascript('jquery/jquery.form.js') ?>
  <?php use_javascript('app/send-login-token-process.js') ?>

  <div>
    <?php include_partial('user/sendLoginTokenForm', array('form' => $form)); ?>
  </div>
</div>
<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>
