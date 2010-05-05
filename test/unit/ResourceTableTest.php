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