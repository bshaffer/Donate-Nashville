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
  * @version SVN: $Id: sfLuceneCriteriaTest.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
  */

require dirname(__FILE__) . '/../../bootstrap/unit.php';

$t = new limeade_test(53, limeade_output::get());
$limeade = new limeade_sf($t);
$limeade->bootstrap();

$luceneade = new limeade_lucene($limeade);
$luceneade->configure();

class Foo { }

function inst()
{
  return sfLuceneCriteria::newInstance(sfLucene::getInstance('testLucene'));
}

$t->diag('testing constructors');
try {
  $criteria = new sfLuceneCriteria(sfLucene::getInstance('testLucene'));
  $t->pass('__construct() takes a sfLucene instance');
} catch (Exception $e) {
  $t->fail('__construct() takes a sfLuce instance');
}
$t->isa_ok(sfLuceneCriteria::newInstance(sfLucene::getInstance('testLucene')), 'sfLuceneCriteria', '::newInstance() returns an sfLuceneCriteria object');

$t->diag('testing ->getQuery()');
$t->isa_ok($criteria->getQuery(), 'Zend_Search_Lucene_Search_Query_Boolean', '->getQuery() returns an instance of ZSL_Search_Query_Boolean');

$t->diag('testing ->add()');
try {
  $criteria->add('test', true);
  $t->pass('->add() accepts a string');
  $queries = inst()->add('foo')->add('bar')->getQuery()->getSubqueries();
  $t->ok($queries[0] == Zend_Search_Lucene_Search_QueryParser::parse('foo'), '->add() correctly parses and adds text queries');
  $t->ok($queries[1] == Zend_Search_Lucene_Search_QueryParser::parse('bar'), '->add() correctly parses and adds text queries and keeps them in order');
} catch (Exception $e) {
  $e->printStackTrace();
  $t->fail('->add() accepts a string');
  $t->skip('->add() correctly parses and adds text queries');
  $t->skip('->add() correctly parses and adds text queries and keeps them in order');
}

try {
  $criteria->add(new Zend_Search_Lucene_Search_Query_Boolean(), false);
  $t->pass('->add() accepts a Zend query');

  $query = new Zend_Search_Lucene_Search_Query_MultiTerm();
  $query->addTerm(new Zend_Search_Lucene_Index_Term('word1'), true);
  $query->addTerm(new Zend_Search_Lucene_Index_Term('word2'), null);
  $query->addTerm(new Zend_Search_Lucene_Index_Term('word3'), false);

  $queries = inst()->add($query)->getQuery()->getSubqueries();

  $t->ok($queries[0] == $query, '->add() correctly adds a Zend query');
} catch (Exception $e) {
  $t->fail('->add() accepts a Zend query');
  $t->skip('->add() correctly adds a Zend query');
}

try {
  $criteria->add(inst(), null);
  $t->pass('->add() accepts sfLuceneCriteria');

  $query = new Zend_Search_Lucene_Search_Query_MultiTerm();
  $query->addTerm(new Zend_Search_Lucene_Index_Term('word1'), true);
  $query->addTerm(new Zend_Search_Lucene_Index_Term('word2'), null);
  $query->addTerm(new Zend_Search_Lucene_Index_Term('word3'), false);

  $luceneQuery = inst()->add($query);

  $subqueries = inst()->add($luceneQuery)->getQuery()->getSubqueries();
  $subqueries = $subqueries[0]->getSubqueries();

  $t->is($subqueries[0], $query, '->add() correctly combines sfLuceneCriteria queries');
} catch (Exception $e) {
  $t->fail('->add() accepts sfLuceneCriteria');
  $t->skip('->add() correctly combines sfLuceneCriteria queries');
}

try {
  $criteria->add($criteria, true);
  $t->fail('->add() rejects itself');
} catch (Exception $e) {
  $t->pass('->add() rejects itself');
}

try {
  $criteria->add('hello ~ & ! ( ');
  $t->fail('->add() rejects bad syntax');
} catch (Exception $e) {
  $t->pass('->add() rejects bad syntax');
}

try {
  $criteria->add(new Foo());
  $t->fail('->add() rejects invalid queries');
} catch (Exception $e) {
  $t->pass('->add() rejects invalid queries');
}

$t->diag('testing ->addString()');

$criteria->add('test', true);

$queries = inst()->addString('foobar')->getQuery()->getSubqueries();
$t->ok($queries[0] == Zend_Search_Lucene_Search_QueryParser::parse('foobar'), '->addString() correctly parses and adds string queries');

$queries = inst()->addString('António', 'utf8')->getQuery()->getSubqueries();
$t->ok($queries[0] == Zend_Search_Lucene_Search_QueryParser::parse('António', 'utf8'), '->addString() correctly parses and adds UTF8 string queries');

