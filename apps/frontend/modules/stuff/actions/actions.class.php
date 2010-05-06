<?php

/**
 * stuff actions.
 *
 * @package    skeleton
 * @subpackage stuff
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stuffActions extends frontendActions
{
  /**
   * Main "need stuff" screen, which is a search
   */
  public function executeNeed(sfWebRequest $request)
  {
    $this->breadcrumbs->add('Need', '@need')->add('Stuff');
  }

  /**
   * Displays the actual resource
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
        $contact_info = $this->form->save();
      }
    }
    
    $this->breadcrumbs->add('Stuff', '@need_stuff')->add($this->resource['title']);
  }
  
  /**
   * Displays the "need stuff" form
   */
  public function executeAddNeed(sfWebRequest $request)
  {
    $this->form = new NeedStuffResourceForm();
    
    $this->breadcrumbs->add('Need', '@need')->add('Stuff', '@need_stuff')->add('Add');
  }

  /**
   * Submit for the "need stuff" form
   */
  public function executeAddNeedCreate(sfWebRequest $request)
  {
    $this->form = new NeedStuffResourceForm();
    
    $this->processAddNeedForm($request, $this->form);
  
    $this->setTemplate('addNeed');
    
    $this->breadcrumbs->add('Need', '@need')->add('Stuff', '@need_stuff')->add('Add');
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
      
      $this->getUser()->setOwner($stuff);
      
      $this->redirect($this->generateUrl('stuff_show', array(
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

    $this->breadcrumbs->add('Have', '@have')->add('Stuff', '@have_stuff')->add('Add');
  }

  /**
   * Submit for the "have stuff" form
   */
  public function executeAddHaveCreate(sfWebRequest $request)
  {
    $this->form = new HaveStuffResourceForm();
    
    $this->processAddHaveForm($request, $this->form);
  
    $this->setTemplate('addHave');
    
    $this->breadcrumbs->add('Have', '@have')->add('Stuff', '@have_stuff')->add('Add');
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
      
      $this->getUser()->setOwner($stuff);
      
      $this->redirect($this->generateUrl('stuff_show', array(
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
    $this->breadcrumbs->add('Have', '@have')->add('Stuff');
  }
  
  /**
   * function to take in a contact form submission from a contact form on 
   * the show page and send the resource's owner an email about it
   */
  public function executeNewMessage(sfWebRequest $request)
  {
    $this->resource = Doctrine_Core::getTable('stuffResource')->find($request->getParameter('id'));
    
    $this->form = new ContactResourceOwnerForm();
    
    $this->form->bind($request->getParameter($this->form->getName()));
    
    if ($this->form->isValid())
    {
      $this->form->save();
      $this->contact = $request->getParameter($this->form->getName());
      
      // send email to owner of resource
      $this->sendMatchFoundEmail($this->resource, $this->contact);
      
      // say thanks to the user
      $this->setTemplate('newMessageSent');
    }
  }
  
  /**
   * send an email to the resource owner letting them know that a match was
   * submitted, along with the contact info
   */
  protected function sendMatchFoundEmail($resource, $contact)
  {
    // send email based on $resource->transaction_type
    $body = var_export($contact, true);
    
    $message = $this->getMailer()->compose(
      sfConfig::get('app_email_from'),
      $resource->User->username,
      dnConfig::getEmailSubject('match_found'),
      $body
    );
    
    $message->setContentType('text/html');
    $this->getMailer()->send($message);
    
  }
}
