<?php if ($sf_user->isAuthenticated()): ?>
	<ul id='main-nav'>
		<li><?php echo link_to('Stats', '@statistics') ?></li>
	  <li><?php echo link_to('Users', '@users') ?></li>
	  <li><?php echo link_to('Export', '@export') ?></li>
	</ul>	
<?php endif ?>
