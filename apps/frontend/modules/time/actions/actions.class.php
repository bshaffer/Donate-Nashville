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
   * The main "have time" screen, a search screen
   */
  public function executeHave(sfWebRequest $request)
  {
  }

  /**
   * Displays the actual Time Resource
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->resource = $this->getRoute()->getObject();
    $this->type = $this->resource['transaction_type'] == 'need' ? 'have' : 'need';
    $this->form = new ContactResourceOwnerForm();
    if($request->isMethod('POST'))
    {
      $this->form->bind($request->getParameter('resource_contact_owner'));
      if($this->form->isValid())
      {
        $contact_info = $this->form->save();
      }
    }
  }

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
      
      $message = $this->getMailer()->compose(
        sfConfig::get('app_email_from'),
        $form->getValue('email'),
        dnConfig::getEmailSubject('need_time_creation'),
        $body
      );
      $message->setContentType('text/html');
      $this->getMailer()->send($message);

      
      $this->redirect($this->generateUrl('time_show', array(
        'sf_subject' => $need
      )));
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
}
