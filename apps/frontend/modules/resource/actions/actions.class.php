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

  public function executeTimeResourceList(sfWebRequest $request)
  {  
    $query = Doctrine::getTable('TimeResource')->createQuery('p')
                ->select('p.title, LEFT(p.description, 200) as summary')
                ->addWhere('title like ?', "%$q%")
                ->orWhere('description like ?', "%$q%")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->limit(8)
                ->groupBy('p.id');

  }
  
  public function executeMoney(sfWebRequest $request)
  {
      
  }
  
  public function executeHousing(sfWebRequest $request)
  {

  }
}
