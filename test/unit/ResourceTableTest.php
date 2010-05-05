<?php

include(dirname(__FILE__) . '/../bootstrap/Doctrine.php');

// $app = 'frontend';
// include(dirname(__FILE__) . '/../bootstrap/functional.php');

$t = new lime_test(13, new lime_output_color());

$stuff = new StuffResource();
$stuff['title'] = 'Stuff Resource ' . csFactory::generate();
$stuff['owner_id'] = csFactory::selectRandomId('sfGuardUser');
$stuff->save();

$resources = Doctrine::getTable('StuffResource')
              ->getListQuery(csFactory::last());

$t->is($resources->count(), 1, 'One stuff item returned');

$time = new TimeResource();
$time['title'] = 'Time Resource ' . csFactory::generate();
$time['owner_id'] = csFactory::selectRandomId('sfGuardUser');
$time['resource_date'] = date('Y-m-d', strtotime('-1 weeks'));
$time['start_time']    = '00:00:00';
$time['end_time']      = '12:00:00';
$time->save();

$resources = Doctrine::getTable('TimeResource')
                ->getListQuery(date('Y-m-d 02:00:00', strtotime('-1 weeks')))
                ->andWhere('title = ?', $time['title'])
                ->execute();

$t->is($resources->count(), 1, 'One time item returned - start date in range');
$t->is($resources->getFirst()->getTitle(), $time['title'], 'correct resource title');

$resources = Doctrine::getTable('TimeResource')
                ->getListQuery(date('Y-m-d', strtotime('-1 months')))
                ->andWhere('title = ?', $time['title'])
                ->execute();

$t->is($resources->count(), 1, 'One time item returned - start date before range');
$t->is($resources->getFirst()->getTitle(), $time['title'], 'correct resource title');

$resources = Doctrine::getTable('TimeResource')
                ->getListQuery(date('Y-m-d', strtotime('-1 weeks')), date('Y-m-d', strtotime('+1 months')))
                ->andWhere('title = ?', $time['title'])
                ->execute();

$t->is($resources->count(), 1, 'One time item returned - start date in range, end date after range');
$t->is($resources->getFirst()->getTitle(), $time['title'], 'correct resource title');

$resources = Doctrine::getTable('TimeResource')
                ->getListQuery(date('Y-m-d', strtotime('-1 months')), date('Y-m-d', strtotime('+1 months')))
                ->andWhere('title = ?', $time['title'])
                ->execute();

$t->is($resources->count(), 1, 'One time item returned - start date before range, end date after range');
$t->is($resources->getFirst()->getTitle(), $time['title'], 'correct resource title');

$resources = Doctrine::getTable('TimeResource')
                ->getListQuery(date('Y-m-d', strtotime('-1 months')), date('Y-m-d', strtotime('+1 days')))
                ->andWhere('title = ?', $time['title'])
                ->execute();

$t->is($resources->count(), 1, 'One time item returned - start date before range, end date in range');
$t->is($resources->getFirst()->getTitle(), $time['title'], 'correct resource title');

$resources = Doctrine::getTable('TimeResource')
                ->getListQuery(date('Y-m-d', strtotime('-1 months')), date('Y-m-d', strtotime('-2 weeks')))
                ->andWhere('title = ?', $time['title'])
                ->execute();

$t->is($resources->count(), 0, 'nothing returned - end date before range');

$resources = Doctrine::getTable('TimeResource')
                ->getListQuery(date('Y-m-d', strtotime('+1 months')), date('Y-m-d', strtotime('+2 months')))
                ->andWhere('title = ?', $time['title'])
                ->execute();

$t->is($resources->count(), 0, 'nothing returned - end date before range');
