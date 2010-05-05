<?php

include(dirname(__FILE__) . '/../bootstrap/Doctrine.php');

// $app = 'frontend';
// include(dirname(__FILE__) . '/../bootstrap/functional.php');

$t = new lime_test(3, new lime_output_color());

$user = csFactory::create('sfGuardUser', array('username' => csFactory::generate()));
$user['Profile'] = csFactory::create('sfGuardUserProfile');
$user->save();

$t->is($user->getFullName(), '', 'No Name Info');

$user['first_name'] = 'Amber';
$t->is($user->getFullName(), 'Amber', 'Correct Name Info');

$user['last_name'] = 'Adams';
$t->is($user->getFullName(), 'Amber Adams', 'Correct Name Info');
