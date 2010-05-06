<?php $need_class = $have_class = array(); ?>
<div id="main-nav">
	<div class="container_16 clearfix">
		<div class="grid_16">
			<ul class="left">
			  <?php if ($section == 'have'): ?>
			    <?php $have_class = array('class'=>'sel'); ?>
			  <?php elseif ($section == 'need'): ?>
			    <?php $need_class = array('class'=>'sel'); ?>
			  <?php endif ?>
				<li><?php echo link_to('I Need', '@need', $need_class) ?></li>
				<li><?php echo link_to('I Have', '@have', $have_class) ?></li>
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