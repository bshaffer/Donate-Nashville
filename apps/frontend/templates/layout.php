<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<!-- google.load("jqueryui", "1.8.1"); -->
		<script type="text/javascript" charset="utf-8">
			google.load('jquery','1.4');
			google.load('jqueryui', '1.8');
		</script>

		<?php use_stylesheet('http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/cupertino/jquery-ui.css'); ?>		
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
  <body>
    <div id="header">
			<div class="container_16 clearfix">
				<div class="grid_5">
					<a href="<?php echo url_for('@homepage') ?>" title="Donate Nashville"><?php echo image_tag("logo-DN.gif", array('class'=>'logo', 'alt'=>"Logo Donate Nashville"))?></a>
				</div>
				<div class="grid_6"><a href="<?php echo url_for('@user_resource') ?>">manage posts</a></div>
				<div class="grid_5">
					<div class="twitter-single header right">
						<strong><a href="http://www.twitter.com/donateNashville" title="@donateNashville">twitter.com/donateNashville</a></strong>
						Mail gift cards (Home Depot, Wal-Mart, Kroger, etc.) to church office &amp; they'll get to those who need them. <a href="#">www.ottercreek.org</a> <a href="#">about 2 hours ago</a>
					</div>
				</div>
			</div>
		</div>

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
				</div>
			</div>
		</div>

    <?php if (has_slot('breadcrumbs')): ?>
  		<div class="container_16 clearfix">
  			<div class="grid_16">
  				<ul class="breadcrumbs">
  					<li><a href="index.html">Donate Nashville</a>&raquo;</li>
  					<li>I Need</li>
  				</ul>
  			</div>
  		</div>
    <?php endif; ?>
		
		<div id="page" class="container_16 clearfix">
		  
		  <?php if (has_slot('sidebar')): ?>
  		  <div id="content-area" class="clearfix">
  		    <div class="grid_12">
  		       <?php echo $sf_content ?>
  		    </div>
    		  <div class="grid_4">
            <?php include_slot('sidebar'); ?>
          </div>
    		</div>		    
		  <?php else: ?>
		    <div class="grid_16">
		       <?php echo $sf_content ?>
		    </div>
		  <?php endif ?>
    
      <div id="footer" class="grid_16 clearfix">
  		<ul>
  			<li><a href="#" title="">Home</a></li>
  			<li><?php echo link_to('I Need', '@need') ?></li>
  			<li><?php echo link_to('I Have', '@have') ?></li>
  			<li><?php echo link_to('About DonateNashville', '@about') ?></li>
  			<li><?php echo link_to('Terms of Service', '@terms_of_service') ?></li>
  			<li><a href="#" title="">Contact Us</a></li>
  			<li><a href="http://www.twitter.com/donateNashville" title="@donateNashville">Twitter</a></li>
  		</ul>
  		<div class="center">&copy;<?php echo date('Y') ?> Donate Nashville</div>
		</div>
	</div>
</body>
</html>