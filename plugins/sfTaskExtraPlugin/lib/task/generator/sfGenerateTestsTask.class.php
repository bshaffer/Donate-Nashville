<?php

require_once dirname(__FILE__).'/sfTaskExtraGeneratorBaseTask.class.php';

/**
 * Generates unit test stub scripts.
 * 
 * @package     sfTaskExtraPlugin
 * @subpackage  task
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: sfGenerateTestsTask.class.php 15353 2009-02-08 21:12:33Z Kris.Wallsmith $
 */
class sfGenerateTestsTask extends sfTaskExtraGeneratorBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('dir', null, sfCommandOption::PARAMETER_REQUIRED | sfCommandOption::IS_ARRAY, 'The subdirectory to search for classes in'),
      new sfCommandOption('exclude', null, sfCommandOption::PARAMETER_REQUIRED | sfCommandOption::IS_ARRAY, 'Directory to exclude'),
    ));

    $this->namespace = 'generate';
    $this->name = 'tests';

    $this->briefDescription = 'Generates unit test stub scripts';

    $this->detailedDescription = <<<EOF
The [generate:tests|INFO] task generates empty unit tests scripts in your
[test/unit/|COMMENT] directory and reflects the organization of your [lib/|COMMENT] directory:

  [./symfony generate:tests|INFO]

As the task recurs through your [lib/|COMMENT] directory, you can specify subdirectories
to limit the scope of the task with the [--dir|COMMENT] option:

  [./symfony generate:tests --dir=form|INFO]

You can also specify directories to exclude with the [--exclude|COMMENT] option:

  [./symfony generate:tests --exclude=filter|INFO]

The directories symfony, om, map and base are excluded by default.
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $prune = array_merge(array('symfony', 'om', 'map', 'base'), $options['exclude']);
    $dirs  = count($options['dir']) ? $options['dir'] : array('');

    $count = 0;

    $finder = sfFinder::type('file')->relative()->name('*.php')->prune($prune);
    foreach ($dirs as $dir)
    {
      foreach ($finder->in(sfConfig::get('sf_lib_dir').'/'.$dir) as $file)
      {
        if (
          preg_match('/^\w+/', basename($file), $match)
          &&
          class_exists($match[0])
        )
        {
          $generateTest = new sfGenerateTestTask($this->dispatcher, $this->formatter);
          $generateTest->setCommandApplication($this->commandApplication);
          $ret = $generateTest->run(array($match[0]));

          if (!$ret)
          {
            $count++;
          }
        }
      }
    }

    $this->logSection('task', sprintf('Generated %s test stub(s)', number_format($count)));
  }
}
