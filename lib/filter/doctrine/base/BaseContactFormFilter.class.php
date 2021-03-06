<?php

/**
 * Contact filter form base class.
 *
 * @package    skeleton
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseContactFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'resource_id'   => new sfWidgetFormFilterInput(),
      'resource_type' => new sfWidgetFormFilterInput(),
      'email'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'          => new sfWidgetFormFilterInput(),
      'phone'         => new sfWidgetFormFilterInput(),
      'notes'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'resource_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resource_type' => new sfValidatorPass(array('required' => false)),
      'email'         => new sfValidatorPass(array('required' => false)),
      'name'          => new sfValidatorPass(array('required' => false)),
      'phone'         => new sfValidatorPass(array('required' => false)),
      'notes'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contact';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'resource_id'   => 'Number',
      'resource_type' => 'Text',
      'email'         => 'Text',
      'name'          => 'Text',
      'phone'         => 'Text',
      'notes'         => 'Text',
    );
  }
}
