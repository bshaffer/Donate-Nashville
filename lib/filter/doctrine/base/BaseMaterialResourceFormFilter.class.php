<?php

/**
 * MaterialResource filter form base class.
 *
 * @package    skeleton
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMaterialResourceFormFilter extends ResourceFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['quantity'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['quantity'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema->setNameFormat('material_resource_filters[%s]');
  }

  public function getModelName()
  {
    return 'MaterialResource';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'quantity' => 'Number',
    ));
  }
}
