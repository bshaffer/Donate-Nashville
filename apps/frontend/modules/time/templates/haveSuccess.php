<div class="main-col">
  <h1>I Have Time...</h1>
  
<?php
include_partial('resource/resource_filter', array('resource_type' => 'time', 'resource_action' => 'have'));
?>

<br />
<p class="text-large">
	<strong>Can't find the right opportunity?</strong>
	<br />
	Sign up with <a href="http://www.hon.org" target="_blank">Hands on Nashville</a>, and they'll get you involved in a volunteer project!
</p>
</div>

<?php slot('sidebar') ?>
  <div class="widget clearfix" id="SidebarContainer">
  </div>
  
  <div class="widget clearfix special">
    <h3 class="no-margin">How does this work?</h3>
    <p class="no-margin">
      <strong>Enter your availability to find existing volunteer opportunities.</strong>
    </p>
  </div>
  <div id="quicklink" class="widget clearfix">
  	<h3 class="half-margin">Can't find the right opportunity?</h3>
  	<a href="http://www.hon.org" title="Hands on Nashville" target="_blank"><?php echo image_tag('partners/honashville.jpg', array('class'=>'center')) ?></a>
  	<p>
  	 Sign up with <a href="http://www.hon.org" target="_blank">Hands on Nashville</a>, and they'll get you involved in a volunteer project!
  	</p>
  </div>
<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>
