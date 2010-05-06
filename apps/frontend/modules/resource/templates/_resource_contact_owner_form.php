<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<h2>I <?php echo ucfirst($type) ?> This!</h2>
<form action="" method="post" name="resource_contact_owner">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>
  
  <div>
    <label><?php echo $form['email']->renderLabel() ?></label>
    
    <div>
      <?php echo $form['email']->renderError() ?>
      <?php echo $form['email']->render() ?>
    </div>
  </div>
  
  <div>
    <label><?php echo $form['name']->renderLabel() ?></label>
    
    <div>
      <?php echo $form['name']->renderError() ?>
      <?php echo $form['name']->render() ?>
    </div>
  </div>
  
  <div>
    <label><?php echo $form['phone']->renderLabel() ?></label>
    
    <div>
      <?php echo $form['phone']->renderError() ?>
      <?php echo $form['phone']->render() ?>
    </div>
  </div>
  
  <div>
    <label><?php echo $form['notes']->renderLabel() ?></label>
    
    <div>
      <?php echo $form['notes']->renderError() ?>
      <?php echo $form['notes']->render() ?>
    </div>
  </div>
  
  <input type="submit" value="Send my info" />
</form>
