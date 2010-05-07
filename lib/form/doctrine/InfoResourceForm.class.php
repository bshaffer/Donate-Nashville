<?php

/**
 * InfoResource form.
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InfoResourceForm extends BaseInfoResourceForm
{
  /**
   * @see ResourceForm
   */
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
      'title',
      'description',
      'abstract',
      'transaction_type',
      'privacy',
      'contact_name',
      'address_1',
      'address_2',
      'city',
      'state',
      'zip',
      'phone_1',
      'phone_2',
      'email',
      'keywords',
      'url',
      ));
  }
  
  protected function getTransactionType()
  {
    return $this->getValue('transaction_type');
  }
}
