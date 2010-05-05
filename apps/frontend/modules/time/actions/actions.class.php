<?php

/**
 * time actions.
 *
 * @package    skeleton
 * @subpackage time
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class timeActions extends sfActions
{

  /**
   * Displays the "need time" form
   */
  public function executeAddNeed(sfWebRequest $request)
  {
    $this->form = new NeedTimeResourceForm();
  }

  /**
   * Submit for the "need time" form
   */
  public function executeAddNeedCreate(sfWebRequest $request)
  {
    $this->form = new NeedTimeResourceForm();
    
    $this->processAddNeedForm($request, $this->form);
  
    $this->setTemplate('addNeed');
  }

  /**
   * Processes the "need time" form
   */
  protected function processAddNeedForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $need = $form->save();

      $request->setAttribute('resource', $need);
      $body = $this->getController()->getPresentationFor('time', 'needEmail');
      
      $this->getMailer()->composeAndSend(
        sfConfig::get('app_email_from'),
        $form->getValue('email'),
        dnConfig::getEmailSubject('need_time_creation'),
        $body
      );
      
      $this->redirect('@add_need_time');
    }
  }
  
  /**
   * Internal action used by create the body for the email that goes out
   * to the creator of a "need time"
   */
  public function executeNeedEmail(sfWebRequest $request)
  {
    $this->resource = $request->getAttribute('resource');
    $this->setLayout('layoutEmail');
  }

  /**
   * The "have time" screen, where you search for time resources needed
   */
  public function executeHave(sfWebRequest $request)
  {

  }
}
