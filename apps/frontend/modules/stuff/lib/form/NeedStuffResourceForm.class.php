<?php

/**
 * Form for "I need stuff resource" form. Creates StuffResource objects
 * with transaction type "need".
 * 
 * @package     DN
 * @subpackage  form
 * @author      Ryan Weaver <ryan.weaver@iostudio.com>
 */
class NeedStuffResourceForm extends StuffResourceForm
{
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
      'title',
      'quantity',
      'neighborhood',
      'contact_name',
      'address_1',
      'address_2',
      'city',
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
    return 'need';
  }
}
