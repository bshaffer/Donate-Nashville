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

  }

  public function executeStuffResourceList(sfWebRequest $request)
  {  
    $results = Doctrine::getTable('StuffResource')
              ->getListQuery($request->getParameter('q'))
              ->limit(8)
              ->execute(Doctrine::HYDRATE_ARRAY);
    
    return $this->renderPartial('resource/list', array('results' => $results));
  }

  public function executeTimeResourceList(sfWebRequest $request)
  {  
    $results = Doctrine::getTable('TimeResource')
              ->getListQuery($request->getParameter('q'))
              ->limit(8)
              ->execute(Doctrine::HYDRATE_ARRAY);
    
    return $this->renderPartial('resource/list', array('results' => $results));
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
