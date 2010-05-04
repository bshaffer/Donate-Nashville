<?php if ($sf_user->isAuthenticated()): ?>
	<ul id='main-nav'>
		<li><?php echo link_to('Link 1', '@homepage') ?></li>
		<li><?php echo link_to('Link 2', '@homepage') ?></li>
	</ul>	
<?php endif ?>
