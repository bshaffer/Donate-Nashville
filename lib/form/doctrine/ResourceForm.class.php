<?php

/**
 * Resource form.
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ResourceForm extends BaseResourceForm
{
  public function configure()
  {
    $this->validatorSchema['privacy']->setOption('required', true);
    $this->validatorSchema['email']->setOption('required', true);
  }

  /**
   * Overridden so that we can allow a user to simply enter an email
   * address, and they'll automatically be registered if not already
   * registered
   */
  public function doSave($con = null)
  {
    $email = $this->getValue('email');
    
    $user = sfContext::getInstance()->getUser();
    if (!$guardUser = $user->getGuardUser())
    {
      $guardUser = Doctrine_Core::getTable('sfGuardUser')->getOrCreateUserByEmail($email);
    }
    
    $this->getObject()->User = $guardUser;
    
    parent::doSave($con);
  }
}
