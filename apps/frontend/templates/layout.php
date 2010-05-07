<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php if (has_slot('title')): ?>
      <title><?php echo get_slot('title') ?> | DonateNashville.org</title>
    <?php else: ?>
      <?php include_title() ?>
    <?php endif; ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
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
				<div class="grid_6">&nbsp;</div>
				<div class="grid_5">
					<div class="twitter-single header right">
						<?php include_component('default', 'twitter') ?>
					</div>
				</div>
			</div>
		</div>

    <?php include_component('default', 'navigation') ?>

    <?php if (has_slot('breadcrumbs')): ?>
  		<div class="container_16 clearfix">
  			<div class="grid_16">
          <?php include_slot('breadcrumbs') ?>
  			</div>
  		</div>
    <?php endif; ?>
		
		<div id="page" class="container_16 clearfix">
		  
  		<div id="content-area" class="clearfix">
		    <?php if (has_slot('sidebar')): ?>
  		    <div class="grid_12">
  		       <?php echo $sf_content ?>
  		    </div>
    		  <div class="grid_4" id="sidebar">
            <?php include_slot('sidebar'); ?>
          </div>
		    <?php else: ?>
		      <div class="grid_16">
		         <?php echo $sf_content ?>
		      </div>
		    <?php endif ?>
    	</div>		    
    
    <div id="footer" class="grid_16 clearfix">
  		<ul>
  			<li><?php echo link_to('Home', '@homepage') ?></li>
  			<li><?php echo link_to('I Need', '@need') ?></li>
  			<li><?php echo link_to('I Have', '@have') ?></li>
  			<li><?php echo link_to('About DonateNashville', '@about') ?></li>
  			<li><?php echo link_to('Terms of Service', '@terms_of_service') ?></li>
  			<li><?php echo link_to('Contact Us', '@new_contact_message') ?></li>
  			<li><a href="http://www.twitter.com/donateNashville" title="@donateNashville">Twitter</a></li>
  		</ul>
  		<ul id="partners">
        <li class="partner_wearenashville"><a href="http://www.wearenashville.org" title="We Are Nashville">We Are Nashville</a></li>
        <li class="partner_nashvillest"><a href="http://www.nashvillest.com" title="Nashvillest">Nashvillest</a></li>
        <li class="partner_unitedway"><a href="http://www.unitedwaynashville.org" title="United Way">United Way Nashville</a></li>
        <li class="partner_coolpeoplecare"><a href="http://coolpeoplecare.org" title="Cool People Care">Cool People Care</a></li>
      </ul>
  		<div class="center">&copy;<?php echo date('Y') ?> Donate Nashville</div>
		</div>
	</div>
	<script type="text/javascript">
  var uservoiceOptions = {
    /* required */
    key: 'donatenashville',
    host: 'donatenashville.uservoice.com', 
    forum: '55628',
    showTab: true,  
    /* optional */
    alignment: 'left',
    background_color:'#f00', 
    text_color: 'white',
    hover_color: '#06C',
    lang: 'en'
  };

  function _loadUserVoice() {
    var s = document.createElement('script');
    s.setAttribute('type', 'text/javascript');
    s.setAttribute('src', ("https:" == document.location.protocol ? "https://" : "http://") + "cdn.uservoice.com/javascripts/widgets/tab.js");
    document.getElementsByTagName('head')[0].appendChild(s);
  }
  _loadSuper = window.onload;
  window.onload = (typeof window.onload != 'function') ? _loadUserVoice : function() { _loadSuper(); _loadUserVoice(); };
  </script>
  <script type="text/javascript">
  var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
  </script>
  <script type="text/javascript">
  try {
  var pageTracker = _gat._getTracker("UA-16279666-1");
  pageTracker._setDomainName(".donatenashville.org");
  pageTracker._trackPageview();
  } catch(err) {}</script>
</body>
</html>
