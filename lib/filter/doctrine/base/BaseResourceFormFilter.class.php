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
      'owner_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'transaction_type' => new sfWidgetFormChoice(array('choices' => array('' => '', 'need' => 'need', 'have' => 'have'))),
      'title'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'      => new sfWidgetFormFilterInput(),
      'privacy'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'show_info' => 'show_info', 'web_form' => 'web_form'))),
      'is_fulfilled'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'neighborhood'     => new sfWidgetFormFilterInput(),
      'contact_name'     => new sfWidgetFormFilterInput(),
      'address_1'        => new sfWidgetFormFilterInput(),
      'address_2'        => new sfWidgetFormFilterInput(),
      'city'             => new sfWidgetFormFilterInput(),
      'state'            => new sfWidgetFormFilterInput(),
      'zip'              => new sfWidgetFormFilterInput(),
      'county'           => new sfWidgetFormFilterInput(),
      'phone_1'          => new sfWidgetFormFilterInput(),
      'phone_2'          => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'latitude'         => new sfWidgetFormFilterInput(),
      'longitude'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'owner_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'transaction_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('need' => 'need', 'have' => 'have'))),
      'title'            => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'privacy'          => new sfValidatorChoice(array('required' => false, 'choices' => array('show_info' => 'show_info', 'web_form' => 'web_form'))),
      'is_fulfilled'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'neighborhood'     => new sfValidatorPass(array('required' => false)),
      'contact_name'     => new sfValidatorPass(array('required' => false)),
      'address_1'        => new sfValidatorPass(array('required' => false)),
      'address_2'        => new sfValidatorPass(array('required' => false)),
      'city'             => new sfValidatorPass(array('required' => false)),
      'state'            => new sfValidatorPass(array('required' => false)),
      'zip'              => new sfValidatorPass(array('required' => false)),
      'county'           => new sfValidatorPass(array('required' => false)),
      'phone_1'          => new sfValidatorPass(array('required' => false)),
      'phone_2'          => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'latitude'         => new sfValidatorPass(array('required' => false)),
      'longitude'        => new sfValidatorPass(array('required' => false)),
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
      'id'               => 'Number',
      'owner_id'         => 'ForeignKey',
      'transaction_type' => 'Enum',
      'title'            => 'Text',
      'description'      => 'Text',
      'privacy'          => 'Enum',
      'is_fulfilled'     => 'Boolean',
      'neighborhood'     => 'Text',
      'contact_name'     => 'Text',
      'address_1'        => 'Text',
      'address_2'        => 'Text',
      'city'             => 'Text',
      'state'            => 'Text',
      'zip'              => 'Text',
      'county'           => 'Text',
      'phone_1'          => 'Text',
      'phone_2'          => 'Text',
      'email'            => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'latitude'         => 'Text',
      'longitude'        => 'Text',
    );
  }
}
