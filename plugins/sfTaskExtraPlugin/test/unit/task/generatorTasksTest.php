<?php

include dirname(__FILE__).'/../../bootstrap/unit.php';

$t = new task_extra_lime_test(37, new lime_output_color());

$t->diag('sfGeneratePluginTask');
$t->task_ok('sfGeneratePluginTask', array('sfTest*Plugin'), array(), false, '"sfGeneratePluginTask" fails when plugin name includes bad characters');
$t->task_ok('sfGeneratePluginTask', array('sfTest'), array(), false, '"sfGeneratePluginTask" fails when plugin name ends other than "Plugin"');
$t->task_ok('sfGeneratePluginTask', array('sfTestPlugin'));
$t->task_ok('sfGeneratePluginTask', array('sfTestPlugin'), array(), false, '"sfGeneratePluginTask" fails when plugin already exists');

mkdir(sfConfig::get('sf_plugins_dir').'/anotherPlugin');
$t->task_ok('sfGeneratePluginTask', array('anotherPlugin'), array(), true, '"sfGeneratePluginTask" runs on an empty plugin directory');

$plugin_dir   = sfConfig::get('sf_plugins_dir').'/sfTestPlugin';
$config_file  = $plugin_dir.'/config/sfTestPluginConfiguration.class.php';
$test_project = $plugin_dir.'/test/fixtures/project';
$test_app     = $test_project.'/apps/frontend';

$t->ok(is_dir($plugin_dir), '"sfGeneratePluginTask" creates the plugin directory');
$t->ok(file_exists($config_file), '"sfGeneratePluginTask" creates a plugin configuration file');
$t->like(@file_get_contents($config_file), '/class sfTestPluginConfiguration extends sfPluginConfiguration/', '"sfGeneratePluginTask" creates the plugin configuration class');
$t->like(@file_get_contents($plugin_dir.'/test/bootstrap/unit.php'), '/new sfTestPluginConfiguration/', '"sfGeneratePluginTask" includes the plugin config in the unit test bootstrapper');
$t->ok(file_exists($test_project.'/config/ProjectConfiguration.class.php'), '"sfGeneratePluginTask" creates a test project');
$t->like(@file_get_contents($test_project.'/config/ProjectConfiguration.class.php'), '/sfTestPlugin/', '"sfGeneratePluginTask" includes a customized ProjectConfiguration');
$t->ok(file_exists($test_app.'/config/frontendConfiguration.class.php'), '"sfGeneratePluginTask" creates a test app');

$t->task_ok('sfGeneratePluginTask', array('sfTestPlugin'), array(), false, '"sfGeneratePluginTask" fails if plugin already exists');

$t->diag('sfGeneratePluginModuleTask');
$t->task_ok('sfGeneratePluginModuleTask', array('nonexistantPlugin', 'example'), array(), false, '"sfGeneratePluginModuleTask" fails when plugin does not exist');
$t->task_ok('sfGeneratePluginModuleTask', array('sfTestPlugin', 'example*'), array(), false, '"sfGeneratePluginModuleTask" fails when module name includes bad characters');
$t->task_ok('sfGeneratePluginModuleTask', array('sfTestPlugin', 'example'));

$module_dir        = $plugin_dir.'/modules/example';
$actions_file      = $module_dir.'/actions/actions.class.php';
$base_actions_file = $module_dir.'/lib/BaseexampleActions.class.php';

$t->ok(is_dir($module_dir), '"sfGeneratePluginModuleTask" creates a module directory');
$t->ok(file_exists($actions_file), '"sfGeneratePluginModuleTask" creates an actions file');
$t->like(@file_get_contents($actions_file), '/class exampleActions extends BaseexampleActions/', '"sfGeneratePluginModuleTask" creates an actions class');
$t->ok(file_exists($base_actions_file), '"sfGeneratePluginModuleTask" creates a base actions file');
$t->like(@file_get_contents($base_actions_file), '/class BaseexampleActions extends sfActions/', '"sfGeneratePluginModuleTask" creates a base actions class');
$t->ok(file_exists($plugin_dir.'/test/functional/exampleActionsTest.php'), '"sfGeneratePluginModuleTask" creates a functional test file');
$t->like(@file_get_contents($test_project.'/config/settings.yml'), '/\bexample\b/', '"sfGeneratePluginModuleTask" enabled module in test project');

$t->diag('sfGeneratePluginTask --module option');
$t->task_ok('sfGeneratePluginTask', array('sfTestAgainPlugin'), array('--module=one', '--module=two'));
$t->ok(is_dir(sfConfig::get('sf_plugins_dir').'/sfTestAgainPlugin/modules/one'), '"sfGeneratePluginTask" creates modules when "--module" is used');
$t->ok(is_dir(sfConfig::get('sf_plugins_dir').'/sfTestAgainPlugin/modules/two'), '"sfGeneratePluginTask" creates modules when "--module" is used');
$t->like(@file_get_contents(sfConfig::get('sf_plugins_dir').'/sfTestAgainPlugin/test/fixtures/project/config/settings.yml'), '/\bone\b/', '"sfGeneratePluginTask" enables modules when "--module" is used');
$t->like(@file_get_contents(sfConfig::get('sf_plugins_dir').'/sfTestAgainPlugin/test/fixtures/project/config/settings.yml'), '/\btwo\b/', '"sfGeneratePluginTask" enables modules when "--module" is used');

$t->diag('sfGeneratePluginTask --skip-test-dir option');
$t->task_ok('sfGeneratePluginTask', array('sfTestYetAgainPlugin'), array('--skip-test-dir', '--module=another'));
$t->ok(!is_dir(sfConfig::get('sf_plugins_dir').'/sfTestYetAgainPlugin/test'), '"sfGeneratePluginTask" does not generate a test directory when "--skip-test-dir" is used');

$t->diag('sfGenerateTestsTask');
$t->task_ok('sfGenerateTestsTask', array(), array(), true);
$t->ok(file_exists(sfConfig::get('sf_test_dir').'/unit/form/FormTest.php'), '"sfGenerateTestsTask" creates test files');

$t->diag('sfGenerateTestTask');
$t->task_ok('sfGenerateTestTask', array('Form'), array(), false, '"sfGenerateTestTask" fails if test script exists');
$t->task_ok('sfGenerateTestTask', array('Form'), array('--force'), true, '"sfGenerateTestTask" succeeds with existing file and --force option');
$t->like(@file_get_contents(sfConfig::get('sf_test_dir').'/unit/form/FormTest.php'), '/getWidgetSchema\(\)/', '"sfGenerateTestTask" detects appropriate template');
$t->unlike(@file_get_contents(sfConfig::get('sf_test_dir').'/unit/form/FormTest.php'), '/__construct\(\)/', '"sfGenerateTestTask" detects appropriate template');
$t->like(@file_get_contents(sfConfig::get('sf_test_dir').'/unit/util/ToolkitTest.php'), '/doXYZ\(\)/', '"sfGenerateTestTask" creates method test stubs');
