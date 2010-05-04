<?php

require_once dirname(__FILE__).'/sfTaskExtraGeneratorBaseTask.class.php';

/**
 * Generates a single unit test stub script
 * 
 * @package     sfTaskExtraPlugin
 * @subpackage  task
 * @author      Kris Wallsmith <kris.wallsmith@symfony-project.com>
 * @version     SVN: $Id: sfGenerateTestTask.class.php 24538 2009-11-30 06:25:42Z dwhittle $
 */
class sfGenerateTestTask extends sfTaskExtraGeneratorBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('class', sfCommandArgument::REQUIRED, 'The class to test'),
    ));

    $this->addOptions(array(
      new sfCommandOption('disable-defaults', null, sfCommandOption::PARAMETER_NONE, 'Disables detection of generator options'),
      new sfCommandOption('template', null, sfCommandOption::PARAMETER_REQUIRED, 'The unit test template to use'),
      new sfCommandOption('database', null, sfCommandOption::PARAMETER_NONE, 'Include database initialization'),
      new sfCommandOption('without-methods', null, sfCommandOption::PARAMETER_NONE, 'Omit class method stubs'),
      new sfCommandOption('force', null, sfCommandOption::PARAMETER_NONE, 'Overwrite any existing test file'),
      new sfCommandOption('editor-cmd', null, sfCommandOption::PARAMETER_REQUIRED, 'Open script with this command upon creation'),
    ));

    $this->namespace = 'generate';
    $this->name = 'test';

    $this->briefDescription = 'Generates a single unit test stub script';

    $this->detailedDescription = <<<EOF
The [generate:test|INFO] task generates an empty unit test script in your
[test/unit/|COMMENT] directory and reflects the organization of your [lib/|COMMENT] directory:

  [./symfony generate:test myClass|INFO]

To open the test script in your test editor once the task completes, use the
[--editor-cmd|COMMENT] option:

  [./symfony generate:test myClass --editor-cmd=mate|INFO]
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    if (!class_exists($arguments['class']))
    {
      throw new InvalidArgumentException(sprintf('The class "%s" could not be found.', $arguments['class']));
    }

    $r = new ReflectionClass($arguments['class']);
    if (0 !== strpos($r->getFilename(), sfConfig::get('sf_lib_dir')))
    {
      throw new InvalidArgumentException(sprintf('The class "%s" is not located in the project lib/ directory.', $r->getName()));
    }

    $path = str_replace(sfConfig::get('sf_lib_dir'), '', dirname($r->getFilename()));
    $test = sfConfig::get('sf_test_dir').'/unit'.$path.'/'.$r->getName().'Test.php';

    if (file_exists($test))
    {
      if ($options['force'])
      {
        $this->getFilesystem()->remove($test);
      }
      else
      {
        $this->logSection('task', sprintf('A test script for the class "%s" already exists.', $r->getName()));

        if (isset($options['editor-cmd']))
        {
          $this->getFilesystem()->execute($options['editor-cmd'].' '.$test);
        }

        return 1;
      }
    }

    $template = '';
    $database = false;

    if (!$options['disable-defaults'])
    {
      if ($r->isSubClassOf('sfForm'))
      {
        $options['without-methods'] = true;
        if (!$r->isAbstract())
        {
          $template = 'Form';
        }
      }

      if (
        // propel
        (class_exists('Propel') && ($r->isSubclassOf('BaseObject') || 'Peer' == substr($r->getName(), -4) || $r->isSubclassOf('sfFormPropel')))
        ||
        // doctrine
        (class_exists('Doctrine') && ($r->isSubclassOf('Doctrine_Record') || $r->isSubclassOf('Doctrine_Table') || $r->isSubclassOf('sfFormDoctrine')))
        ||
        // either
        $r->isSubclassOf('sfFormFilter')
      )
      {
        $database = true;
      }
    }

    $tests = '';
    if (!$options['without-methods'])
    {
      foreach ($r->getMethods() as $method)
      {
        if ($method->getDeclaringClass()->getName() == $r->getName() && $method->isPublic())
        {
          $type = $method->isStatic() ? '::' : '->';
          $tests .= <<<EOF
// $type{$method->getName()}()
\$t->diag('$type{$method->getName()}()');


EOF;
        }
      }
    }

    $this->getFilesystem()->copy(dirname(__FILE__).sprintf('/skeleton/test/UnitTest%s.php', $template), $test);
    $this->getFilesystem()->replaceTokens($test, '##', '##', array(
      'CLASS'    => $r->getName(),
      'TEST_DIR' => str_repeat('/..', substr_count($path, DIRECTORY_SEPARATOR) + 1),
      'TESTS'    => $tests,
      'DATABASE' => $database ? "\n\$databaseManager = new sfDatabaseManager(\$configuration);\n" : '',
    ));

    if (isset($options['editor-cmd']))
    {
      $this->getFilesystem()->execute($options['editor-cmd'].' '.$test);
    }
  }
}
