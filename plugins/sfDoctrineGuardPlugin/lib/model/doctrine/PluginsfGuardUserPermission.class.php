<?php

/**
 * User permission reference model.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage model
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
abstract class PluginsfGuardUserPermission extends BasesfGuardUserPermission
{
  public function postSave($event)
  {
    parent::postSave($event);
    $this->getUser()->reloadGroupsAndPermissions();
  }
}
