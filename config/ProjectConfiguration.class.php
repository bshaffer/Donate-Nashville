<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    sfYaml::setSpecVersion('1.1');
    // for compatibility / remove and enable only the plugins you want
    $this->enablePlugins(array(
      'sfDoctrinePlugin',
      'sfDoctrineGuardPlugin',
      'csDoctrineActAsSortablePlugin',
      'sfFormExtraPlugin',
      'sfGoogleAnalyticsPlugin',
      'sfLucenePlugin',
      'sfTaskExtraPlugin',
      'sfPhpExcelPlugin'
      ));
  }
  
  /**
    * Configure the Doctrine engine
    */
  public function configureDoctrine(Doctrine_Manager $manager)
  {
    $manager->setAttribute(Doctrine_Core::ATTR_QUERY_CLASS, 'Doctrine_Query_Extra');
  }
}
