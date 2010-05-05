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
  
  /**
   * @see ResourceForm
   */
  protected function getTransactionType()
  {
    return 'need';
  }
}
