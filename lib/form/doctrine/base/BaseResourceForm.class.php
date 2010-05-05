<?php

/**
 * Resource form base class.
 *
 * @method Resource getObject() Returns the current form's model object
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseResourceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'owner_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'transaction_type'  => new sfWidgetFormChoice(array('choices' => array('need' => 'need', 'have' => 'have'))),
      'title'             => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'show_contact_info' => new sfWidgetFormInputCheckbox(),
      'is_satisfied'      => new sfWidgetFormInputCheckbox(),
      'address_1'         => new sfWidgetFormInputText(),
      'address_2'         => new sfWidgetFormInputText(),
      'city'              => new sfWidgetFormInputText(),
      'state'             => new sfWidgetFormInputText(),
      'zip'               => new sfWidgetFormInputText(),
      'phone_1'           => new sfWidgetFormInputText(),
      'phone_2'           => new sfWidgetFormInputText(),
      'email'             => new sfWidgetFormInputText(),
      'latitude'          => new sfWidgetFormInputText(),
      'longitude'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'owner_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'transaction_type'  => new sfValidatorChoice(array('choices' => array(0 => 'need', 1 => 'have'))),
      'title'             => new sfValidatorString(array('max_length' => 255)),
      'description'       => new sfValidatorString(array('required' => false)),
      'show_contact_info' => new sfValidatorBoolean(array('required' => false)),
      'is_satisfied'      => new sfValidatorBoolean(array('required' => false)),
      'address_1'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address_2'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'state'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'zip'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone_1'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone_2'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'latitude'          => new sfValidatorPass(array('required' => false)),
      'longitude'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Resource';
  }

}
