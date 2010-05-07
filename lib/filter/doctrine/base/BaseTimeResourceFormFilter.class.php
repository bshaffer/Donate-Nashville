<?php

/**
 * TimeResource filter form base class.
 *
 * @package    skeleton
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTimeResourceFormFilter extends ResourceFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['resource_date'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false));
    $this->validatorSchema['resource_date'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59'))));

    $this->widgetSchema   ['start_time'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['start_time'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['end_time'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['end_time'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['num_volunteers'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['num_volunteers'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema->setNameFormat('time_resource_filters[%s]');
  }

  public function getModelName()
  {
    return 'TimeResource';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'resource_date' => 'Date',
      'start_time' => 'Text',
      'end_time' => 'Text',
      'num_volunteers' => 'Number',
    ));
  }
}
