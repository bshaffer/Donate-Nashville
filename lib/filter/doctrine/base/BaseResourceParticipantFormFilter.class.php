<?php

/**
 * ResourceParticipant filter form base class.
 *
 * @package    skeleton
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseResourceParticipantFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'participant_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resource_id'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'participant_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resource_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('resource_participant_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResourceParticipant';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'participant_id' => 'Number',
      'resource_id'    => 'Number',
    );
  }
}
