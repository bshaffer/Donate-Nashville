<?php

/**
* 
*/
class sfWidgetFormChoiceAjaxEvent extends sfWidgetForm
{
  public function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('choice_widget');
    $this->addRequiredOption('update');
    $this->addRequiredOption('url');
    
    $this->addOption('on_empty');
    $this->addOption('update_on_load', true);

    parent::configure($options, $attributes);
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $content = $this->getOption('choice_widget')->render($name, $value, $attributes, $errors);
    $content .= $this->getJavascript($name);
    return $content;
  }
  
  public function getJavascript($name)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Tag', 'Url');
    $addEmpty = $this->getOption('on_empty') ? 
                  sprintf("if(selectedVal == '') { $('%s').html('%s').show();return;}", $this->getOption('update'), $this->getOption('on_empty')) : '';
    $javascripts = <<<EOF
    <script type="text/javascript">
// Default jQuery wrapper
$(document).ready(function() {

  // When the choice widget is changed
  $("#%s").change(function() {
    // Hide the target element
    var selectedVal = $(this).attr("value");
    
    %s

    $("%s").addClass('indicator').html(' ');
    
    // url of the JSON
    var url = "%s" + selectedVal;

    // Get the JSON for the selected item
    $("%s").load(url, function() {
      $(this).removeClass('indicator');
    });
  })%s
}); 
</script>
EOF;

    return sprintf($javascripts, $this->generateId($name), 
                                 $addEmpty,
                                 $this->getOption('update'),
                                 url_for($this->getOption('url')),
                                 $this->getOption('update'),
                                 $this->getOption('update_on_load') ? '.change();' : '');
  }
}
