<?php

/**
 * resource actions.
 *
 * @package    skeleton
 * @subpackage resource
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class resourceActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }

  public function executeStuffResourceList(sfWebRequest $request)
  {  
    $query = Doctrine::getTable('ListResource')
              ->getListQuery($request->getParameter('q'));

  }

  public function executeTimeResourceList(sfWebRequest $request)
  {  
    $query = Doctrine::getTable('ListResource')
              ->getListQuery($request->getParameter('q'));

  }
  
  public function executeMoney(sfWebRequest $request)
  {
      
  }
  
  public function executeHousing(sfWebRequest $request)
  {

  }
  public function executeHave(sfWebRequest $request)
  {
      
  }
  
  public function executeNeed(sfWebRequest $request)
  {

  }
}
