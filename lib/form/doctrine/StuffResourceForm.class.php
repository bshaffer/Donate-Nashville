<?php

/**
 * StuffResource form.
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StuffResourceForm extends BaseStuffResourceForm
{
  /**
   * @see ResourceForm
   */
  public function configure()
  {
    $this->useFields(array(
      'title',
      'quantity',
      'neighborhood',
      'contact_name',
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
    
    // set some labels
    $this->widgetSchema->setLabel('address_1', 'Where (address)');
    $this->widgetSchema->setLabel('phone_1', 'Primary Phone Number');
    $this->widgetSchema->setLabel('phone_2', 'Alternate Phone Number');
    
    parent::configure();
  }
}
