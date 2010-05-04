<?php
 
// in plugins/myPlugin/lib/myPluginRouting.php
class sfFbConnectPluginRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $routing = $event->getSubject();
    // add plug-in routing rules on top of the existing ones
    $routing->prependRoute('fb_connect_auth', 
      new sfRoute('/fb/auth', 
        array('module' => 'FbConnect', "action" => "index")));
  }
}
?>