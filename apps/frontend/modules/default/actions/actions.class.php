<?php

class defaultActions extends sfActions
{
  public function executeError404(sfWebRequest $request)
  {
    exit("!!!!!");
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
      
  }
  
  public function executeTermsOfService(sfWebRequest $request)
  {
      
  }
}