<?php

class NeedTimeResourceForm extends TimeResourceForm
{
  public function configure()
  {
    parent::configure();
    
    $this->useFields(array(
      'start_date',
      'end_date',
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
      'show_contact_info'
    ));
  }
  
  public function doSave($con = null)
  {
    $email = $this->getValue('email');
    $user = sfContext::getInstance()->getUser();
    
    $this->getObject()->User = $user->getGuardUserByEmail($email);
    
    parent::doSave($con);
  }
}
