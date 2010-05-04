<?php
/*
 * This file is part of the sfLucenePlugin package
 * (c) 2007 - 2008 Carl Vondrick <carl@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
  * @package sfLucenePlugin
  * @subpackage Test
  * @author Carl Vondrick
  * @version SVN: $Id: sfLucenePropelIndexerHandlerTest.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
  */

require dirname(__FILE__) . '/../../bootstrap/unit.php';

$t = new limeade_test(3, limeade_output::get());
$limeade = new limeade_sf($t);
$app = $limeade->bootstrap();

$luceneade = new limeade_lucene($limeade);
$luceneade->configure()->clear_sandbox()->load_models();

class FooIndexer extends sfLucenePropelIndexerHandler
{
  public $rebuilds = array();

  public function rebuildModel($name)
  {
    $this->rebuilds[] = $name;
  }
}

$search = sfLucene::getInstance('testLucene', 'en');

$t->diag('testing ->rebuild()');
$handler = new FooIndexer($search);

$handler->rebuild();

$t->is($handler->rebuilds, array('FakeForum'), '->rebuild() calls ->rebuildModel() for all models');

$t->diag('testing ->rebuildModel()');
$handler = new sfLucenePropelIndexerHandler($search);

$search->getParameter('models')->get('FakeForum')->set('rebuild_limit', 5);

$models = array();

for ($x = 0; $x < 6;  $x++)
{
  $var = new FakeForum;
  $var->setCulture('en');
  $var->setTitle('foo');
  $var->setDescription('bar');
  $var->setCoolness(3);
  $var->save();
  $var->deleteIndex();

  $models[] = $var;
}

$search->commit();

$t->is($search->numDocs(), 0, 'model setup leaves index empty');

$handler->rebuildModel('FakeForum');
$search->commit();

$t->is($search->numDocs(), count($models), '->rebuildModel() builds all models');

foreach ($models as $model)
{
  $model->delete();
}