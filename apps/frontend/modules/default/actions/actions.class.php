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
    $updated = strtotime('May 8, 2010 8:50 am');
    $cookie = $request->getCookie('donateNashville');

    if(!$cookie || $cookie != $updated){
      $this->getResponse()->setCookie("donateNashville", $updated, time()+150000000);
      $this->showPopUp = true;
    }
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
        $this->sendContactEmail($this->contact, $this->form->getFormSummary());
        
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
  protected function sendContactEmail($contact, $body)
  {
    // send email based on $resource->transaction_type
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
  
  public function executeFloodResources(sfWebRequest $request)
  {
    $this->breadcrumbs->add('Flood Resources');
  }
  
}
