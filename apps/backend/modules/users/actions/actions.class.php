<?php

/**
 * users actions.
 *
 * @package    skeleton
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->users = Doctrine::getTable('sfGuardUser')->createQuery()->orderBy('email_address ASC')->execute();
    $this->groups = Doctrine::getTable('sfGuardGroup')->createQuery()->orderBy('name ASC')->execute();
    $this->permissions = Doctrine::getTable('sfGuardPermission')->createQuery()->orderBy('name ASC')->execute();
  }
}
