<?php

class defaultActions extends frontendActions
{
  public function executeError404(sfWebRequest $request)
  {
    $this->getResponse()->setStatusCode(404, 'This page does not exist');
  }
  
  public function executeSecure(sfWebRequest $request)
  {
    $this->getResponse()->setStatusCode(403);
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  
  public function executeAbout(sfWebRequest $request)
  {
    $this->breadcrumbs->add('About');
  }
  
  public function executeNewContactMessage(sfWebRequest $request)
  {
    $this->form = new ContactForm();
    
    if($request->isMethod('POST'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->contact = $request->getParameter($this->form->getName());
        
        // send email to owner of resource
        $this->sendContactEmail($this->contact);
        
        // say thanks to the user
        $this->setTemplate('newContactMessageSent');
      }
    }
    
    $this->breadcrumbs->add('Contact');
  }
  
  /**
   * send an email to the resource owner letting them know that a match was
   * submitted, along with the contact info
   */
  protected function sendContactEmail($contact)
  {
    // send email based on $resource->transaction_type
    $body = var_export($contact, true);
    
    $message = $this->getMailer()->compose(
      sfConfig::get('app_email_from'),
      sfConfig::get('app_email_from'),
      dnConfig::getEmailSubject('contact'),
      $body
    );
    
    $message->setContentType('text/html');
    $this->getMailer()->send($message);
    
  }
  
  public function executeTermsOfService(sfWebRequest $request)
  {
    $this->breadcrumbs->add('Terms of Service');
  }
}
