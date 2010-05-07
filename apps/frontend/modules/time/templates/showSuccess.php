<div class="main-col">
  <h1><?php echo $resource->title ?></h1>
  <?php if ($resource->showContactInformation()): ?>
    <div class='contact-info right full-margin'>
      <h3 class="no-margin">Contact Info</h3>
      <?php include_partial('user/contact_info', array('user' => $resource['User'])) ?>
    </div>
  <?php endif; ?>
  
  <ul id="resource-info">
    <li>
      <strong>Community:</strong> <?php echo $resource['neighborhood'] ?>
    </li>
    <li>
      <strong>Date:</strong> <?php echo date('M j', strtotime($resource['resource_date'])) ?>, <?php echo date('g:ia', strtotime($resource['start_time'])) ?> - <?php echo date('g:ia', strtotime($resource['end_time'])) ?>
    </li>
  
	<?php if ($resource['city']): ?>
	  <li><strong>City:</strong> <?php echo $resource['city'] ?></li>
	<?php endif ?>
	
	<?php if ($resource['num_volunteers']): ?>
	  <li><strong>Volunteers Needed:</strong> <?php echo $resource['num_volunteers'] ?></li>
	<?php endif ?>
  </ul>
  
  <p class="text-large">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>

  <?php if ($resource['is_fulfilled']): ?>
    <span class="fulfilled"><?php echo image_tag('/sfDoctrinePlugin/images/tick.png', array('alt' => 'fulfilled')) ?>&nbsp;Fulfilled</span>
  <?php elseif(!$sf_user->isOwner($resource)): ?>
    <!-- call to action here, which depends on whether this is a "need" looking for a "have" or vice versa -->
    <?php include_partial('resource/resource_contact_owner_form', array('resource_type' => 'time', 'resource' => $resource, 'form' => $form, 'type' => $type)) ?>
  <?php endif ?>
</div>

<?php slot('sidebar') ?>
  <div class="widget special clearfix">
		<p class="no-margin">
			<strong>The following event matches your availability. To volunteer, fill out the contact form below.</strong>
		</p>
	</div>
<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>
