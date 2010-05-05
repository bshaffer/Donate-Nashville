<?php

/**
 * Form for "I have stuff resource" form. Creates StuffResource objects
 * with transaction type "have".
 * 
 * @package     DN
 * @subpackage  form
 * @author      Adam Kimbrel <adam.kimbrel@iostudio.com>
 */
class HaveStuffResourceForm extends StuffResourceForm
{
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
      'title',
      'quantity',
      'address_1',
      'address_2',
      'city',
      'state',
      'zip',
      'description',
      'email',
      'phone_1',
      'phone_2',
      'privacy'
    ));
  }
  
  /**
   * @see ResourceForm
   */
  protected function getTransactionType()
  {
    return 'have';
  }
}
