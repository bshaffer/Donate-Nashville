<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('@add_have_stuff') ?>" method="post" name="stuff_resource" class="styled-form">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>
  
  <div>
    <?php echo $form['title']->renderLabel() ?>
    <div>
      <?php echo $form['title']->renderError() ?>
      <?php echo $form['title']->render() ?>
    </div>
  </div>
  
  <div>
    <?php echo $form['quantity']->renderLabel() ?>
    <div>
      <?php echo $form['quantity']->renderError() ?>
      <?php echo $form['quantity']->render() ?>
    </div>
  </div>
  
  <?php echo $form['neighborhood']->renderLabel() ?>
  <div>
    <?php echo $form['neighborhood']->renderError() ?>
    <?php echo $form['neighborhood']->render() ?>
  </div>

  <?php echo $form['address_1']->renderLabel() ?>
  <div>
    <?php echo $form['address_1']->renderError() ?>
    <?php echo $form['address_1']->render() ?>
  </div>
  
  <div>
    <?php echo $form['address_2']->renderError() ?>
    <?php echo $form['address_2']->render() ?>
  </div>
  
  <?php echo $form['city']->renderLabel() ?>
  <div>
    <?php echo $form['city']->renderError() ?>
    <?php echo $form['city']->render() ?>
  </div>
  
  <?php echo $form['state']->renderLabel() ?>
  <div>
    <?php echo $form['state']->renderError() ?>
    <?php echo $form['state']->render() ?>
  </div>
  
  <?php echo $form['zip']->renderLabel() ?>
  <div>
    <?php echo $form['zip']->renderError() ?>
    <?php echo $form['zip']->render() ?>
  </div>
  
  <div class="form-description">
    <?php echo $form['description']->renderLabel() ?>
    <div>
      <?php echo $form['description']->renderError() ?>
      <?php echo $form['description']->render() ?>
    </div>
  </div>
    
  <?php echo $form['email']->renderLabel() ?>
  <div>
    <?php echo $form['email']->renderError() ?>
    <?php echo $form['email']->render() ?>
  </div>

  <?php echo $form['phone_1']->renderLabel() ?>
  <div>
    <?php echo $form['phone_1']->renderError() ?>
    <?php echo $form['phone_1']->render() ?>
  </div>

  <?php echo $form['phone_2']->renderLabel() ?>
  <div>
    <?php echo $form['phone_2']->renderError() ?>
    <?php echo $form['phone_2']->render() ?>
  </div>
  
  <div>
    <?php echo $form['privacy']->renderLabel() ?>
    <div>
      <?php echo $form['privacy']->renderError() ?>
      <?php echo $form['privacy']->render() ?>
    </div>
  </div>
  
  <input type="submit" value="submit" />
</form>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>