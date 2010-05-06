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
    <div id="page" class="container_16 clearfix">
      <div id="header" class="grid_16">
          
        <h1 id="site-title"><a href="<?php echo url_for('@homepage') ?>">Donate Nashville</a></h1>
        
        <a href="<?php echo url_for('@send_login_token') ?>">manage posts</a>

        <ul id="nav" class="grid_5 prefix_11">
          <li><?php echo link_to('I Have...', '@have') ?></li>
          <li><?php echo link_to('I Need...', '@need') ?></li>
        </ul>
      </div>
      
      <div id="content-area" class="grid_16">
        <?php echo $sf_content ?>
      </div>
      
      <div id="footer" class="grid_16 clearfix">
        <ul id="footer-nav">
          <li><?php echo link_to('About DonateNashville', '@about') ?></li>
          <li class="last"><?php echo link_to('Terms of Service', '@terms_of_service') ?></li>
        </ul>
        <p>&copy;<?php echo date('Y') ?> Donate Nashville.</p>
      </div>
  </body>
</html>

