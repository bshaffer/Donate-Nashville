<?php

/**
* TimeFilterForm
*/
class TimeFilterForm extends sfForm
{
  public function configure()
  {
    $choices = array(
      ''      => 'Anytime', 
      '00:00' => 'Morning (12am-12am)', 
      '12:00' => 'Afternoon (12pm-5pm)',
      '17:00' => 'Night (5pm-12am)'
      );
      
    $this->setWidgets(array(
      'start'   => new csWidgetFormDateTime(array(
        'separate_names'  => true,
        'date_widget'     => new sfWidgetFormDateJQueryUI(array('theme' => false)),
        'time_widget'     => new sfWidgetFormSelect(array('choices' => $choices)))),
      'end'   => new csWidgetFormDateTime(array(
        'separate_names'  => true,
        'date_widget'     => new sfWidgetFormDateJQueryUI(array('theme' => false)),
        'time_widget'     => new sfWidgetFormSelect(array('choices' => $choices)))),
      ));
      
    $this->setValidators(array(
      'start'   => new sfValidatorDate(),
      'end'      => new sfValidatorTime(),
      ));
      
    $this->setDefaults(array(
      'start'         => date('Y-m-d'),
      ));
  }
}
