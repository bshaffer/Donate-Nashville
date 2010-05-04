<?php
 
// in plugins/myPlugin/lib/myPluginRouting.php
class sfFbConnectPluginRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    die("hi");
    $routing = $event->getSubject();
    // add plug-in routing rules on top of the existing ones
    $routing->prependRoute('fb_connect_auth', 
      new sfRoute('/fb/:action', 
        array('module' => 'FbConnect')));
  }
}
?>