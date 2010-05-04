<?php

/**
 * Plugin generator base task.
 * 
 * @package     sfTaskExtraPlugin
 * @subpackage  task
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: sfTaskExtraGeneratorBaseTask.class.php 12756 2008-11-08 10:24:46Z Kris.Wallsmith $
 */
abstract class sfTaskExtraGeneratorBaseTask extends sfGeneratorBaseTask
{
  /**
   * @see sfTaskExtraBaseTask
   */
  public function checkPluginExists($plugin, $boolean = true)
  {
    return sfTaskExtraBaseTask::checkPluginExists($plugin, $boolean);
  }
}
