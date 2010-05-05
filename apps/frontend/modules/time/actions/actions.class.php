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
  
  public function executeHave(sfWebRequest $request)
  {
    $this->form = new HaveTimeResourceForm();
  }
}
