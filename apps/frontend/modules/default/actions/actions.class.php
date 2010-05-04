<?php

class defaultActions extends sfActions
{
  public function executeError404(sfWebRequest $request)
  {
    $this->getResponse()->setStatusCode(404, 'This page does not exist');
  }
  
  public function executeError403(sfWebRequest $request)
  {
    $this->getResponse()->setStatusCode(403);
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    
  }
}