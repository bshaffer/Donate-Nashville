<?php

/**
 * Plugin plugin base task.
 * 
 * @package     sfTaskExtraPlugin
 * @subpackage  task
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: sfTaskExtraPluginBaseTask.class.php 12756 2008-11-08 10:24:46Z Kris.Wallsmith $
 */
abstract class sfTaskExtraPluginBaseTask extends sfPluginBaseTask
{
  /**
   * @see sfTaskExtraBaseTask
   */
  public function checkPluginExists($plugin, $boolean = true)
  {
    return sfTaskExtraBaseTask::checkPluginExists($plugin, $boolean);
  }
}
