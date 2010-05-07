<div class="main-col">
  <h1><?php echo $resource->url ? link_to($resource->title, $resource->url) : $resource->title ?></h1>

  <?php if ($resource->showContactInformation()): ?>
    <div class='contact-info right full-margin'>
      <h3 class="no-margin">Contact Info</h3>
      <?php include_partial('user/contact_info', array('user' => $resource['User'])) ?>
    </div>
  <?php endif; ?>

  <p class="text-large">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>

</div>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>

<?php slot('sidebar') ?>
  
<?php end_slot() ?>