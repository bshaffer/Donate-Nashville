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
      'address_1',
      'address_2',
      'city',
      'state',
      'zip',
      'description',
      'num_volunteers',
      'email',
      'phone_1',
      'phone_2',
      'privacy'
    ));
    
    $this->widgetSchema['resource_date'] = new sfWidgetFormJQueryDate();
  }

  /**
   * @see ResourceForm
   */
  protected function getTransactionType()
  {
    return 'need';
  }
}
