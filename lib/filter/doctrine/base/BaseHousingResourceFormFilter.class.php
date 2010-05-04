<?php

/**
 * HousingResource filter form base class.
 *
 * @package    skeleton
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseHousingResourceFormFilter extends ResourceFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['num_rooms'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['num_rooms'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['square_footage'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['square_footage'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['address_1'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['address_1'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['address_2'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['address_2'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['city'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['city'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['state'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['state'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['zip'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['zip'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['phone_1'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['phone_1'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['phone_2'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['phone_2'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['email'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['email'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema->setNameFormat('housing_resource_filters[%s]');
  }

  public function getModelName()
  {
    return 'HousingResource';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'num_rooms' => 'Number',
      'square_footage' => 'Number',
      'address_1' => 'Text',
      'address_2' => 'Text',
      'city' => 'Text',
      'state' => 'Text',
      'zip' => 'Text',
      'phone_1' => 'Text',
      'phone_2' => 'Text',
      'email' => 'Text',
    ));
  }
}
