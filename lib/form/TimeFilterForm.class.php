<?php

/**
* TimeFilterForm
*/
class TimeFilterForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'start'           => new sfWidgetFormJQueryDateTime(),
      'end'           => new sfWidgetFormJQueryDateTime(),
      ));
      
    $this->setValidators(array(
      'start'           => new sfValidatorDate(),
      'end'           => new sfValidatorDate(),
      ));
      
    $this->setDefaults(array(
      'start'         => date('Y-m-d'),
      ));
  }
}
