<?php

/**
 * PluginsfGuardPermission form.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
abstract class PluginsfGuardPermissionForm extends BasesfGuardPermissionForm
{
  /**
   * @see sfForm
   */
  public function setupInheritance()
  {
    parent::setupInheritance();

    unset($this['created_at'], $this['updated_at']);

    $this->widgetSchema['groups_list']->setLabel('Groups');
    $this->widgetSchema['users_list']->setLabel('Users');
  }
}
