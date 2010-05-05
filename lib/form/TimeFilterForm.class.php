<?php

/**
* TimeFilterForm
*/
class TimeFilterForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'resource_date'   => new sfWidgetFormJQueryDate(),
      'start_time'      => new dnWidgetFormJQueryTimePicker(),
      'end_time'        => new dnWidgetFormJQueryTimePicker(),
      ));
      
    $this->setValidators(array(
      'resource_date'   => new sfValidatorDate(),
      'start_time'      => new sfValidatorTime(),
      'end_time'        => new sfValidatorTime(),
      ));
      
    $this->setDefaults(array(
      'start'         => date('Y-m-d'),
      ));
  }
}
