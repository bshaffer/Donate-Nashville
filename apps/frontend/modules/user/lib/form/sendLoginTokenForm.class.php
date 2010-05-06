<?php

class sendLoginTokenForm extends BaseForm
{
  /**
   * The user that will be matched on via email
   */
  protected $user;

  public function configure()
  {
    $this->widgetSchema['email'] = new sfWidgetFormInputText();
    
    $this->validatorSchema['email'] = new sfValidatorAnd(array(
      new sfValidatorEmail(),
      new sfValidatorCallback(array('callback' => array($this, 'validateEmail'))),
    ));
    $this->validatorSchema['email']->setMessage('required', 'Please enter your email address');
    $this->validatorSchema['email']->setMessage('invalid', 'That email address was not found in our system');
    
    $this->widgetSchema->setNameFormat('send_login[%s]');
  }

  /**
   * Validates that the email exists in our system
   */
  public function validateEmail($validator, $value, $options)
  {
    // let the required validator catch this
    if (!$value)
    {
      return $value;
    }
    
    $this->user = Doctrine_Core::getTable('sfGuardUser')->findOneByEmailAddress($value);
    if (!$this->user)
    {
      throw new sfValidatorError($validator, 'invalid');
    }
    
    return $value;
  }

  /**
   * Accessor for the matched user - can be used on bound, valid forms
   */
  public function getUser()
  {
    return $this->user;
  }
}