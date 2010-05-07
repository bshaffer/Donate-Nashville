<div class="main-col">
  <h1><?php echo $resource->title ?></h1>
  <h3 class="half-margin">Bellevue Shelter (Bellevue)</h3>
  <?php if ($resource->showContactInformation()): ?>
    <div class='contact-info right full-margin'>
      <h3 class="no-margin">Contact Info</h3>
      <?php include_partial('user/contact_info', array('user' => $resource['User'])) ?>
    </div>
  <?php endif; ?>
  
  <?php if ($resource->quantity): ?>
    <div class="quantity">Quantity <?php echo $resource->transaction_type == 'have' ? 'Available' : 'Needed' ?>: <?php echo $resource->quantity ?></div>
  <?php endif ?>
  <p class="text-large">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>
  <?php if ($resource['is_fulfilled']): ?>
    <span class="fulfilled"><?php echo image_tag('/sfDoctrinePlugin/images/tick.png', array('alt' => 'fulfilled')) ?>&nbsp;Fulfilled</span>
  <?php elseif(!$sf_user->isOwner($resource)): ?>
  	<hr />
    <div>
      <!-- call to action here, which depends on whether this is a "need" looking for a "have" or vice versa -->
      <?php include_partial('resource/resource_contact_owner_form', array('type' => $resource['transaction_type'], 'resource_type' => 'stuff', 'form' => $form, 'resource' => $resource)) ?>
    </div>
  <?php endif ?>
</div>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>

<?php slot('sidebar') ?>
  
<?php end_slot() ?>