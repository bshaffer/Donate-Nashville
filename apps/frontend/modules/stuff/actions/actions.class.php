<?php

/**
 * stuff actions.
 *
 * @package    skeleton
 * @subpackage stuff
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stuffActions extends sfActions
{

  /**
   * Main "need stuff" screen, which is a search
   */
  public function executeNeed(sfWebRequest $request)
  {
  }

  /**
   * Displays the actual resource
   */
  public function executeMatch(sfWebRequest $request)
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
   * Displays the "need stuff" form
   */
  public function executeAddNeed(sfWebRequest $request)
  {
    $this->form = new NeedStuffResourceForm();
  }

  /**
   * Submit for the "need stuff" form
   */
  public function executeAddNeedCreate(sfWebRequest $request)
  {
    $this->form = new NeedStuffResourceForm();
    
    $this->processAddNeedForm($request, $this->form);
  
    $this->setTemplate('addNeed');
  }
  
  /**
   * Processes the "need stuff" form
   */
  protected function processAddNeedForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $stuff = $form->save();
      
      $request->setAttribute('resource', $stuff);
      $body = $this->getController()->getPresentationFor('stuff', 'needEmail');
      
      $message = $this->getMailer()->compose(
        sfConfig::get('app_email_from'),
        $form->getValue('email'),
        dnConfig::getEmailSubject('need_stuff_creation'),
        $body
      );
      $message->setContentType('text/html');
      $this->getMailer()->send($message);
      
      $this->redirect($this->generateUrl('stuff_match', array(
        'sf_subject' => $stuff
      )));
    }
  }
  
  /**
   * Internal action used to create the body for the email that goes out
   * to the creator of a "need stuff"
   */
  public function executeNeedEmail(sfWebRequest $request)
  {
    $this->resource = $request->getAttribute('resource');
    $this->setLayout('layoutEmail');
  }
  
  /**
   * Displays the "have stuff" form
   */
  public function executeAddHave(sfWebRequest $request)
  {
    $this->form = new HaveStuffResourceForm();
  }

  /**
   * Submit for the "have stuff" form
   */
  public function executeAddHaveCreate(sfWebRequest $request)
  {
    $this->form = new HaveStuffResourceForm();
    
    $this->processAddHaveForm($request, $this->form);
  
    $this->setTemplate('addHave');
  }
  
  /**
   * Processes the "have stuff" form
   */
  protected function processAddHaveForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $stuff = $form->save();
      
      $request->setAttribute('resource', $stuff);
      $body = $this->getController()->getPresentationFor('stuff', 'haveEmail');
      
      $message = $this->getMailer()->compose(
        sfConfig::get('app_email_from'),
        $form->getValue('email'),
        dnConfig::getEmailSubject('have_stuff_creation'),
        $body
      );
      $message->setContentType('text/html');
      $this->getMailer()->send($message);
      
      $this->redirect($this->generateUrl('stuff_match', array(
        'sf_subject' => $stuff
      )));
    }
  }
  
  /**
   * Internal action used to create the body for the email that goes out
   * to the creator of a "have stuff"
   */
  public function executeHaveEmail(sfWebRequest $request)
  {
    $this->resource = $request->getAttribute('resource');
    $this->setLayout('layoutEmail');
  }
  
  public function executeHave(sfWebRequest $request)
  {
  }

  public function executeHaveCreate(sfWebRequest $request)
  {
    $this->setTemplate('have');
  }
}
