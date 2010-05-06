<h1>Manage your stuff</h1>

<p>
  Need to manage your posts or mark them as fulfilled? Just fill out the
  form below and we'll email you a link where you can manage your posts.
</p>

<?php echo use_stylesheets_for_form($form) ?>
<?php echo use_javascripts_for_form($form) ?>
<?php use_javascript('jquery/jquery.form.js') ?>
<?php use_javascript('app/send-login-token-process.js') ?>

<div>
  <?php include_partial('user/sendLoginTokenForm', array('form' => $form)); ?>
</div>