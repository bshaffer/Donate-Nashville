<?php

/**
 * HousingResource form base class.
 *
 * @method HousingResource getObject() Returns the current form's model object
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseHousingResourceForm extends ResourceForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['num_rooms'] = new sfWidgetFormInputText();
    $this->validatorSchema['num_rooms'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema   ['square_footage'] = new sfWidgetFormInputText();
    $this->validatorSchema['square_footage'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema   ['address_1'] = new sfWidgetFormInputText();
    $this->validatorSchema['address_1'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

    $this->widgetSchema   ['address_2'] = new sfWidgetFormInputText();
    $this->validatorSchema['address_2'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

    $this->widgetSchema   ['city'] = new sfWidgetFormInputText();
    $this->validatorSchema['city'] = new sfValidatorString(array('max_length' => 100, 'required' => false));

    $this->widgetSchema   ['state'] = new sfWidgetFormInputText();
    $this->validatorSchema['state'] = new sfValidatorString(array('max_length' => 100, 'required' => false));

    $this->widgetSchema   ['zip'] = new sfWidgetFormInputText();
    $this->validatorSchema['zip'] = new sfValidatorString(array('max_length' => 100, 'required' => false));

    $this->widgetSchema   ['phone_1'] = new sfWidgetFormInputText();
    $this->validatorSchema['phone_1'] = new sfValidatorString(array('max_length' => 100, 'required' => false));

    $this->widgetSchema   ['phone_2'] = new sfWidgetFormInputText();
    $this->validatorSchema['phone_2'] = new sfValidatorString(array('max_length' => 100, 'required' => false));

    $this->widgetSchema   ['email'] = new sfWidgetFormInputText();
    $this->validatorSchema['email'] = new sfValidatorString(array('max_length' => 100, 'required' => false));

    $this->widgetSchema->setNameFormat('housing_resource[%s]');
  }

  public function getModelName()
  {
    return 'HousingResource';
  }

}
