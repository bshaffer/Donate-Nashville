<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php use_helper('dh') ?>

<h2>I <?php echo ucfirst(opposite_of($resource->transaction_type)) ?> This!</h2>
<?php echo $form->renderFormTag(url_for('new_message_match_found', array('id'=>$resource->id)), array('class'=>'async')) ?>
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

<?php use_javascript('jquery/jquery.form.js')?>

<script type="text/javascript">
  $(document).ready(function () {
    var options = { 
        target:        $('form.async').parent()   // target element(s) to be updated with server response 
        // beforeSubmit:  showRequest,  // pre-submit callback 
        // success:       showResponse  // post-submit callback 
        
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        // dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
        
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    };
    
    $('.async').ajaxForm(options);
  });
</script>