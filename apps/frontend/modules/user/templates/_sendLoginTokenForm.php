<?php echo $form->renderFormTag(url_for('@send_login_token_process'), array('id' => 'send-token-form', 'method' => 'post')); ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>

<fieldset>
  <ul>
    <li>
      <label><?php echo $form['email']->renderLabel() ?></label>
      <div>
        <?php echo $form['email']->renderError() ?>
        <?php echo $form['email']->render() ?>
      </div>
    </li>

    <li><input type="submit" value="email me the link" /></li>
  </ul>
</fieldset>
</form>

<script type="text/javascript">
  $(document).ready(function(){
    initSendTokenAjaxForm();
  });
</script>
