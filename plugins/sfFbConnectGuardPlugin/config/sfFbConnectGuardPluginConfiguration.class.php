<?php

/**
 * sfFbConnectGuardPlugin configuration.
 * 
 * @package     sfFbConnectGuardPlugin
 * @subpackage  config
 * @author      Setfive Consulting<contact@setfive.com>
 * @version     SVN: $Id: PluginConfiguration.class.php 12675 2008-11-06 08:07:42Z Kris.Wallsmith $
 */
class sfFbConnectGuardPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('routing.load_configuration', 
      array('sfFbConnectPluginRouting', 'listenToRoutingLoadConfigurationEvent'));
  }
}
