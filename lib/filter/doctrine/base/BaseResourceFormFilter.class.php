<?php

/**
 * Resource filter form base class.
 *
 * @package    skeleton
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseResourceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'owner_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'transaction_type'  => new sfWidgetFormChoice(array('choices' => array('' => '', 'need' => 'need', 'have' => 'have'))),
      'title'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'       => new sfWidgetFormFilterInput(),
      'show_contact_info' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_satisfied'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'address_1'         => new sfWidgetFormFilterInput(),
      'address_2'         => new sfWidgetFormFilterInput(),
      'city'              => new sfWidgetFormFilterInput(),
      'state'             => new sfWidgetFormFilterInput(),
      'zip'               => new sfWidgetFormFilterInput(),
      'phone_1'           => new sfWidgetFormFilterInput(),
      'phone_2'           => new sfWidgetFormFilterInput(),
      'email'             => new sfWidgetFormFilterInput(),
      'latitude'          => new sfWidgetFormFilterInput(),
      'longitude'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'owner_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'transaction_type'  => new sfValidatorChoice(array('required' => false, 'choices' => array('need' => 'need', 'have' => 'have'))),
      'title'             => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'show_contact_info' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_satisfied'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'address_1'         => new sfValidatorPass(array('required' => false)),
      'address_2'         => new sfValidatorPass(array('required' => false)),
      'city'              => new sfValidatorPass(array('required' => false)),
      'state'             => new sfValidatorPass(array('required' => false)),
      'zip'               => new sfValidatorPass(array('required' => false)),
      'phone_1'           => new sfValidatorPass(array('required' => false)),
      'phone_2'           => new sfValidatorPass(array('required' => false)),
      'email'             => new sfValidatorPass(array('required' => false)),
      'latitude'          => new sfValidatorPass(array('required' => false)),
      'longitude'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Resource';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'owner_id'          => 'ForeignKey',
      'transaction_type'  => 'Enum',
      'title'             => 'Text',
      'description'       => 'Text',
      'show_contact_info' => 'Boolean',
      'is_satisfied'      => 'Boolean',
      'address_1'         => 'Text',
      'address_2'         => 'Text',
      'city'              => 'Text',
      'state'             => 'Text',
      'zip'               => 'Text',
      'phone_1'           => 'Text',
      'phone_2'           => 'Text',
      'email'             => 'Text',
      'latitude'          => 'Text',
      'longitude'         => 'Text',
    );
  }
}
