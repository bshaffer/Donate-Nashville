<?php

/**
 * Contact form base class.
 *
 * @method Contact getObject() Returns the current form's model object
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseContactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'resource_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resource'), 'add_empty' => true)),
      'email'       => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
      'notes'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'resource_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Resource'), 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 255)),
      'name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'phone'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'notes'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contact';
  }

}
