<?php

/**
 * MaterialResource form base class.
 *
 * @method MaterialResource getObject() Returns the current form's model object
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMaterialResourceForm extends ResourceForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['quantity'] = new sfWidgetFormInputText();
    $this->validatorSchema['quantity'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema->setNameFormat('material_resource[%s]');
  }

  public function getModelName()
  {
    return 'MaterialResource';
  }

}
