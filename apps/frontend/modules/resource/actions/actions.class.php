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

  public function executeStuffList(sfWebRequest $request)
  {  
    $query = Doctrine::getTable('StuffResource')
              ->getListQuery($request->getParameter('q'))
              ->limit(8);

    if ($type = $request->getParameter('type')) 
    {
      $query->whereWrap()->andWhere('transaction_type =?', $type);
    }

    $results = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
    
    return $this->renderPartial('stuff/list', array('results' => $results));
  }

  public function executeTimeList(sfWebRequest $request)
  {  
    $query = Doctrine::getTable('TimeResource')
              ->getListQuery($request->getParameter('start'), $request->getParameter('end'))
              ->limit(8);

    if ($type = $request->getParameter('type')) 
    {
      $query->whereWrap()->andWhere('transaction_type = ?', $type);
    }
    
    $results = $query->execute(array(), Doctrine::HYDRATE_ARRAY);

    return $this->renderPartial('time/list', array('results' => $results));
  }
  
  public function executeMoney(sfWebRequest $request)
  {
    sfBreadcrumbs::getInstance()->addItem('Money');
  }
  
  public function executePlace(sfWebRequest $request)
  {
    sfBreadcrumbs::getInstance()->addItem('Place');
  }
  public function executeHave(sfWebRequest $request)
  {
    sfBreadcrumbs::getInstance()->addItem('Have');
  }
  
  public function executeNeed(sfWebRequest $request)
  {
    sfBreadcrumbs::getInstance()->addItem('Need');
  }
  
  public function executeFulfill(sfWebRequest $request)
  {
    $resource = $this->getRoute()->getObject();
    $user = $this->getUser()->getGuardUser();

    $this->forward403Unless($user['id'] == $resource['owner_id']);
    
    $resource['is_fulfilled'] = true;
    $resource->save();
    
    $this->getUser()->setFlash('notice', sprintf('"%s" has been fulfilled', $resource));
    
    $referer = $request->getReferer();
    $this->redirect($referer ? $referer : '@homepage');    
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $resource = $this->getRoute()->getObject();
    $user = $this->getUser()->getGuardUser();
    
    $this->forward403Unless($user['id'] == $resource['owner_id']);

    $resource->delete();

    $this->getUser()->setFlash('notice', sprintf('"%s" has been removed', $resource));

    $referer = $request->getReferer();
    $this->redirect($referer ? $referer : '@homepage');
  }

  public function forward403Unless($bool)
  {
    if (!$bool) 
    {
      $this->getUser()->setFlash('error', 'You do not have the permission to edit this object');
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }
  }
}
