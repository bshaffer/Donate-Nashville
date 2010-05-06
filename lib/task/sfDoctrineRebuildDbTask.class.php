<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) Jonathan H. Wage <jonwage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// require_once(dirname(__FILE__).'/sfDoctrineBaseTask.class.php');

/**
 * Generates code based on your schema.
 *
 * @package    sfDoctrinePlugin
 * @subpackage task
 * @author     Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version    SVN: $Id: sfDoctrineBuildTask.class.php 23156 2009-10-17 13:08:16Z Kris.Wallsmith $
 */
class sfDoctrineRebuildDbTask extends sfBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', true),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('from-env', null, sfCommandOption::PARAMETER_REQUIRED, 'Load another environment\'s database', null),
      new sfCommandOption('no-confirmation', null, sfCommandOption::PARAMETER_NONE, 'Whether to force dropping of the database'),
      new sfCommandOption('and-load', null, sfCommandOption::PARAMETER_OPTIONAL | sfCommandOption::IS_ARRAY, 'Load fixture data'),
    ));

    $this->namespace = 'doctrine';
    $this->name = 'rebuild-db';

    $this->briefDescription = 'Rebuild your database with specified fixtures';

    $this->detailedDescription = <<<EOF
      Rebuild your database with specified fixtures
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $task = new sfDoctrineDropDbTask($this->dispatcher, $this->formatter);
    $task->setCommandApplication($this->commandApplication);
    $task->setConfiguration($this->configuration);
    $ret = $task->run(array(), array('no-confirmation' => $options['no-confirmation']));

    if ($ret)
    {
      return $ret;
    }

    $task = new sfDoctrineBuildDbTask($this->dispatcher, $this->formatter);
    $task->setCommandApplication($this->commandApplication);
    $task->setConfiguration($this->configuration);
    $ret = $task->run();

    if ($ret)
    {
      return $ret;
    }

    $task = new sfDoctrineInsertSqlTask($this->dispatcher, $this->formatter);
    $task->setCommandApplication($this->commandApplication);
    $task->setConfiguration($this->configuration);
    $ret = $task->run();

    if ($ret)
    {
      return $ret;
    }

    if (count($options['and-load']))
    {
      $task = new sfDoctrineDataLoadTask($this->dispatcher, $this->formatter);
      $task->setCommandApplication($this->commandApplication);
      $task->setConfiguration($this->configuration);

      $ret = $task->run(array(
        'dir_or_file' => in_array(array(), $options['and-load'], true) ? null : $options['and-load'],
      ));

      if ($ret)
      {
        return $ret;
      }
    }
  }
}
