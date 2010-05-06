<dl>
  <?php if ($name = $user->getFullName()): ?>
    <dt>Name</dt>
    <dd><?php echo $name ?></dd>    
  <?php endif ?>
  
  <?php if ($phone1 = $user['Profile']['phone_1']): ?>
    <dt>Phone 1</dt>
    <dd><?php echo $phone1 ?></dd>    
  <?php endif ?>

  <?php if ($phone2 = $user['Profile']['phone_2']): ?>
    <dt>Phone 2</dt>
    <dd><?php echo $phone2 ?></dd>    
  <?php endif ?>
  
  <?php if ($address = $user['Profile']->getAddress()): ?>
    <dt>Address</dt>
    <dd><?php echo $address ?></dd>
  <?php endif ?>  
</dl>