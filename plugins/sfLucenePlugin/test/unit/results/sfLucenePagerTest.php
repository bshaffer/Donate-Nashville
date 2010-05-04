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
  * @version SVN: $Id: sfLucenePagerTest.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
  */

require dirname(__FILE__) . '/../../bootstrap/unit.php';

$t = new limeade_test(30, limeade_output::get());
$limeade = new limeade_sf($t);
$app = $limeade->bootstrap();

$luceneade = new limeade_lucene($limeade);
$luceneade->configure()->clear_sandbox();

$lucene = sfLucene::getInstance('testLucene', 'en');

$t->diag('testing constructor');

try {
  new sfLucenePager('a', $lucene);
  $t->fail('__construct() rejects a non-array');
} catch (Exception $e) {
  $t->pass('__construct() rejects a non-array');
}

try {
  new sfLucenePager(new sfLuceneResults(array(), $lucene));
  $t->pass('__construct() accepts sfLuceneResults');
} catch (Exception $e) {
  $t->fail('__construct() accepts sfLuceneResults');
}

try {
  new sfLucenePager(array(), null);
  $t->fail('__construct() must have a search instance');
} catch (Exception $e) {
  $t->pass('__construct() must have a search instance');
}

try {
  $results = new sfLucenePager(range(0, 1000), $lucene);
  $t->pass('__construct() accepts an array');
} catch (Exception $e) {
  $t->fail('__construct() accepts an array');
}

$t->diag('testing basic pagination functions');

try {
  $results->setPage(2);
  $t->pass('->setPage() accepts a integer page');
} catch (Exception $e) {
  $t->fail('->setPage() accepts a integer page');
}

try {
  $results->setMaxPerPage(10);
  $t->pass('->setMaxPerPage() accepts an integer per page');
} catch (Exception $e) {
  $t->fail('->setMaxPerPage() accepts an integer per page');
}

$t->is($results->getPage(), 2, '->getPage() returns current page');
$t->is($results->getMaxPerPage(), 10, '->getMaxPerPage() returns the max per page');
$t->is($results->getNbResults(), 1001, '->getNbResults() returns the total number of results');
$t->ok($results->haveToPaginate(), '->haveToPaginate() returns correct value');

$results->setPage(0);
$t->is($results->getPage(), 1, '->setPage() to 0 sets the page to 1');

$results->setPage(100000);
$t->is($results->getPage(), 101, '->setPage() above to upper bound resets to last page');

$results->setPage(2);

$t->diag('testing ->getResults()');

$t->is_deeply($results->getResults()->toArray(), range(10, 20), '->getResults() returns the correct range');
$results->setPage(3);
$t->is_deeply($results->getResults()->toArray(), range(20, 30), '->getResults() returns the correct range after page change');

$results->setMaxPerPage(0);
$t->is_deeply($results->getResults()->toArray(), range(0, 1000), '->getResults() returns all results if the max per page is 0');
$results->setMaxPerPage(10);

$t->diag('testing page numbers');

$t->is($results->getFirstPage(), 1, '->getFirstPage() returns 1 as first page');
$t->is($results->getLastPage(), 101, '->getLastPage() returns the last page in the range');

$t->is($results->getNextPage(), 4, '->getNextPage() returns the next page');
$results->setPage(101);
$t->is($results->getNextPage(), 101, '->getNextPage() returns last page if at end');
$results->setPage(4);

$t->is($results->getPreviousPage(), 3, '->getPreviousPage() returns the previous page');
$results->setPage(1);
$t->is($results->getPreviousPage(), 1, '->getPreviousPage() returns the first page if at start');
$results->setPage(4);

$t->diag('testing page indices');
$results->setPage(4);
$t->is($results->getFirstIndice(), 31, '->getFirstIndice() returns correct first indice in results');
$t->is($results->getLastIndice(), 40, '->getLastIndice() returns correct last indice in result');

$results->setMaxPerPage(8);
$results->setPage($results->getLastPage());

$t->is($results->getLastIndice(), 1001, '->getLastIndice() returns correct last indice if more can fit on the page');


$t->diag('testing link generator');
$results->setMaxPerPage(10);
$results->setPage(4);
$t->is($results->getLinks(5), range(2, 6), '->getLinks() returns the correct link range');

$results->setPage(1);
$t->is($results->getLinks(5), range(1, 5), '->getLinks() returns correct link range when at start of index');

$results->setPage(101);
$t->is($results->getLinks(5), range(97, 101), '->getLinks() returns link range when at end of index');

$t->diag('testing mixins');

function callListener($event)
{
  if ($event['method'] == 'goodMethod')
  {
    $args = $event['arguments'];

    $event->setReturnValue($args[0] + 1);

    return true;
  }

  return false;
}

$lucene->getEventDispatcher()->connect('pager.method_not_found', 'callListener');

try {
  $results->someBadMethod();
  $t->fail('__call() rejects bad methods');
} catch (Exception $e) {
  $t->pass('__call() rejects bad methods');
}

try {
  $return = $results->goodMethod(2);
  $t->pass('__call() accepts good methods');
  $t->is($return, 3, '__call() passes arguments');
} catch (Exception $e) {
  $t->fail('__call() accepts good methods and passes arguments');

  $e->printStackTrace();

  $t->skip('__call() passes arguments');
}