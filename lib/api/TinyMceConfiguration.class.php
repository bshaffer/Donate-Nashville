<?php 

/**
* Configuration class for TinyMCE
*/
class TinyMceConfiguration
{
  public static function get($config_overrides = array())
  {
    $config_array = array();
    
    //Pull default configuration, merge with custom configs
    $configs = array_merge(sfConfig::get('app_TinyMce_config'), $config_overrides);
    foreach ($configs as $key => $value) 
    {
      $config_array[] = "$key: '$value'";
    }
    //Convert to string with no trailing comma
    $tiny_mce_config = implode(",\n", $config_array);
    
    //Add dynamic params
    $tiny_mce_config = strtr($tiny_mce_config, array(
              '%web_root%' => sfContext::getInstance()->getRequest()->getRelativeUrlRoot()
              ));

    return $tiny_mce_config;
  }
}
