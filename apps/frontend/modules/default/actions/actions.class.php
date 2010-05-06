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
  
  public function executeTermsOfService(sfWebRequest $request)
  {
    $this->breadcrumbs->add('Terms of Service');
  }
}