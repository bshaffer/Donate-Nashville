<?php

include(dirname(__FILE__) . '/../bootstrap/Doctrine.php');

$t = new lime_test(1, new lime_output_color());

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
$time['start_date'] = date('Y-m-d', strtotime('-1 weeks'));
$time->save();

$resources = Doctrine::getTable('StuffResource')
              ->getListQuery(csFactory::last());

$t->is($resources->count(), 1, 'One stuff item returned');
