<?php

/**
 * InfoResource form base class.
 *
 * @method InfoResource getObject() Returns the current form's model object
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInfoResourceForm extends ResourceForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['abstract'] = new sfWidgetFormTextarea();
    $this->validatorSchema['abstract'] = new sfValidatorString(array('required' => false));

    $this->widgetSchema   ['keywords'] = new sfWidgetFormInputText();
    $this->validatorSchema['keywords'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

    $this->widgetSchema   ['url'] = new sfWidgetFormInputText();
    $this->validatorSchema['url'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

    $this->widgetSchema->setNameFormat('info_resource[%s]');
  }

  public function getModelName()
  {
    return 'InfoResource';
  }

}
