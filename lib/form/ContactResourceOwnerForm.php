<?php

/**
 * Resource form.
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContactResourceOwnerForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'email' => new sfWidgetFormInputText(),
      'name' => new sfWidgetFormInputText(),
      'phone' => new sfWidgetFormInputText(),
      'notes' => new sfWidgetFormTextarea(),
    ));
    
    $this->setValidators(array(
      'email' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
      'name' => new sfValidatorString(array('max_length' => 255)),
      'phone' => new sfValidatorString(array('max_length' => 100)),
      'notes' => new sfValidatorString(),
    ));
    
    $this->widgetSchema->setNameFormat('contact[%s]');
  }

  public function save()
  {
    /* logic to fulfill need / claim resource */

  }

}
