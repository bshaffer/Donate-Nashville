<dl class="no-margin">
  <?php if ($name = $resource['contact_name']): ?>
    <dt>Name</dt>
    <dd><?php echo $name ?></dd>    
  <?php endif ?>
  
  <?php if ($phone1 = $resource['phone_1']): ?>
    <dt>Primary Phone</dt>
    <dd><?php echo $phone1 ?></dd>    
  <?php endif ?>

  <?php if ($phone2 = $resource['phone_2']): ?>
    <dt>Secondary Phone</dt>
    <dd><?php echo $phone2 ?></dd>    
  <?php endif ?>
  
  <?php if ($address = $resource->getAddress()): ?>
    <dt>Address</dt>
    <dd><?php echo $address ?></dd>
  <?php endif ?>  
</dl>