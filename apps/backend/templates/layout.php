<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
  <body>
    <div id="page" class="container_16 clearfix">
      <div id="header" class="grid_16">
          <h1 id="site-title"><?php include_title(); ?> Admin</h1>
          <img class="cs-logo" src="/images/backend/cs_logo.png" alt="centre{source}" />
 					<?php include_partial('global/public_menu', array()) ?>
      </div>
      <div id="content-area" class="grid_16 alpha">
				<?php include_partial('global/admin_menu', array()) ?>
        <?php echo $sf_content ?>
      </div>
  </body>
</html>