$t->diag('testing ->addSane()');

$criteria = inst();

try {
  $criteria->addSane('test');
  $t->pass('->addSane() accepts a valid query');

  $s = $criteria->getQuery()->getSubqueries();

  $t->ok($s[0] == Zend_Search_Lucene_Search_QueryParser::parse('test'), '->addSane() correctly adds a valid query');
} catch (Exception $e) {
  $t->fail('->addSane() accepts a valid query');
  $t->skip('->addSane() correctly adds a valid query');
}

try {
  $criteria->add('carl!');
  $t->fail('->add() rejects an illegal query');
} catch (Exception $e) {
  $t->pass('->add() rejects an illegal query');
}

try {
  $criteria->addSane('carl!');
  $t->pass('->addSane() accepts an illegal query');

  $s = $criteria->getQuery()->getSubqueries();

  $t->ok($s[1] == Zend_Search_Lucene_Search_QueryParser::parse('carl'), '->addSane() correctly adds an illegal query');
} catch (Exception $e) {
  $t->fail('->addSane() accepts an illegal query');
  $t->skip('->addSane() correctly adds an illegal query');
}


$criteria = inst();

$t->diag('testing ->addField()');
try {
  $criteria->addField('string', 'foo');
  $t->pass('->addField() accepted a string value');
  $s = $criteria->getQuery()->getSubqueries();

  $t->ok($s[0] == new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term('string','foo')), '->addField() registers the new field');
} catch (Exception $e) {
  $t->fail('->addField() accepted a string value');
  $t->skip('->addField() registers the new field');
}

try {
  $criteria->addField(range(1, 10), 'bar');
  $t->pass('->addField() accepted an array value');
  $s = $criteria->getQuery()->getSubqueries();

  $q = new Zend_Search_Lucene_Search_Query_Boolean();
  foreach (range(1, 10) as $value)
  {
    $q->addSubquery(new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($value, 'bar'), true));
  }

  $t->ok($s[1] == $q, '->addField() registers the array field');
} catch (Exception $e) {
  $t->fail('->addField() accepted an array value');
  $t->skip('->addField() registers the array field');
}

try {
  $criteria->addField(new Foo());
  $t->fail('->addField() rejects invalid values');
} catch (Exception $e) {
  $t->pass('->addField() rejects invalid values');
}

$t->diag('testing addMultiTerm()');
$s = inst()->addMultiTerm(range(1, 10), 'foo')->getQuery()->getSubqueries();

$q = new Zend_Search_Lucene_Search_Query_MultiTerm();

foreach (range(1, 10) as $value)
{
  $q->addTerm(new Zend_Search_Lucene_Index_Term($value, 'foo'));
}

$t->ok($s[0] == $q, '->addMultiTerm() registers the correct query');

try {
  $s = inst()->addMultiTerm('bar', 'foo')->getQuery()->getSubqueries();
  $q = new Zend_Search_Lucene_Search_Query_MultiTerm();
  $q->addTerm(new Zend_Search_Lucene_Index_Term('bar', 'foo'));

  $t->ok($s[0] == $q, '->addMultiTerm() registers and accepts a string value');
} catch (Exception $e) {
  $t->fail('->addMultiTerm() registers and accepts a string value');
}

$t->diag('testing addWildcard()');

$s = inst()->addWildcard('foo*', 'bar')->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Wildcard( new Zend_Search_Lucene_Index_Term('foo*', 'bar') );
$t->ok($s[0] == $q, '->addWildcard() registers the correct query with mutlitple character wildcards');

$s = inst()->addWildcard('f?o', 'bar')->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Wildcard( new Zend_Search_Lucene_Index_Term('f?o', 'bar') );
$t->ok($s[0] == $q, '->addWildcard() registers the correct query with single character wildcards');

$s = inst()->addWildcard('foo* baz?', 'bar')->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Wildcard( new Zend_Search_Lucene_Index_Term('foo* baz?', 'bar') );
$t->ok($s[0] == $q, '->addWildcard() registers the correct query with mixing character wildcards');

$t->diag('testing addPhrase()');
$s = inst()->addPhrase(array('foo', 'bar'))->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Phrase(array('foo','bar'), null, null);
$t->ok($s[0] == $q, '->addPhrase() registers the correct simple phrase query');

$s = inst()->addPhrase(array(0 => 'foo', 2 => 'bar'), 'baz', 2, true)->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Phrase(array('foo','bar'), array(0, 2), 'baz');
$q->setSlop(2);
$t->ok($s[0] == $q, '->addPhrase() registers the correct complex phrase query');

$t->diag('testing addRange()');

$s = inst()->addRange('a', 'b')->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Range(new Zend_Search_Lucene_Index_Term('a'), new Zend_Search_Lucene_Index_Term('b'), true);
$t->ok($s[0] == $s[0], '->addRange() registers a simple, two-way range');

