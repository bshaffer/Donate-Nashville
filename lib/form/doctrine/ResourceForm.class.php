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
    $this->validatorSchema['description']->setOption('required', true);
    
    $this->widgetSchema['state'] = new sfWidgetFormSelectUSState();
    $this->validatorSchema['state'] = new sfValidatorChoice(array(
      'choices' => sfWidgetFormSelectUSState::getStateAbbreviations(),
    ));
    
    $this->validatorSchema['email'] = new sfValidatorEmail();
    
    $this->widgetSchema['privacy'] = new sfWidgetFormChoice(array('choices' => array(
      'show_info' => 'Show my info as well as a contact form',
      'web_form'  => 'Show a contact form, but hide my information',
    )));
    
    $neighborhoods = array(
      'Outside Nashville'   => 'Outside Nashville',
      'areas'               => ' -- Nashville Areas --',
        'North Nashville'   => 'North Nashville',
        'South Nashville'   => 'South Nashville',
        'East Nashville'    => 'East Nashville',
        'West Nashville'    => 'West Nashville',
      'neighborhoods'       => ' -- Nashville Neighborhoods --',
        'Antioch'           => 'Antioch',
        'Brentwood'         => 'Brentwood',
      );
    
    $this->widgetSchema['neighborhood'] = new sfWidgetFormChoice(array('choices' => $neighborhoods));
    
    // Unset invalid options
    unset($neighborhoods['areas'], $neighborhoods['neighborhoods']); 
    $this->validatorSchema['neighborhood'] = new sfValidatorChoice(array('choices' => array_keys($neighborhoods)));
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

  public function doUpdateObject($values)
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
