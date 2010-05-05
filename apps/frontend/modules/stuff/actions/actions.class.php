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
   * Main "need stuff" screen, which is a search
   */
  public function executeNeed(sfWebRequest $request)
  {
  }

  /**
   * Displays the actual resource
   */
  public function executeMatch(sfWebRequest $request)
  {
    $this->resource = $this->getRoute()->getObject();
  }
  
  /**
   * Displays the "need time" form
   */
  public function executeAddNeed(sfWebRequest $request)
  {
    $this->form = new NeedStuffResourceForm();
  }

  /**
   * Submit for the "need time" form
   */
  public function executeAddNeedCreate(sfWebRequest $request)
  {
    $this->form = new NeedStuffResourceForm();
    
    $this->processAddNeedForm($request, $this->form);
  
    $this->setTemplate('addNeed');
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
      
      $this->redirect('@add_need_stuff');
    }
  }
}
