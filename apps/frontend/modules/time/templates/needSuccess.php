<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('@need_time_create') ?>" method="post" name="time_resource">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>
  
  <div>
    <label>When</label>
    
    <div>
      <?php echo $form['resource_date']->render() ?>
      <?php echo $form['resource_date']->renderError() ?>
    </div>
    
    <div>
      <?php echo $form['start_time']->render() ?>
      <?php echo $form['start_time']->renderError() ?>
      
      <?php echo $form['end_time']->renderError() ?>
      <?php echo $form['end_time']->render() ?> 
    </div>
  </div>
  
  <br style="clear:both;" />
  
  <div>
    <div style="float:left;">
      What
    </div>
    <div style="float:left;">
      <?php echo $form['title']->renderError() ?>
      <?php echo $form['title']->render() ?>
    </div>
  </div>
  
  <br style="clear:both;" />
  
  <div>
    <div style="float:left;">
      Where
    </div>
    <div style="float:left;">
      <?php echo $form['address_1']->renderError() ?>
      <?php echo $form['address_1']->render() ?>
      <br />
      <?php echo $form['address_2']->renderError() ?>
      <?php echo $form['address_2']->render() ?>
      <br />
      <?php echo $form['city']->renderError() ?>
      <?php echo $form['city']->render() ?>
      <br />
      <?php echo $form['state']->renderError() ?>
      <?php echo $form['state']->render() ?>
      <br />
      <?php echo $form['zip']->renderError() ?>
      <?php echo $form['zip']->render() ?>
    </div>
  </div>
  
  <br style="clear:both;" />
  
  <div>
    <div style="float:left;">
      Description
    </div>
    <div style="float:left;">
      <?php echo $form['description']->renderError() ?>
      <?php echo $form['description']->render() ?>
    </div>
  </div>
  
  <br style="clear:both;" />
  
  <div>
    <div style="float:left;">
      # of Volunteers
    </div>
    <div style="float:left;">
      <?php echo $form['num_volunteers']->renderError() ?>
      <?php echo $form['num_volunteers']->render() ?>
    </div>
  </div>
  
  <br style="clear:both;" />
  
  <div>
    <div style="float:left;">
      Contact Info
    </div>
    <div style="float:left;">
      <?php echo $form['email']->renderError() ?>
      <?php echo $form['email']->render() ?>
      <br />
      <?php echo $form['phone_1']->renderError() ?>
      <?php echo $form['phone_1']->render() ?>
      <br />
      <?php echo $form['phone_2']->renderError() ?>
      <?php echo $form['phone_2']->render() ?>
    </div>
  </div>
  
  <br style="clear:both;" />
  
  <div>
    <div style="float:left;">
      Privacy
    </div>
    <div style="float:left;">
      <?php echo $form['privacy']->renderError() ?>
      <?php echo $form['privacy']->render() ?>
    </div>
  </div>
  
  <br style="clear:both;" />
  
  <input type="submit" value="submit" />
</form>
