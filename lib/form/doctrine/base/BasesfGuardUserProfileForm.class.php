<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'address_1'    => new sfWidgetFormInputText(),
      'address_2'    => new sfWidgetFormInputText(),
      'city'         => new sfWidgetFormInputText(),
      'state'        => new sfWidgetFormInputText(),
      'zip'          => new sfWidgetFormInputText(),
      'phone_1'      => new sfWidgetFormInputText(),
      'phone_2'      => new sfWidgetFormInputText(),
      'facebook_uid' => new sfWidgetFormInputText(),
      'account_type' => new sfWidgetFormChoice(array('choices' => array('individual' => 'individual', 'shelter' => 'shelter', 'nonprofit' => 'nonprofit'))),
      'latitude'     => new sfWidgetFormInputText(),
      'longitude'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'address_1'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address_2'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'state'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'zip'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone_1'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone_2'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'facebook_uid' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'account_type' => new sfValidatorChoice(array('choices' => array(0 => 'individual', 1 => 'shelter', 2 => 'nonprofit'), 'required' => false)),
      'latitude'     => new sfValidatorPass(array('required' => false)),
      'longitude'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

}
