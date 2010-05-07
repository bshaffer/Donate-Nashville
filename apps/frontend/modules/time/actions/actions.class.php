<?php

/**
 * time actions.
 *
 * @package    skeleton
 * @subpackage time
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class timeActions extends frontendActions
{

  /**
   * The main "have time" screen, a search screen
   */
  public function executeHave(sfWebRequest $request)
  {
    $this->breadcrumbs->add('Have', '@have')->add('Time');
  }

  /**
   * Displays the actual Time Resource
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->resource = $this->getRoute()->getObject();
    $this->type = $this->resource->getOppositeType();
    $this->form = new ContactResourceOwnerForm();
    if($request->isMethod('POST'))
    {
      $this->form->bind($request->getParameter('resource_contact_owner'));
      if($this->form->isValid())
      {
        $this->form['resource_id'] = $this->resource['id'];
        $this->form->save();
      }
    }
    
    $this->breadcrumbs->add('Time', '@have_time')->add($this->resource['title']);
  }

  /**
   * Displays the "need time" form
   */
  public function executeAddNeed(sfWebRequest $request)
  {
    $this->form = new NeedTimeResourceForm();
    
    $this->breadcrumbs->add('Need', '@need')->add('Add Time');
  }

  /**
   * Submit for the "need time" form
   */
  public function executeAddNeedCreate(sfWebRequest $request)
  {
    $this->form = new NeedTimeResourceForm();
    
    $this->processAddNeedForm($request, $this->form);
  
    $this->setTemplate('addNeed');

    $this->breadcrumbs->add('Need', '@need')->add('Add Time');
  }

  /**
   * Processes the "need time" form
   */
  protected function processAddNeedForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $time = $form->save();

      $request->setAttribute('resource', $time);
      $body = $this->getController()->getPresentationFor('time', 'needEmail');
      
      $message = $this->getMailer()->compose(
        sfConfig::get('app_email_from'),
        $form->getValue('email'),
        dnConfig::getEmailSubject('need_time_creation'),
        $body
      );
      $message->setContentType('text/html');
      $this->getMailer()->send($message);

      $this->getUser()->setOwner($time);
      
      $this->redirect($this->generateUrl('time_show', array(
        'sf_subject' => $time
      )));
    }
    
    $this->getUser()->setFlash('error', 'You are missing some of the required fields below.');
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
