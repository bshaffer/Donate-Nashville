<h1>Event Details: <?php echo $resource->title ?></h1>

<!-- more details here -->
<h3>Contact Info</h3>
<div class='contact-info'>
  <?php include_partial('user/contact_info', array('user' => $resource['User'])) ?>
</div>

<!-- call to action here, which depends on whether this is a "need" looking for a "have" or vice versa -->

<input type="button" value="Contact This User" onclick="window.location = '<?php echo url_for('@user_contact?id='.$resource['owner_id']) ?>';"/>