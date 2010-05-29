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
    
    if ($resource = $this->getOption('resource')) 
    {
      // Doesn't currently work - limitation of concrete inheritance

      // $this->setDefault('resource_id', $resource['id']);
    }
    
    $this->widgetSchema->setNameFormat('contact[%s]');
  }
}
