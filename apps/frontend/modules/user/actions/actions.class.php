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
    $hash = $request->getParameter('hash');
    $user = Doctrine_Core::getTable('sfGuardUser')->findOneByPassword($hash);
    
    if ($user)
    {
      $user->signIn();
      
      $user->redirect('@user_resource');
    }
  }
}
