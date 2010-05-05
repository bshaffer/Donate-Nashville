<?php

/**
 * Time picking widget
 * 
 * @package     dn
 * @subpackage  widget
 * @author      Ryan Weaver <ryan@thatsquality.com>
 */

class dnWidgetFormJQueryTimePicker extends sfWidgetFormInputText
{
  /**
   * @see sfWidgetFormInputText
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $tag = parent::renderTag('input', array_merge(array('type' => $this->getOption('type'), 'name' => $name, 'value' => $value), $attributes));

    $javascript = sprintf("
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('#%s').timePicker({
      show24Hours: false,
      step: 15,
      startTime: '05:00',
      endTime:   '23:00'
    });
  });
</script>", $this->generateId($name, $value));

    return $tag . $javascript;
  }

  /**
   * The stylesheets must be specified as the keys of the array, I know this is weird, but
   * I think it has something to do with the value of the array being the position (first, last)
   * in which the stylesheet is added
   * 
   * @see sfWidget
   */
  public function getStylesheets()
  {
    return array('jquery.timepicker.css' => '');
  }

  /**
   * @see sfWidget
   */
  public function getJavaScripts()
  {
    return array('jquery/jquery.timepicker.js');
  }
}