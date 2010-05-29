<?php use_helper('dh') ?>

<h1>We have a match for "<?php echo $resource['title'] ?>"!</h1>

<p>
  User <?php echo $contact['name'] ?> says they <?php echo opposite_of($type) ?> what you <?php echo $type ?>!
</p>

<p>You can contact them using the information below:</p>

<dl>
  <?php if ($contact['email']): ?>
    <dt><strong>Email:</strong></dt>
    <dd><?php echo $contact['email'] ?></dd>
  <?php endif ?>

  <?php if ($contact['phone']): ?>
    <dt><strong>Phone:</strong></dt>
    <dd><?php echo $contact['phone'] ?></dd>    
  <?php endif ?>
  
  <?php if ($contact['notes']): ?>
    <dt><strong>Add'l Info:</strong></dt>
    <dd><?php echo $contact['notes'] ?></dd>    
  <?php endif ?>

</dl>

<p>
  Click the link below to edit, remove, or mark your item as fulfilled:
  <br /><?php echo url_for('@user_auth?token='.$resource->User->password, array('absolute' => true)); ?>
</p>
