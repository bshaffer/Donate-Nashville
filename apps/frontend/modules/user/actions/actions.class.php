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

  /**
   * Builds the body for the send token email
   */
  public function executeSendLoginTokenEmail(sfWebRequest $request)
  {
    $this->user = $request->getAttribute('user');
    $this->setLayout('layoutEmail');
  }

}
