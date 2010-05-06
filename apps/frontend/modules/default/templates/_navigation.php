<div id="main-nav">
	<div class="container_16 clearfix">
		<div class="grid_16">
			<ul class="left">
				<li><?php echo link_to('I Need', '@need') ?></li>
				<li><?php echo link_to('I Have', '@have') ?></li>
			</ul>
			<div class="left">
				Have a question? <a href="#">Contact Us</a>
			</div>
			<div class="right">
			  <a href="<?php echo url_for('@user_resource') ?>">manage posts</a>
			</div>
		</div>
	</div>
</div>