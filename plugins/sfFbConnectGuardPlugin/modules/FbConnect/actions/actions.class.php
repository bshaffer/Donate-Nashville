<?php

require_once dirname(__FILE__).'/../lib/BaseFbConnectActions.class.php';
require_once dirname(__FILE__).'/../../../lib/Facebook.class.php';

/**
 * FbConnect actions.
 * 
 * @package    sfFbConnectGuardPlugin
 * @subpackage FbConnect
 * @author     Setfive Consulting<contact@setfive.com>
 * @version    SVN: $Id: actions.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
class FbConnectActions extends BaseFbConnectActions
{
  
  // Reciever for FBConnect auth URLs
  public function executeIndex(sfWebRequest $request)
  {
    if( is_null(sfConfig::get('app_facebook_api_key', null)) ||
        is_null(sfConfig::get('app_facebook_secret', null)) ){
      throw new sfException("You MUST set both facebook_api_key 
                              and facebook_secret for sfFbConnectGuardPlugin to work!", 1);
    }
    
    $fb = new Facebook(sfConfig::get('app_facebook_api_key'),
                          sfConfig::get('app_facebook_secret'));
    
    // we didn't get a user back from Facebook sooo send them away
    if( is_null($fb->user) ){
      $this->redirect( $this->generateUrl(
                          sfConfig::get("app_sf_fb_connect_guard_login_failed", "homepage")) );
    }
    
    // try and get the user back
    $user = Doctrine::getTable('sfFbConnectGuardUser')->getSfGuardUserByFbId( $fb->user );

    // we've all ready connected with this user so send them on their way
    if( !is_null($user) && $user->getIsActive() ){
      $this->getUser()->signin( $user, true );
      
      // Taken directly from sfGuardAuthActions
      // always redirect to a URL set in app.yml
      // or to the referer
      // or to the homepage
      $signinUrl = sfConfig::get ( 'app_sf_guard_plugin_success_signin_url', 
                                      $this->getUser()->getReferer ( '@homepage' ) );
      return $this->redirect ( $signinUrl );
    }
    // User is inactive, but we have them linked to an account, forward them to the login failed page
    else if(!is_null($user))
    {
	    // Set the users flash with their username (usually email) so they know what account is not confirmed yet
	    $this->getUser()->setFlash('username',$user->getUsername());
            $this->redirect( $this->generateUrl(
                          sfConfig::get("app_sf_fb_connect_guard_login_failed", "homepage")) );
    }

    // check if the user is actually logged in via sfGuardAuth
    // this lets someone link their Facebook account in after the fact
    if( $this->getUser()->isAuthenticated() ){
      $sfUser = $this->getUser()->getProfile();
      Doctrine::getTable('sfFbConnectGuardUser')->linkSfFbUser( $fb->user, $sfUser->getUserId() );
      
      // send them back where they came from
      return $this->redirect ( $this->getUser()->getReferer ( '@homepage' ) );
    }
    
    
    // otherwise lets connect them for the first time
    // and make them some sfGuardUser biz
    
    $profileFields = sfConfig::get("app_sf_fb_connect_guard_profile_fields",
                                    array('uid', 'first_name', 'last_name', 
                                          'education_history', 'pic_big', 
                                          'work_history', 'current_location',
                                          'affiliations', 'profile_url'));
    $user_info = $fb->api_client->users_getInfo($fb->user, $profileFields);
    $user_info = array_shift($user_info);
    
    $userId = Doctrine::getTable('sfFbConnectGuardUser')->createFbUser( $fb->user );
    
    // link em up
    Doctrine::getTable('sfFbConnectGuardUser')->linkSfFbUser( $fb->user, $userId );
    
    if( sfConfig::get("app_sf_fb_connect_guard_auto_login", true) ){
      // log them in
      $user = Doctrine::getTable('sfFbConnectGuardUser')->getSfGuardUserByFbId( $fb->user );
      if( !is_null($user) ){
        $this->getUser()->signin( $user, true );
      }
    }
    
    // send em on their way
    $this->redirect( $this->generateUrl(
                          sfConfig::get("app_sf_fb_connect_guard_connect_successful", "homepage")) );
    
  }
  
}
