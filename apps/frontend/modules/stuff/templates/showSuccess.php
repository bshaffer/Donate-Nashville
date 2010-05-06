<h1>Stuff Details: <?php echo $resource->title ?></h1>

<!-- more details here -->
<h3>Contact Info</h3>
<div class='contact-info'>
  <?php include_partial('user/contact_info', array('user' => $resource['User'])) ?>
</div>

<?php if ($resource['is_fulfilled']): ?>
  <span class="fulfilled"><?php echo image_tag('/sfDoctrinePlugin/images/tick.png', array('alt' => 'fulfilled')) ?>&nbsp;Fulfilled</span>
<?php elseif(!$sf_user->isOwner($resource)): ?>
  <!-- call to action here, which depends on whether this is a "need" looking for a "have" or vice versa -->
  <?php include_partial('resource/resource_contact_owner_form', array('form' => $form, 'type' => $type)) ?>
<?php endif ?>
