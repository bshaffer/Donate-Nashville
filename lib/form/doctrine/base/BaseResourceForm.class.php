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
      'id'               => new sfWidgetFormInputHidden(),
      'owner_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'transaction_type' => new sfWidgetFormChoice(array('choices' => array('need' => 'need', 'have' => 'have'))),
      'title'            => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'privacy'          => new sfWidgetFormChoice(array('choices' => array('show_info' => 'show_info', 'web_form' => 'web_form'))),
      'is_fulfilled'     => new sfWidgetFormInputCheckbox(),
      'neighborhood'     => new sfWidgetFormInputText(),
      'contact_name'     => new sfWidgetFormInputText(),
      'address_1'        => new sfWidgetFormInputText(),
      'address_2'        => new sfWidgetFormInputText(),
      'city'             => new sfWidgetFormInputText(),
      'state'            => new sfWidgetFormInputText(),
      'zip'              => new sfWidgetFormInputText(),
      'county'           => new sfWidgetFormInputText(),
      'phone_1'          => new sfWidgetFormInputText(),
      'phone_2'          => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'latitude'         => new sfWidgetFormInputText(),
      'longitude'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'owner_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'transaction_type' => new sfValidatorChoice(array('choices' => array(0 => 'need', 1 => 'have'), 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255)),
      'description'      => new sfValidatorString(array('required' => false)),
      'privacy'          => new sfValidatorChoice(array('choices' => array(0 => 'show_info', 1 => 'web_form'), 'required' => false)),
      'is_fulfilled'     => new sfValidatorBoolean(array('required' => false)),
      'neighborhood'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'contact_name'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'address_1'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address_2'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'state'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'zip'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'county'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone_1'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone_2'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'latitude'         => new sfValidatorPass(array('required' => false)),
      'longitude'        => new sfValidatorPass(array('required' => false)),
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
