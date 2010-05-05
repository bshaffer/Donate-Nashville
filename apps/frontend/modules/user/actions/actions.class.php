<?php

/**
 * user actions.
 *
 * @package    skeleton
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{

  /**
   * Handles authentication for the user based on a secret key
   */
  public function executeAuthenticate(sfWebRequest $request)
  {
    $token = $request->getParameter('token');
    $user = Doctrine_Core::getTable('sfGuardUser')->findOneByPassword($token);
    
    if ($user)
    {
      $this->getUser()->signIn($user, true);
      
      $this->redirect('@user_resource');
    }
    
    $this->getResponse()->setStatusCode(401);
  }
  
  public function executeResource(sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    
    $this->haveTimeResources = $user->getTimeResourcesByTransactionType('have');
    $this->needTimeResources = $user->getTimeResourcesByTransactionType('need');
    $this->haveStuffResources = $user->getStuffResourcesByTransactionType('have');
    $this->needStuffResources = $user->getStuffResourcesByTransactionType('need');
  }
}
