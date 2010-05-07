<?php

/**
 * Form for "I need time resource" form. Creates TimeResource objects
 * with transaction type "need".
 * 
 * @package     DN
 * @subpackage  form
 * @author      Ryan Weaver <ryan.weaver@iostudio.com>
 */
class NeedTimeResourceForm extends TimeResourceForm
{
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
      'resource_date',
      'start_time',
      'end_time',
      'title',
      'neighborhood',
      'contact_name',
      'address_1',
      'address_2',
      'city',
      'zip',
      'description',
      'num_volunteers',
      'email',
      'phone_1',
      'phone_2',
      'privacy'
    ));
    
    $this->widgetSchema['resource_date'] = new sfWidgetFormJQueryDate();
    $this->widgetSchema['start_time'] = new dnWidgetFormJQueryTimePicker();
    $this->widgetSchema['end_time'] = new dnWidgetFormJQueryTimePicker();

    $this->validatorSchema['start_time']->setOption('required', true);
    $this->validatorSchema['end_time']->setOption('required', true);
    $this->mergePostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'validateStartEnd')))
    );

    // set some labels
    $this->widgetSchema->setLabel('address_1', 'Where (address)');
    $this->widgetSchema->setLabel('num_volunteers', '# of Volunteers');
    $this->widgetSchema->setLabel('phone_1', 'Primary Phone Number');
    $this->widgetSchema->setLabel('phone_2', 'Alternate Phone Number');
  }

  /**
   * @see ResourceForm
   */
  protected function getTransactionType()
  {
    return 'need';
  }
  
  /**
   * make sure the start time is before the end time
   */
  public function validateStartEnd($validator, $values)
  {
    $start = strtotime($values['start_time']);
    $end = strtotime($values['end_time']);
    if ($start > $end)
    {
      // start time is later than end time, throw an error
      throw new sfValidatorError($validator, 'Start time cannot be later than end time');
    }
 
    // times are fine, return values
    return $values;
  }
}
