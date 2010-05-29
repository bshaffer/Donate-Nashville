
<div class="main-col">
  <h1><?php echo $resource->title ?></h1>
  <?php if ($resource->showContactInformation()): ?>
    <div class='contact-info right full-margin'>
      <h3 class="no-margin">Contact Info</h3>
      <?php include_partial('resource/contact_info', array('resource' => $resource)) ?>
    </div>
  <?php endif; ?>
  
  <ul id="resource-info" class="text-large">
    <?php if ($resource['neighborhood']): ?>
      <li><strong>Community:</strong> <?php echo $resource['neighborhood'] ?></li>
    <?php endif ?>
    <?php if ($resource->quantity): ?>
      <li class="quantity"><strong>Quantity <?php echo $resource->transaction_type == 'have' ? 'Available' : 'Needed' ?>:</strong> <?php echo $resource->quantity ?></li>
    <?php endif ?>
  </ul>

  <p class="text-large">
		<?php echo $resource->description ?>
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

<?php slot('title', $resource['title']) ?>