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
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }
  
  public function executeNeed(sfWebRequest $request)
  {
    $this->form = new NeedTimeResourceForm();
  }
  
  public function executeNeedCreate(sfWebRequest $request)
  {
    $this->form = new NeedTimeResourceForm();
    
    $this->processNeedForm($request, $this->form);
  
    $this->setTemplate('need');
  }
  
  protected function processNeedForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $need = $form->save();
      
      $this->redirect('@need_time');
    }
  }
  
  public function executeHave(sfWebRequest $request)
  {
    $this->form = new HaveTimeResourceForm();
  }
}
