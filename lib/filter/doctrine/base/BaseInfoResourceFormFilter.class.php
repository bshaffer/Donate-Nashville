<?php

/**
 * InfoResource filter form base class.
 *
 * @package    skeleton
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInfoResourceFormFilter extends ResourceFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['abstract'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['abstract'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['keywords'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['keywords'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['url'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['url'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema->setNameFormat('info_resource_filters[%s]');
  }

  public function getModelName()
  {
    return 'InfoResource';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'abstract' => 'Text',
      'keywords' => 'Text',
      'url' => 'Text',
    ));
  }
}
