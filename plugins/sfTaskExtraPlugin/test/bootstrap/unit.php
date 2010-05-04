<?php

if (!isset($_SERVER['SYMFONY']))
{
  throw new RuntimeException('Could not find symfony core libraries.');
}

require_once $_SERVER['SYMFONY'].'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

$configuration = new sfProjectConfiguration(dirname(__FILE__).'/../fixtures/project');
require_once $configuration->getSymfonyLibDir().'/vendor/lime/lime.php';

function sfTaskExtraPlugin_autoload_again($class)
{
  $autoload = sfSimpleAutoload::getInstance();
  $autoload->reload();
  return $autoload->autoload($class);
}
spl_autoload_register('sfTaskExtraPlugin_autoload_again');

require_once dirname(__FILE__).'/../../config/sfTaskExtraPluginConfiguration.class.php';
$plugin_configuration = new sfTaskExtraPluginConfiguration($configuration, dirname(__FILE__).'/../..');

/**
 * Tests symfony tasks.
 */
class task_extra_lime_test extends lime_test
{
  /**
   * Executes a task and tests its success.
   * 
   * @param   string  $taskClass
   * @param   array   $arguments
   * @param   array   $options
   * @param   boolean $boolean
   * 
   * @return  boolean
   */
  public function task_ok($taskClass, array $arguments = array(), array $options = array(), $boolean = true, $message = null)
  {
    $configuration = sfProjectConfiguration::getActive();

    if (is_null($message))
    {
      $message = sprintf('"%s" execution %s', $taskClass, $boolean ? 'succeeded' : 'failed');
    }

    chdir(dirname(__FILE__).'/../fixtures/project');

    $task = new $taskClass($configuration->getEventDispatcher(), new sfFormatter());
    try
    {
      $ok = $boolean === $task->run($arguments, $options) ? false : true;
    }
    catch (Exception $e)
    {
      $ok = $boolean === false;
      if (!$ok)
      {
        $message .= ' ('.$e->getMessage().')';
      }
    }

    return $this->ok($ok, $message);
  }
}

function task_extra_cleanup()
{
  sfToolkit::clearDirectory(dirname(__FILE__).'/../fixtures/project/cache');
  sfToolkit::clearDirectory(dirname(__FILE__).'/../fixtures/project/log');
  sfToolkit::clearDirectory(dirname(__FILE__).'/../fixtures/project/plugins');
  sfToolkit::clearDirectory(dirname(__FILE__).'/../fixtures/project/test/unit');
}
task_extra_cleanup();
register_shutdown_function('task_extra_cleanup');
