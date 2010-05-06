<?php

/**
 * Contact form.
 *
 * @package    skeleton
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContactForm extends BaseContactForm
{
  public function configure()
  {
    unset($this->widgetSchema['resource_id']);
    unset($this->validatorSchema['resource_id']);
    $this->widgetSchema->setLabel('notes', 'Question');
  }
}
