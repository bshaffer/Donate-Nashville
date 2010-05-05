<?php

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
  
  public function doSave($con = null)
  {
    $email = $this->getValue('email');
    $user = sfContext::getInstance()->getUser();
    
    $this->getObject()->User = $user->getGuardUserByEmail($email);
    
    parent::doSave($con);
  }
}
