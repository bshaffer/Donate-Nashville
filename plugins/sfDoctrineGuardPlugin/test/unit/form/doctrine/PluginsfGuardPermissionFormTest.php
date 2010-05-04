<?php

/**
 * PluginsfGuardPermissionForm tests.
 */
include dirname(__FILE__).'/../../../../../../test/bootstrap/unit.php';

$databaseManager = new sfDatabaseManager($configuration);

$t = new lime_test(1);

class TestsfGuardPermissionForm extends PluginsfGuardPermissionForm
{
  public function configure()
  {
  }
}

// ->__construct()
$t->diag('->__construct()');

$form = new TestsfGuardPermissionForm();
$t->ok(!isset($form['users_list']), '->__construct() removes fields');
