<form action="<?php echo url_for('@need_time_create') ?>" method="post" name="time_resource">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>
  
  <div>
    <div style="float:left;">
      When
    </div>
    <div style="float:left;">
      <?php echo $form['start_date']->renderError() ?>
      <?php echo $form['start_date']->render() ?>
      -
      <?php echo $form['end_date']->renderError() ?>
      <?php echo $form['end_date']->render() ?> 
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
      <?php echo $form['show_contact_info']->renderError() ?>
      <?php echo $form['show_contact_info']->render() ?>
    </div>
  </div>
  
  <br style="clear:both;" />
  
  <input type="submit" value="submit" />
</form>
