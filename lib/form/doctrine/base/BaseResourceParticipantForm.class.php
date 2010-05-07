<?php

/**
 * ResourceParticipant form base class.
 *
 * @method ResourceParticipant getObject() Returns the current form's model object
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseResourceParticipantForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'participant_id' => new sfWidgetFormInputText(),
      'resource_id'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'participant_id' => new sfValidatorInteger(),
      'resource_id'    => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('resource_participant[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResourceParticipant';
  }

}