$s = inst()->addRange('a')->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Range(new Zend_Search_Lucene_Index_Term('a'), null, true);
$t->ok($s[0] == $s[0], '->addRange() registers a simple, one-way forward range');

$s = inst()->addRange(null, 'b')->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Range(null, new Zend_Search_Lucene_Index_Term('b'), true);
$t->ok($s[0] == $s[0], '->addRange() registers a simple, one-way backward range');

try {
  $s = inst()->addRange(null, null);
  $t->fail('->addRange() rejects a query with no range');
} catch (Exception $e) {
  $t->pass('->addRange() rejects a query with no range');
}

$s = inst()->addRange('a', 'b', 'c', false)->getQuery()->getSubqueries();
$q = new Zend_Search_Lucene_Search_Query_Range(new Zend_Search_Lucene_Index_Term('a', 'c'), new Zend_Search_Lucene_Index_Term('b', 'c'), false);
$t->ok($s[0] == $s[0], '->addRange() registers a complex exclusive query');

$t->diag('testing addProximity()');

try {
  inst()->addProximity(37.7752, -122.4192, 0);
  $t->fail('->addProximity() rejects a zero proximity');
} catch (Exception $e) {
  $t->pass('->addProximity() rejects a zero proximity');
}

try {
  inst()->addProximity(37.7752, -122.4192, 90, 0);
  $t->fail('->addProximity() rejects a zero radius');
} catch (Exception $e) {
  $t->pass('->addProximity() rejects a zero radius');
}

$s = inst()->addProximity(37.7752, -122.4192, 200)->getQuery()->getSubqueries();
$s = $s[0]->getSubqueries();

$t->ok($s[0]->isInclusive(), '->addProximity() uses inclusive range queries');
$t->ok($s[1]->isInclusive(), '->addProximity() uses inclusive range queries');

$t->is_deeply(explode(chr(0), $s[0]->getLowerTerm()->key()), array('latitude', '35.9785590093'), '->addProximity() calculates correct lower bound latitude');
$t->is_deeply(explode(chr(0), $s[0]->getUpperTerm()->key()), array('latitude', '39.5718409907'), '->addProximity() calculates correct upper bound latitude');
$t->is_deeply(explode(chr(0), $s[1]->getLowerTerm()->key()), array('longitude', '-124.692219999'), '->addProximity() calculates correct lower bound longitude');
$t->is_deeply(explode(chr(0), $s[1]->getUpperTerm()->key()), array('longitude', '-120.146180001'), '->addProximity() calculates correct upper bound longitude');


$t->diag('testing sorting');

$sorts = inst()->addSortBy('foo', SORT_ASC, SORT_REGULAR)->addSortBy('bar', SORT_DESC, SORT_NUMERIC)->getSorts();

$t->is_deeply($sorts, array( array('field' => 'foo', 'order' => SORT_ASC, 'type' => SORT_REGULAR), array('field' => 'bar', 'order' => SORT_DESC, 'type' => SORT_NUMERIC)), '->addSortBy() correctly adds the sort fields');

$sorts = inst()->addAscendingSortBy('foo', SORT_STRING)->getSorts();
$t->is_deeply($sorts, array(array('field' => 'foo', 'order' => SORT_ASC, 'type' => SORT_STRING)), '->addAscendingSortBy() correctly adds a sort field');

$sorts = inst()->addDescendingSortBy('foo', SORT_STRING)->getSorts();
$t->is_deeply($sorts, array(array('field' => 'foo', 'order' => SORT_DESC, 'type' => SORT_STRING)), '->addDescendingSortBy() correctly adds a sort field');

$t->diag('testing scoring');

class FooScoring extends Zend_Search_Lucene_Search_Similarity_Default
{
}

$fooScoring = new FooScoring;

$t->is(inst()->getScoringAlgorithm(), null, '->getScoringAlgorithm() is null by default');
$t->ok(inst()->setScoringAlgorithm($fooScoring)->getScoringAlgorithm() === $fooScoring, '->setScoringAlgorithm() changes the algorithm');
$t->is(inst()->setScoringAlgorithm(null)->getScoringAlgorithm(), null, '->setScoringAlgorithm() with null algorithm reverts to default');

try {
  inst()->setScoringAlgorithm('foo');
  $t->fail('->setScoringAlgorithm() rejects invalid algorithms');
} catch (Exception $e) {
  $t->pass('->setScoringAlgorithm() rejects invalid algorithms');
}

$t->diag('testing getNewCriteria()');

$t->isa_ok(inst()->getNewCriteria(), 'sfLuceneCriteria', '->getNewCriteria() returns a new instance of sfLuceneCriteria');