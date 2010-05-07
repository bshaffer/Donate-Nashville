<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php use_helper('dh','FormField') ?>

<?php echo $form->renderFormTag(url_for('new_contact_message', array(), array('class'=>'async'))) ?>
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields() ?>
  
<fieldset>
<legend>* Required field</legend>
  <ul>
      <li>
        <label>Email *</label>
        <?php echo outputFormField($form['email']) ?>
      </li>

      <li>
        <label>Name</label>
        <?php echo outputFormField($form['name']) ?>
      </li>

      <li>
        <label>Phone</label>
        <?php echo outputFormField($form['phone']) ?>
      </li>

      <li class="medium">
        <label>Notes</label>
        <?php echo outputFormField($form['notes']) ?>
      </li>
  
      <li>
        <input type="submit" value="Send my question" class="button"/>
      </li>
  </ul>
</fieldset>
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
