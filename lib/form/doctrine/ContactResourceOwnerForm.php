<?php

/**
 * Resource form.
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContactResourceOwnerForm extends BaseContactForm
{
  public function configure()
  {
    $this->setWidget('resource_id', new sfWidgetFormInputHidden());
    $this->widgetSchema->setNameFormat('contact[%s]');
  }
}
