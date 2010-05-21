<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>We Are Nashville</title>
  <?php include_http_metas() ?>
  <?php include_metas() ?>
  <?php include_title() ?>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>

</head>
<body>
  <div id="content">
    <h1><a href="./">We Are Nashville</a></h1>
    <ul id="we-are-nashville">
      <li>We are people in need</li>
      <li>We are neighbors who care</li>
      <li>We are friend and neighbors</li>
      <li>We are diverse &amp; eccentric</li>
      <li>We are proud and generous</li>
      <li>We are rebuilding</li>
      <li>We are recovering</li>
      <li>We are volunteers</li>
      <li>We are lifting each other up</li>
      <li>Because... We Are Nashville</li>
    </ul>
    <div id="header">
      <?php include_slot('navigation') ?>
      <ul>
        <li id="facebook">
        <a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.wearenashville.org%2F&t=We%20Are%20Nashville" target="_blank">Share on Facebook</a></li>
        <li id="twitter"><a href="http://twitter.com/home?status=<?php echo urlencode('www.wearenashville.org #wearenashville'); ?>" target="_blank">Share on Twitter</a></li>
      </ul>
    </div>
        
    <div id="footer">
      <ul id="blocks">
        <li id="shirt"><a href="http://store.coolpeoplecare.org/collections/we-are-nashville" target="_blank">Get the Shirt</a></li>
        <li id="donate-nashville"><a href="http://www.donatenashville.org/" target="_blank">Get the Shirt</a></li>
        <li id="water"><a href="http://blogs.tennessean.com/blog/2010/savewater/" target="_blank">Save Your Water</a></li>
      </ul>

      <div id="bottom-line">
        <div id="copyright">&copy;<?php echo date('Y') ?> We Are Nashville. All Rights Reserved.</div>
        <ul id="credits">
          <li class="first"><a href="http://www.section303.com/we-are-nashville-4366" target="_blank">Inspired by Patten Fuqua</a></li>
          <li><a href="http://www.centresource.com" target="_blank">Design by CentreSource Interactive Agency</a></li>
        </ul>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
  </script>
  <script type="text/javascript">
  try {
  var pageTracker = _gat._getTracker("UA-16327451-1");
  pageTracker._trackPageview();
  } catch(err) {}</script>
</body>
</html>
