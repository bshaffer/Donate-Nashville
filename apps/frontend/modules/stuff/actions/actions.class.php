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
   * Displays the "need time" form
   */
  public function executeNeed(sfWebRequest $request)
  {
    $this->form = new NeedStuffResourceForm();
  }

  /**
   * Submit for the "need time" form
   */
  public function executeNeedCreate(sfWebRequest $request)
  {
    $this->form = new NeedStuffResourceForm();
    
    $this->processNeedForm($request, $this->form);
  
    $this->setTemplate('need');
  }

  
  public function executeHave(sfWebRequest $request)
  {
    
  }
  
  public function executeMatch(sfWebRequest $request)
  {
    $this->match = $this->getRoute()->getObject();
  }
  
  public function executeHaveCreate(sfWebRequest $request)
  {
    
    $this->setTemplate('have');

  }
}
