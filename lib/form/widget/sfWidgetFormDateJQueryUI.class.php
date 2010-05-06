<?php

/**
 * @author     Artur Rozek
 * @version    1.0.0
 */
class sfWidgetFormDateJQueryUI extends sfWidgetForm
{
  /**
   * Configures the current widget.
   *
   * Available options:
   *
   * @param string   culture           Sets culture for the widget
   * @param boolean  change_month      If date chooser attached to widget has month select dropdown, defaults to false
   * @param boolean  change_year       If date chooser attached to widget has year select dropdown, defaults to false
   * @param integer  number_of_months  Number of months visible in date chooser, defaults to 1
   * @param boolean  show_button_panel If date chooser shows panel with 'today' and 'done' buttons, defaults to false
   * @param string   theme             css theme for jquery ui interface, defaults to '/sfJQueryUIPlugin/css/ui-lightness/jquery-ui.css'
   * 
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {

    if(sfContext::hasInstance())
     $this->addOption('culture', sfContext::getInstance()->getUser()->getCulture());
    else
     $this->addOption('culture', "en");
    $this->addOption('change_month',  false);
    $this->addOption('change_year',  false);
    $this->addOption('number_of_months', 1);
    $this->addOption('show_button_panel',  false);
    $this->addOption('date_format',  null);
    $this->addOption('theme', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/cupertino/jquery-ui.css');

    
    parent::configure($options, $attributes);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $attributes = $this->getAttributes();
    
    // Set date to requested format
    if ($this->getOption('date_format') && $value) 
    {
      $value = date($this->getOption('date_format'), strtotime($value));
    }
    
    $input = new sfWidgetFormInput(array(), $attributes);

    $html = $input->render($name, $value);

    $id = $input->generateId($name);
    $culture = $this->getOption('culture');
    $cm = $this->getOption("change_month") ? "true" : "false";
    $cy = $this->getOption("change_year") ? "true" : "false";
    $nom = $this->getOption("number_of_months");
    $sbp = $this->getOption("show_button_panel") ? "true" : "false";

    if ($culture!='en')
    {
    $html .= <<<EOHTML
<script type="text/javascript">
	$(function() {
    var params = $.datepicker.regional['$culture'];
    params.changeMonth = $cm;
    params.changeYear = $cy;
    params.numberOfMonths = $nom;
    params.showButtonPanel = $sbp;
    $("#$id").datepicker(params);
	});
</script>
EOHTML;
    }
    else
    {
    $html .= <<<EOHTML
<script type="text/javascript">
	$(function() {
    var params = {
    changeMonth : $cm,
    changeYear : $cy,
    numberOfMonths : $nom,
    showButtonPanel : $sbp };
    $("#$id").datepicker(params);
	});
</script>
EOHTML;
    }

    return $html;
  }

  /*
   *
   * Gets the stylesheet paths associated with the widget.
   *
   * @return array An array of stylesheet paths
   */
  public function getStylesheets()
  {
    $theme = $this->getOption('theme');
    return $theme ? array($theme => 'screen') : array();
  }

  /**
   * Gets the JavaScript paths associated with the widget.
   *
   * @return array An array of JavaScript paths
   */
  public function getJavaScripts()
  {
    return array(); // Take care of this in view layer!
  }
  
}
