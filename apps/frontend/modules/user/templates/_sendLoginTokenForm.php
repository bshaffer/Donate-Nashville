<?php echo $form->renderFormTag(url_for('@send_login_token_process'), array('id' => 'send-token-form', 'method' => 'post')); ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>

  <?php echo $form['email']->renderLabel() ?>
  <?php echo $form['email']->renderError() ?>
  <?php echo $form['email']->render() ?>

  <input type="submit" value="email me the link" />
</form>

<script type="text/javascript">
  $(document).ready(function(){
    initSendTokenAjaxForm();
  });
</script>