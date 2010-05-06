<h1>Thanks for your interest in donatenashville.org</h1>

<p>
  To manage your account, please login here:
  
  <a href="<?php echo url_for('@user_auth?token='.$resource->User->password, array('absolute' => true)); ?>">
    <?php echo url_for('@user_auth?token='.$resource->User->password, array('absolute' => true)); ?>
  </a>
</p>