<?php

/**
 * user actions.
 *
 * @package    skeleton
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends frontendActions
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
  
  /**
   * Functions as the "signin" action - but is actually just a box where
   * you fill in your email address and we send you the login token
   */
  public function executeSendLoginToken(sfWebRequest $request)
  {
    $this->form = new sendLoginTokenForm();
    $this->breadcrumbs->add('Manage your stuff');
  }

  /**
   * Handles the form submit. Is submitted via ajax, doesn't degrade,
   * tough, we're in a hurry
   */
  public function executeSendLoginTokenProcess(sfWebRequest $request)
  {
    $this->form = new sendLoginTokenForm();

    $this->form->bind($request->getParameter('send_login'));
    if ($this->form->isValid())
    {
      $user = $this->form->getUser();
      $request->setAttribute('user', $user);
      $body = $this->getController()->getPresentationFor('user', 'sendLoginTokenEmail');
      
      $message = $this->getMailer()->compose(
        sfConfig::get('app_email_from'),
        $this->form->getValue('email'),
        dnConfig::getEmailSubject('send_token_email'),
        $body
      );
      $message->setContentType('text/html');
      $this->getMailer()->send($message);

      // render the confirmation partial
      $this->email = $this->form->getValue('email');
      $this->renderPartial('user/sendTokenConfirmation');
    }
    else
    {
      $this->renderPartial('sendLoginTokenForm');
    }
    
    return sfView::NONE;
  }

  public function executePasswordLogin($request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      return $this->redirect('@homepage');
    }

    $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin'); 
    $this->form = new $class();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues(); 
        $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

        // always redirect to a URL set in app.yml
        // or to the referer
        // or to the homepage
        $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));

        return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
      }
    }
    else
    {
      if ($request->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }

      // if we have been forwarded, then the referer is the current URL
      // if not, this is the referer of the current request
      $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      $this->getResponse()->setStatusCode(401);
    }
  }

  /**
   * Builds the body for the send token email
   */
  public function executeSendLoginTokenEmail(sfWebRequest $request)
  {
    $this->user = $request->getAttribute('user');
    $this->setLayout('layoutEmail');
  }

}
