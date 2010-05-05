<?php

/**
 * TimeResource form base class.
 *
 * @method TimeResource getObject() Returns the current form's model object
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTimeResourceForm extends ResourceForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['start_date'] = new sfWidgetFormDateTime();
    $this->validatorSchema['start_date'] = new sfValidatorDateTime();

    $this->widgetSchema   ['end_date'] = new sfWidgetFormDateTime();
    $this->validatorSchema['end_date'] = new sfValidatorDateTime();

    $this->widgetSchema   ['num_volunteers'] = new sfWidgetFormInputText();
    $this->validatorSchema['num_volunteers'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema->setNameFormat('time_resource[%s]');
  }

  public function getModelName()
  {
    return 'TimeResource';
  }

}
