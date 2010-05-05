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
   * Returns either "need" or "have". This should be implemented by
   * subclasses, then it will be automatically set correct
   * 
   * This should be abstract, but for time I didn't do that because I
   * didn't want to fool with making all the subclasses abstract and
   * whatever might happen there.
   */
  protected function getTransactionType()
  {
    throw new sfException('override this function');
  }

  public function doUpdateObject($values = null)
  {
    parent::doUpdateObject($values);
    
    $this->getObject()->transaction_type = $this->getTransactionType();
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
