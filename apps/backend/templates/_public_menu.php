<ul id='login_admin'>
  <?php if ($sf_user->isAuthenticated()):?>
 		<li><?php echo link_to('Logout', '@sf_guard_signout', array('class' => 'public-link')) ?></li>
	<?php else: ?>
		<li><?php echo link_to('Login', '@sf_guard_signin', array('class' => 'public-link')); ?></li>
	<?php endif;?>
  <li><?php echo link_to('Frontend', public_path('index.php'), array('class' => 'public-link')) ?></li>
</ul>