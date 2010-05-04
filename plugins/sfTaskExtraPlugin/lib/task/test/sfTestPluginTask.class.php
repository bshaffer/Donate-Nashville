<?php

require_once dirname(__FILE__).'/sfTaskExtraTestBaseTask.class.php';

/**
 * Launches a plugin test suite.
 * 
 * @package     sfTaskExtraPlugin
 * @subpackage  task
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: sfTestPluginTask.class.php 15353 2009-02-08 21:12:33Z Kris.Wallsmith $
 */
class sfTestPluginTask extends sfTaskExtraTestBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('plugin', sfCommandArgument::REQUIRED, 'The plugin name'),
    ));

    $this->addOptions(array(
      new sfCommandOption('only', null, sfCommandOption::PARAMETER_REQUIRED, 'Only run "unit" or "functional" tests'),
    ));

    $this->namespace = 'test';
    $this->name = 'plugin';

    $this->briefDescription = 'Launches a plugin test suite';

    $this->detailedDescription = <<<EOF
The [test:plugin|INFO] task launches a plugin's test suite:

  [./symfony test:plugin sfExamplePlugin|INFO]

You can specify only unit or functional tests with the [--only|COMMENT] option:

  [./symfony test:plugin sfExamplePlugin --only=unit|INFO]
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->checkPluginExists($arguments['plugin']);

    if ($options['only'] && !in_array($options['only'], array('unit', 'functional')))
    {
      throw new sfCommandException(sprintf('The --only option must be either "unit" or "functional" ("%s" given)', $options['only']));
    }

    require_once sfConfig::get('sf_symfony_lib_dir').'/vendor/lime/lime.php';

    $h = new lime_harness(new lime_output_color());
    $h->base_dir = sfConfig::get('sf_plugins_dir').'/'.$arguments['plugin'].'/test/'.$options['only'];

    $finder = sfFinder::type('file')->follow_link()->name('*Test.php');
    $h->register($finder->in($h->base_dir));

    $h->run();
  }
}
