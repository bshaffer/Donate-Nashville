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
   * Displays the "need time" form
   */
  public function executeAddNeed(sfWebRequest $request)
  {
    $this->form = new NeedTimeResourceForm();
  }

  /**
   * Submit for the "need time" form
   */
  public function executeAddNeedCreate(sfWebRequest $request)
  {
    $this->form = new NeedTimeResourceForm();
    
    $this->processAddNeedForm($request, $this->form);
  
    $this->setTemplate('addNeed');
  }

  /**
   * Processes the "need time" form
   */
  protected function processAddNeedForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $need = $form->save();
      
      $this->redirect('@add_need_time');
    }
  }
  
  /**
   * The "have time" screen, where you search for time resources needed
   */
  public function executeHave(sfWebRequest $request)
  {

  }
}
