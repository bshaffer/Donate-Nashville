<form action="<?php echo url_for('@have_time_create') ?>" method="post" name="time_resource">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>
  
  <?php //echo $form['']->render() ?>
  
  <input type="submit" value="submit" />
</form>
