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

    $this->widgetSchema   ['resource_date'] = new sfWidgetFormDateTime();
    $this->validatorSchema['resource_date'] = new sfValidatorDateTime();

    $this->widgetSchema   ['start_time'] = new sfWidgetFormTime();
    $this->validatorSchema['start_time'] = new sfValidatorTime();

    $this->widgetSchema   ['end_time'] = new sfWidgetFormTime();
    $this->validatorSchema['end_time'] = new sfValidatorTime(array('required' => false));

    $this->widgetSchema   ['num_volunteers'] = new sfWidgetFormInputText();
    $this->validatorSchema['num_volunteers'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema->setNameFormat('time_resource[%s]');
  }

  public function getModelName()
  {
    return 'TimeResource';
  }

}
